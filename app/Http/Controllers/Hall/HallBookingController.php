<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallBookingRequest;
use App\Models\Bank;
use App\Models\BookingDetail;
use App\Models\Hall;
use App\Models\HallBooking;
use App\Models\MobileBank;
use App\Models\Room;
use Illuminate\Http\Request;

class HallBookingController extends Controller
{
    protected $hallBookingObject;

    public function __construct()
    {
        $this->hallBookingObject = new HallBooking();
    }

    public function index()
    {
        $bookings = $this->hallBookingObject->getHallBooking();
        return view('backend.hall.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $halls = Hall::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        return view('backend.hall.bookings.create', compact('rooms', 'halls', 'banks', 'mobileBanks'));
    }

    public function store(HallBookingRequest $request)
    {
        $this->hallBookingObject->storeHallBooking($request);
        return back();
    }

    public function destroy(HallBooking $booking)
    {
        $this->hallBookingObject->destroyHallBooking($booking);
        return back();
    }
}
