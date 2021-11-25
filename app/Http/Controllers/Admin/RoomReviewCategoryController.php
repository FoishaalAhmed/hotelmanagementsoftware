<?php

namespace App\Http\Controllers\Admin;

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
        $categories = RoomReviewCategory::select('id', 'name')->get();
        return view('backend.admin.roomCategory', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(RoomReviewCategory::$validateRule);
        $this->roomReviewCategoryObject->storeReviewCategory($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(RoomReviewCategory::$validateRule);
        $this->roomReviewCategoryObject->updateReviewCategory($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->roomReviewCategoryObject->destroyReviewCategory($id);
        return back();
    }
}
