<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountRoom;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomDiscountController extends Controller
{
    private $discountRoomObject;

    public function __construct()
    {
        $this->discountRoomObject = new DiscountRoom();
    }

    public function returnRoomAndDiscount()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->distinct()
            ->whereNotIn('id', function ($query) {
                $query->select('room_id')
                ->from('discount_rooms');
            })->select('id', 'number')->get();
        $discounts = Discount::select('id', 'discount')->get();

        $response = ['discounts' => $discounts, 'rooms' => $rooms];
        return response()->json($response, 200);
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $roomDiscounts = $this->discountRoomObject->getRoomDiscount();
            return response()->json($roomDiscounts, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(DiscountRoom::$validateRule);
            $this->discountRoomObject->storeRoomDiscount($request);
            $response = ['message' => 'New Room Discount Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $roomDiscount = DiscountRoom::findOrFail($id);
            $discounts    = Discount::select('id', 'discount')->get();
            $rooms        = Room::where('hotel_id', $roomDiscount->hotel_id)->select('id', 'number')->get();
            $response     = ['roomDiscount' => $roomDiscount, 'discounts' => $discounts, 'rooms' => $rooms];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $request->validate(DiscountRoom::$validateRule);
            $this->discountRoomObject->updateRoomDiscount($request, $id);
            $response = ['message' => 'Room Discount Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->discountRoomObject->destroyRoomDiscount($id);
            $response = ['message' => 'Room Discount Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
