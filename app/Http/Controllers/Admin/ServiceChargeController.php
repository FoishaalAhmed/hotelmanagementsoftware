<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BookingDetail;
use App\Models\HotelService;
use App\Models\MobileBank;
use App\Models\Room;
use App\Models\Service;
use App\Models\ServiceCharge;
use Illuminate\Http\Request;

class ServiceChargeController extends Controller
{
    private $ServiceChargeObject;

    public function __construct()
    {
        $this->ServiceChargeObject = new ServiceCharge();
    }

    public function create()
    {
        $hotelServiceObject = new HotelService();
        $services = $hotelServiceObject->getHotelChargeApplicableServicesByHotelId(auth()->user()->hotel_id);
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        return view('backend.admin.serviceCharge', compact('services', 'banks', 'mobileBanks'));
    }

    public function store(Request $request)
    {
        $room_id = Room::where('hotel_id', auth()->user()->hotel_id)->where('number', $request->room_number)->firstOrFail()->id;
        $booking = BookingDetail::where('room_id', $room_id)->select('id', 'invoice', 'status', 'booking_id')->orderBy('id', 'desc')->first();

        if ($booking == null || $booking->status != 1) {

            return redirect()->back()->withErrors('This Room is not Currently Booked. Please Check The Room Number Again');
        }

        $request->validate(ServiceCharge::$validateRule);
        $this->ServiceChargeObject->storeServiceCharge($request, $booking);
        return back();
    }
}
