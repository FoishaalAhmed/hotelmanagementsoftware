<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $hotelReviewObject = new HotelReview();
        $reviews = $hotelReviewObject->getAllHotelReview();
        return view('backend.admin.reviews.index', compact('reviews'));
    }

    public function status($id, $status)
    {
        $review = HotelReview::findOrFail($id);
        $review->status = $status;
        $status = $review->save();

        $status
            ? session()->flash('message', 'Review Status Changed Successfully!')
            : session()->flash('message', 'Something Went Wrong!');

        return back();
    }

    public function destroy($id)
    {
        $review = HotelReview::findOrFail($id);
        $destroy = $review->delete();

        $destroy
            ? session()->flash('message', 'Review Deleted Changed Successfully!')
            : session()->flash('message', 'Something Went Wrong!');

        return back();
    }
}
