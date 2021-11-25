<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\RoomReview;
use Illuminate\Http\Request;

class RoomReviewController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $roomReviewObject = new RoomReview();
            $reviews = $roomReviewObject->getAllRoomReview();
            return response()->json($reviews, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
        
    }

    public function status($id, $status)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $review = RoomReview::findOrFail($id);
            $review->status = $status;
            $status = $review->save();

            $message = $status
                ? 'Review Status Changed Successfully!'
                : 'Something Went Wrong!';
            $response = ['message' => $message];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $review = RoomReview::findOrFail($id);
            $destroy = $review->delete();

            $message = $destroy
                ? 'Review Deleted Changed Successfully!'
                : 'Something Went Wrong!';
            $response = ['message' => $message];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
