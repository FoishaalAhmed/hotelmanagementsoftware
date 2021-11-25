<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodType;
use Illuminate\Http\Request;

class FoodTypeController extends Controller
{
    private $foodTypeObject;

    public function __construct()
    {
        $this->foodTypeObject = new FoodType();
    }

    public function index()
    {
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.type', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate(FoodType::$validateRule);
        $this->foodTypeObject->storeFoodType($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(FoodType::$validateRule);
        $this->foodTypeObject->updateFoodType($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->foodTypeObject->destroyFoodType($id);
        return back();
    }
}
