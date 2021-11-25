<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\DiscountRoom;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class DiscountRoomController extends Controller
{
    private $discountRoomObject;

    public function __construct()
    {
        $this->discountRoomObject = new DiscountRoom();
    }

    public function index()
    {
        $roomDiscounts = $this->discountRoomObject->getRoomDiscount();
        return view('backend.admin.roomDiscounts.index', compact('roomDiscounts'));
    }

    public function create()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->distinct()
            ->whereNotIn('id', function ($query)  {
                $query->select('room_id')
                ->from('discount_rooms');
            })->select('id', 'number')->get();
        $discounts = Discount::select('id', 'discount')->get();

        return view('backend.admin.roomDiscounts.create', compact('discounts', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate(DiscountRoom::$validateRule);
        $this->discountRoomObject->storeRoomDiscount($request);
        return back();
    }

    public function edit($id)
    {
        $roomDiscount = DiscountRoom::findOrFail($id);
        $discounts    = Discount::select('id', 'discount')->get();
        $hotels       = Hotel::select('id', 'name')->get();
        $rooms        = Room::where('hotel_id', $roomDiscount->hotel_id)->select('id', 'number')->get();
        return view('backend.admin.roomDiscounts.edit', compact('discounts', 'hotels', 'roomDiscount', 'rooms'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(DiscountRoom::$validateRule);
        $this->discountRoomObject->updateRoomDiscount($request, $id);
        return redirect()->route('admin.room-discounts.index');
    }

    public function destroy($id)
    {
        $this->discountRoomObject->destroyRoomDiscount($id);
        return back();
    }
}
