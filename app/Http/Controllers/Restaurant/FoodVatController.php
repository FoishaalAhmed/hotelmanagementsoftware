<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\FoodVat;
use Illuminate\Http\Request;

class FoodVatController extends Controller
{
    private $foodVatObject;

    public function __construct()
    {
        $this->foodVatObject = new FoodVat();
    }

    public function index()
    {
        $vats = FoodVat::where('hotel_id', auth()->user()->hotel_id)->orderBy('percent', 'asc')->get();
        return view('backend.restaurant.vat', compact('vats'));
    }

    public function store(Request $request)
    {
        $request->validate(FoodVat::$validateRule);
        $this->foodVatObject->storeFoodVat($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(FoodVat::$validateRule);
        $this->foodVatObject->updateFoodVat($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->foodVatObject->destroyFoodVat($id);
        return back();
    }
}
