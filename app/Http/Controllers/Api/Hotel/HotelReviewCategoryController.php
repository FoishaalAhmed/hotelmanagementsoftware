<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\ReviewCategory;
use Illuminate\Http\Request;

class HotelReviewCategoryController extends Controller
{
    private $reviewCategoryObject;

    public function __construct()
    {
        $this->reviewCategoryObject = new ReviewCategory();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $categories = ReviewCategory::select('id', 'name')->get();
            return response()->json($categories, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(ReviewCategory::$validateRule);
            $this->reviewCategoryObject->storeReviewCategory($request);
            $response = ['message' => 'Hotel Review Category Created Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $category = ReviewCategory::where('id', $id)->select('id', 'name')->first();
            return response()->json($category, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(ReviewCategory::$validateRule);
            $this->reviewCategoryObject->updateReviewCategory($request, $id);
            $response = ['message' => 'Hotel Review Category Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->reviewCategoryObject->destroyReviewCategory($id);
            $response = ['message' => 'Hotel Review Category Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
