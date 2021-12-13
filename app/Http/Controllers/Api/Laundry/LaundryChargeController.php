<?php

namespace App\Http\Controllers\Api\Laundry;

use App\Http\Controllers\Controller;
use App\Models\LaundryCharge;
use Illuminate\Http\Request;

class LaundryChargeController extends Controller
{
    protected $laundryChargeObject;

    public function __construct()
    {
        $this->laundryChargeObject = new LaundryCharge();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $charges = $this->laundryChargeObject->getLaundryCharges();
            return response()->json($charges, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $request->validate(LaundryCharge::$validateRule);
            $this->laundryChargeObject->storeLaundryCharge($request);
            $response = ['message' => 'Laundry Charge Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show(LaundryCharge $laundryCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {

            return response()->json($laundryCharge, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, LaundryCharge $laundryCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $request->validate(LaundryCharge::$validateRule);
            $this->laundryChargeObject->updateLaundryCharge($request, $laundryCharge);
            $response = ['message' => 'Laundry Charge Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(LaundryCharge $laundryCharge)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Laundry')) {
            $this->laundryChargeObject->destroyLaundryCharge($laundryCharge);
            $response = ['message' => 'Laundry Charge Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
