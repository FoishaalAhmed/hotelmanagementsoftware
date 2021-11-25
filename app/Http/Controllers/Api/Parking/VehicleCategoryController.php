<?php

namespace App\Http\Controllers\Api\Parking;

use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    protected $vehicleCategoryObject;

    public function __construct()
    {
        $this->vehicleCategoryObject = new VehicleCategory();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
            return response()->json($categories, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(VehicleCategory::$validateRule);
            $this->vehicleCategoryObject->storeVehicleCategory($request);
            $response = ['message' => 'New Vehicle Category Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $category = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->select('id', 'name')->first();
            return response()->json($category, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $request->validate(VehicleCategory::$validateRule);
            $this->vehicleCategoryObject->updateVehicleCategory($request, $id);
            $response = ['message' => 'Vehicle Category Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Parking')) {
            $this->vehicleCategoryObject->destroyVehicleCategory($id);
            $response = ['message' => 'Vehicle Category Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
