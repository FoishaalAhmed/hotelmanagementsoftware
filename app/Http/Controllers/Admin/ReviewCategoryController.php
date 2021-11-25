<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewCategory;
use Illuminate\Http\Request;

class ReviewCategoryController extends Controller
{
    private $reviewCategoryObject;

    public function __construct()
    {
        $this->reviewCategoryObject = new ReviewCategory();
    }

    public function index()
    {
        $categories = ReviewCategory::select('id', 'name')->get();
        return view('backend.admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(ReviewCategory::$validateRule);
        $this->reviewCategoryObject->storeReviewCategory($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(ReviewCategory::$validateRule);
        $this->reviewCategoryObject->updateReviewCategory($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->reviewCategoryObject->destroyReviewCategory($id);
        return back();
    }
}
