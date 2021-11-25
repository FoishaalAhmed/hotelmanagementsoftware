<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodCategory;
use App\Models\FoodType;
use App\Models\TodayMenu;
use Illuminate\Http\Request;

class TodayMenuController extends Controller
{

    private $todayMenuObject;

    public function __construct()
    {
        $this->todayMenuObject = new TodayMenu();
    }

    public function index()
    {
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.menus.index', compact('types'));
    }

    public function create()
    {
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.menus.create', compact('types', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate(TodayMenu::$validateStoreRule);
        $this->todayMenuObject->storeTodayMenu($request);
        return back();
    }

    public function edit($id)
    {
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        $items = $this->todayMenuObject->getTodayMenusByFoodType($id);
        return view('backend.restaurant.menus.edit', compact('types', 'items', 'categories', 'id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(TodayMenu::$validateUpdateRule);
        $this->todayMenuObject->updateTodayMenu($request, $id);
        return redirect()->route('restaurant.menus.index');
    }

    public function destroy($id)
    {
        $this->todayMenuObject->destroyTodayMenu($id);
        return back();
    }
}
