<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomReview;
use Illuminate\Http\Request;

class RoomReviewController extends Controller
{
    public function index()
    {
        $roomReviewObject = new RoomReview();
        $reviews = $roomReviewObject->getAllRoomReview();
        return view('backend.admin.roomReviews.index', compact('reviews'));
    }

    public function status($id, $status)
    {
        $review = RoomReview::findOrFail($id);
        $review->status = $status;
        $status = $review->save();

        $status
            ? session()->flash('message', 'Review Status Changed Successfully!')
            : session()->flash('message', 'Something Went Wrong!');

        return back();
    }

    public function destroy($id)
    {
        $review = RoomReview::findOrFail($id);
        $destroy = $review->delete();

        $destroy
            ? session()->flash('message', 'Review Deleted Changed Successfully!')
            : session()->flash('message', 'Something Went Wrong!');

        return back();
    }
}
