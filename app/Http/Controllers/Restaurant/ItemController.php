<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\FoodCategory;
use App\Models\FoodType;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private $itemObject;

    public function __construct()
    {
        $this->itemObject = new  Item();
    }

    public function index()
    {
        $items = $this->itemObject->getAllHotelItems();
        return view('backend.restaurant.items.index', compact('items'));
    }

    public function create()
    {
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.items.create', compact('types', 'categories'));
    }

    public function store(ItemRequest $request)
    {
        $this->itemObject->storeItem($request);
        return back();
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $types = FoodType::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        $categories = FoodCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.restaurant.items.edit', compact('types', 'categories', 'item'));
    }

    public function update(Request $request, $id)
    {
        $this->itemObject->updateItem($request, $id);
        return redirect()->route('restaurant.items.index');
    }

    public function destroy($id)
    {
        $this->itemObject->destroyItem($id);
        return back();
    }
}
