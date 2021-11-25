<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\HotelReview;

class HotelReviewController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $hotelReviewObject = new HotelReview();
            $reviews = $hotelReviewObject->getAllHotelReview();
            return response()->json($reviews, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function status($id, $status)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $review = HotelReview::findOrFail($id);
            $review->status = $status;
            $status = $review->save();

            $message = $status
            ? 'Review Status Changed Successfully!'
                : 'Something Went Wrong!';
            return response()->json($message, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $review = HotelReview::findOrFail($id);
            $destroy = $review->delete();

            $message = $destroy
            ? 'Review Deleted Changed Successfully!'
                : 'Something Went Wrong!';
            return response()->json($message, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }

        
    }
}
