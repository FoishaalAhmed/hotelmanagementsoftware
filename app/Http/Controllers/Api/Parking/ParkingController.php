<?php

namespace App\Http\Controllers\Api\Parking;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    private $parkingObject;

    public function __construct()
    {
        $this->parkingObject = new Parking();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $parkings = $this->parkingObject->getAllParking();
            return response()->json($parkings, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        } 
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(Parking::$validateRule);
            $this->parkingObject->storeParking($request);
            $response = ['message' => 'New Parking Info Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        } 
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $parking = Parking::findOrFail($id);
            $charges = Charge::where('hotel_id', auth()->user()->hotel_id)->where('category', $parking->vehicle_category_id)->select('id', 'type')->get();
            return response()->json($charges, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        } 
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(Parking::$validateRule);
            $this->parkingObject->updateParking($request, $id);
            $response = ['message' => 'Parking Info updated Successfully!'];
            return response()->json($response, 200);

        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        } 
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $this->parkingObject->destroyParking($id);
            $response = ['message' => 'Parking Info Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        } 
    }
}
