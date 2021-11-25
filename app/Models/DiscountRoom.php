<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'discount_id', 'start_date', 'end_date', 'room_id',
    ];

    public static $validateRule = [
        'room_id'     => 'required|numeric',
        'discount_id' => 'required|numeric',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date',
    ];

    public function getRoomDiscount()
    {
        $room_discounts = $this::join('rooms', 'discount_rooms.room_id', '=', 'rooms.id')
            ->join('discounts', 'discount_rooms.discount_id', '=', 'discounts.id')
            ->where('discount_rooms.hotel_id', auth()->user()->hotel_id)
            ->select('discount_rooms.id', 'discount_rooms.start_date', 'discount_rooms.end_date', 'discounts.discount', 'rooms.number')
            ->get();
        return $room_discounts;
    }

    public function storeRoomDiscount(Object $request)
    {
        $this->hotel_id    = auth()->user()->hotel_id;
        $this->discount_id = $request->discount_id;
        $this->room_id     = $request->room_id;
        $this->start_date  = date('Y-m-d', strtotime($request->start_date));
        $this->end_date    = date('Y-m-d', strtotime($request->end_date));
        $storeRoomDiscount = $this->save();

        $storeRoomDiscount
        ? session()->flash('message', 'Room Discount Stored Successfully!')
        : session()->flash('message', 'Something Went Wrong!');;
    }

    public function updateRoomDiscount(Object $request, Int $id)
    {
        $room_discount = $this::findOrFail($id);
        $room_discount->hotel_id    = auth()->user()->hotel_id;
        $room_discount->discount_id = $request->discount_id;
        $room_discount->room_id     = $request->room_id;
        $room_discount->start_date  = date('Y-m-d', strtotime($request->start_date));
        $room_discount->end_date    = date('Y-m-d', strtotime($request->end_date));
        $update_room_discount       = $room_discount->save();

        $update_room_discount
            ? session()->flash('message', 'Room Discount Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyRoomDiscount(Int $id)
    {
        $discount = $this::findOrFail($id);
        $destroyRoomDiscount = $discount->delete();

        $destroyRoomDiscount
            ? session()->flash('message', 'Room Discount Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
