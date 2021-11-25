<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function food_items(Request $request)
    {
        $items = Item::where('food_category_id', $request->category)->where('food_type_id', $request->type)->select('id', 'name', 'price')->get();
        return response($items, 200);
    }
}
