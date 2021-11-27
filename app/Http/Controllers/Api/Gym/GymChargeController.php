<?php

namespace App\Http\Controllers\Api\Gym;

use App\Http\Controllers\Controller;
use App\Models\GymCharge;
use Illuminate\Http\Request;

class GymChargeController extends Controller
{
    protected $gymChargeObject;

    public function __construct()
    {
        $this->gymChargeObject = new GymCharge();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $charges = $this->gymChargeObject->getGymCharges();
            return response()->json($charges, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $request->validate(GymCharge::$validateRule);
            $this->gymChargeObject->storeGymCharge($request);
            $response = ['message' => 'Gym Charge Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(GymCharge $gymCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            return response()->json($gymCharge, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, GymCharge $gymCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $request->validate(GymCharge::$validateRule);
            $this->gymChargeObject->updateGymCharge($request, $gymCharge);
            $response = ['message' => 'Gym Charge Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(GymCharge $gymCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Gym')) {
            $this->gymChargeObject->destroyGymCharge($gymCharge);
            $response = ['message' => 'Gym Charge Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
