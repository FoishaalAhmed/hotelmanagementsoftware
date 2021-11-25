<?php

namespace App\Http\Controllers\Api\Hotel;

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
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $hotelDiscounts = $this->discountHotelObject->getHotelDiscount();
            return response()->json($hotelDiscounts, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(DiscountHotel::$validateRule);
            $this->discountHotelObject->storeHotelDiscount($request);
            $response = ['message' => 'New Hotel Discount Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $hotelDiscount = DiscountHotel::findOrFail($id);
            return response()->json($hotelDiscount, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(DiscountHotel::$validateRule);
            $this->discountHotelObject->updateHotelDiscount($request, $id);
            $response = ['message' => 'Hotel Discount Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->discountHotelObject->destroyHotelDiscount($id);
            $response = ['message' => 'Hotel Discount Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
