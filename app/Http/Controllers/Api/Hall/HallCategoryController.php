<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Models\HallCategory;
use Illuminate\Http\Request;

class HallCategoryController extends Controller
{
    protected $hallCategoryObject;

    public function __construct()
    {
        $this->hallCategoryObject = new HallCategory();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $categories = HallCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
            return response()->json($categories, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(HallCategory::$validateRule);
            $this->hallCategoryObject->storeHallCategory($request);
            $response = ['message' => 'New Hall Category Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $category = HallCategory::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->select('id', 'name')->firstOrFail();
            return response()->json($category, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $request->validate(HallCategory::$validateRule);
            $this->hallCategoryObject->updateHallCategory($request, $id);
            $response = ['message' => 'New Hall Category Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $this->hallCategoryObject->destroyHallCategory($id);
            $response = ['message' => 'New Hall Category Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
