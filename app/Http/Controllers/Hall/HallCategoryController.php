<?php

namespace App\Http\Controllers\Hall;

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
        $categories = HallCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.hall.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(HallCategory::$validateRule);
        $this->hallCategoryObject->storeHallCategory($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(HallCategory::$validateRule);
        $this->hallCategoryObject->updateHallCategory($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->hallCategoryObject->destroyHallCategory($id);
        return back();
    }
}
