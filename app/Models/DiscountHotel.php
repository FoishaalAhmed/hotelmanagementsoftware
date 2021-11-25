<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountHotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'discount_id', 'start_date', 'end_date',
    ];

    public static $validateRule = [
        'discount_id' => 'required|numeric',
        'start_date'  => 'required|date',
        'end_date'    => 'required|date',
    ];

    public function getHotelDiscount()
    {
        $hotelDiscounts = $this::join('discounts', 'discount_hotels.discount_id', '=', 'discounts.id')
            ->where('discount_hotels.hotel_id', auth()->user()->hotel_id)
            ->select('discount_hotels.id', 'discount_hotels.start_date', 'discount_hotels.end_date', 'discounts.discount')
            ->orderBy('discounts.discount', 'asc')
            ->get();
        return $hotelDiscounts;
    }

    public function storeHotelDiscount($request)
    {
        $this->hotel_id    = auth()->user()->hotel_id;
        $this->discount_id = $request->discount_id;
        $this->start_date  = date('Y-m-d', strtotime($request->start_date));
        $this->end_date    = date('Y-m-d', strtotime($request->end_date));
        $this->save();

        session()->flash('message', 'Hotel Discount Stored Successfully!');
    }

    public function updateHotelDiscount($request, $id)
    {
        $hotelDiscount = $this::findOrFail($id);

        $hotelDiscount->hotel_id    = auth()->user()->hotel_id;
        $hotelDiscount->discount_id = $request->discount_id;
        $hotelDiscount->start_date  = date('Y-m-d', strtotime($request->start_date));
        $hotelDiscount->end_date    = date('Y-m-d', strtotime($request->end_date));
        $updateHotelDiscount        = $hotelDiscount->save();

        $updateHotelDiscount
            ? session()->flash('message', 'Hotel Discount Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHotelDiscount($id)
    {
        $hotelDiscount = $this::findOrFail($id);
        $deleteHotelDiscount = $hotelDiscount->delete();

        $deleteHotelDiscount
            ? session()->flash('message', 'Hotel Discount Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
