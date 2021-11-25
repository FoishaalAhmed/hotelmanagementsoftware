<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodVat;
use Illuminate\Http\Request;

class FoodVatController extends Controller
{
    private $foodVatObject;

    public function __construct()
    {
        $this->foodVatObject = new FoodVat();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $vats = FoodVat::where('hotel_id', auth()->user()->hotel_id)->orderBy('percent', 'asc')->select('id', 'percent')->get();
            return response($vats, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(FoodVat::$validateRule);
            $this->foodVatObject->storeFoodVat($request);
            $response = ['message' => 'Food Vat Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $vat = FoodVat::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->select('id', 'percent')->firstOrFail();
            return response($vat, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(FoodVat::$validateRule);
            $this->foodVatObject->updateFoodVat($request, $id);
            $response = ['message' => 'Food Vat Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $this->foodVatObject->destroyFoodVat($id);
            $response = ['message' => 'Food Vat Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
