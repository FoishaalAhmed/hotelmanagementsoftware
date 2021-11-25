<?php

namespace App\Http\Controllers\Api\Parking;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    private $chargeObject;

    public function __construct()
    {
        $this->chargeObject = new Charge();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $charges = $this->chargeObject->getParkingCharges();
            return response()->json($charges, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }  
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(Charge::$validateRule);
            $this->chargeObject->storeCharge($request);
            $response = ['message' => 'New Parking Charge Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $charge = Charge::first($id);
            return response()->json($charge, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(Charge::$validateRule);
            $this->chargeObject->updateCharge($request, $id);
            $response = ['message' => 'Parking Charges Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $this->chargeObject->destroyCharge($id);
            $response = ['message' => 'Parking Charges Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
