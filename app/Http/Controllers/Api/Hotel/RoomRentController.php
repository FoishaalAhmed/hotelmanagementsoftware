<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\RoomRent;
use Illuminate\Http\Request;

class RoomRentController extends Controller
{
    private $roomRentObject;

    public function __construct()
    {
        $this->roomRentObject = new RoomRent();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $rents = $this->roomRentObject->getRoomRents();
            return response($rents, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(RoomRent::$validateRule);
            $this->roomRentObject->storeRoomRent($request);
            $response = ['message' => 'New Room Rent Created Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $rent = $this->roomRentObject->getRoomRent($id);
            //$rent = RoomRent::findOrFail($id);
            return response($rent, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(RoomRent::$validateRule);
            $this->roomRentObject->updateRoomRent($request, $id);
            $response = ['message' => 'Room Rent Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->roomRentObject->destroyRoomRent($id);
            $response = ['message' => 'Room Rent Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
