<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    private $foodCategoryObject;

    public function __construct()
    {
        $this->foodCategoryObject = new FoodCategory();
    }

    public function index()
    {
        $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(FoodCategory::$validateRule);
        $this->foodCategoryObject->storeFoodCategory($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(FoodCategory::$validateRule);
        $this->foodCategoryObject->updateFoodCategory($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->foodCategoryObject->destroyFoodCategory($id);
        return back();
    }
}
