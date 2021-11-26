<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Models\HallRent;
use Illuminate\Http\Request;

class HallRentController extends Controller
{
    protected $hallRentObject;

    public function __construct()
    {
        $this->hallRentObject = new HallRent();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $rents = $this->hallRentObject->getHallRents();
            return response()->json($rents, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(HallRent::$validateRule);
            $this->hallRentObject->storeHallRents($request);
            $response = ['message' => 'New Hall Rent Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(HallRent $rent)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $halls = $this->hallObject->getHalls();
            return response()->json($rent, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, HallRent $rent)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(HallRent::$validateRule);
            $this->hallRentObject->updateHallRents($request, $rent);
            $response = ['message' => 'New Hall Rent Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(HallRent $rent)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $this->hallRentObject->destroyHallRents($rent);
            $response = ['message' => 'Hall Rent Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
