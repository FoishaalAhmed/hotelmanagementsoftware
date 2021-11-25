<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountHotel;
use Illuminate\Http\Request;

class DiscountHotelController extends Controller
{
    private $discountHotelObject;

    public function __construct()
    {
        $this->discountHotelObject = new DiscountHotel();
    }

    public function index()
    {
        $hotelDiscounts = $this->discountHotelObject->getHotelDiscount();
        return view('backend.admin.hotelDiscounts.index', compact('hotelDiscounts'));
    }

    public function create()
    {
        $discounts = Discount::select('id', 'discount')->get();
        return view('backend.admin.hotelDiscounts.create', compact('discounts'));
    }

    public function store(Request $request)
    {
        $request->validate(DiscountHotel::$validateRule);
        $this->discountHotelObject->storeHotelDiscount($request);
        return back();
    }

    public function edit($id)
    {
        $hotelDiscount = DiscountHotel::findOrFail($id);
        $discounts      = Discount::select('id', 'discount')->get();
        return view('backend.admin.hotelDiscounts.edit', compact('discounts', 'hotelDiscount'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(DiscountHotel::$validateRule);
        $this->discountHotelObject->updateHotelDiscount($request, $id);
        return redirect()->route('admin.hotel-discounts.index');
    }

    public function destroy($id)
    {
        $this->discountHotelObject->destroyHotelDiscount($id);
        return back();
    }
}
