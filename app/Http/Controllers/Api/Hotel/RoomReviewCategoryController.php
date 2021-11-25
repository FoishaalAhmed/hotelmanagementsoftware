<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\RoomReviewCategory;
use Illuminate\Http\Request;

class RoomReviewCategoryController extends Controller
{
    private $roomReviewCategoryObject;

    public function __construct()
    {
        $this->roomReviewCategoryObject = new RoomReviewCategory();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $categories = RoomReviewCategory::select('id', 'name')->get();
            return response()->json($categories, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(RoomReviewCategory::$validateRule);
            $this->roomReviewCategoryObject->storeReviewCategory($request);
            $response = ['message' => 'Room Review Category Created Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $category = RoomReviewCategory::where('id', $id)->select('id', 'name')->first();
            return response()->json($category, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(RoomReviewCategory::$validateRule);
            $this->roomReviewCategoryObject->updateReviewCategory($request, $id);
            $response = ['message' => 'Room Review Category Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->roomReviewCategoryObject->destroyReviewCategory($id);
            $response = ['message' => 'Room Review Category Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
