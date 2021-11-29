<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\Bank;
use App\Models\BookingDetail;
use App\Models\HallRent;
use App\Models\MobileBank;
use App\Models\Room;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function charge(Request $request)
    {
        $types = Charge::where('category', $request->category)->select('id', 'type')->get();
        echo json_encode($types);
    }

    public function parkingInfo()
    {
        $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();

        $response = [
            'categories' => $categories,
            'rooms' => $rooms,
            'banks' => $banks,
            'mobileBanks' => $mobileBanks,
        ];
        return response()->json($response, 200);
    }

    public function rent(Request $request)
    {
        $rent = HallRent::where('hotel_id', auth()->user()->hotel_id)->where('type', $request->type)->where('hall_id', $request->hall_id)->select('rent')->first();

        echo json_encode($rent);
    }

    public function booked_room()
    {
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();

        return response($rooms, 200);
    }
}
