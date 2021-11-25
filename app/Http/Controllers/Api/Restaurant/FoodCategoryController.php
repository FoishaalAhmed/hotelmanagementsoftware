<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{

    private $foodCategoryObject;

    public function __construct()
    {
        $this->foodCategoryObject = new FoodCategory();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
            return response($categories, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(FoodCategory::$validateRule);
            $this->foodCategoryObject->storeFoodCategory($request);
            $response = ['message' => 'Food Category Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {

        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $category = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->select('id', 'name')->firstOrFail();
            return response($category, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(FoodCategory::$validateRule);
            $this->foodCategoryObject->updateFoodCategory($request, $id);
            $response = ['message' => 'Food Category Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $this->foodCategoryObject->destroyFoodCategory($id);
            $response = ['message' => 'Food Category Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
