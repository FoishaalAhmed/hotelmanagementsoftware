<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Bank;
use App\Models\BankPayment;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingPayment;
use App\Models\BookingVat;
use App\Models\FacilityRoom;
use App\Models\MobilePayment;
use App\Models\Order;
use App\Models\Parking;
use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\ServiceCharge;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    private $bookingObject;

    public function __construct()
    {
        $this->bookingObject = new Booking();
    }

    public function index()
    {
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->select('id', 'number', 'rate', 'type', 'situate', 'facing', 'beds')
            ->orderBy('number', 'asc')
            ->with(['bookings' => function ($query) {
                $query->select('id', 'room_id', 'status', 'booking_id')
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get();
            }])
            ->get();
        $bookingVat = BookingVat::where('hotel_id', auth()->user()->hotel_id)->first();
        $vat = $bookingVat != null ? $bookingVat->vat : 0 ;
        $banks = Bank::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        return view('backend.admin.booking.index', compact('rooms', 'vat', 'banks'));
    }

    public function create()
    {
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');

        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereNotIn('id', $bookedRoom)->select('id', 'number', 'rate', 'type', 'situate', 'facing', 'beds')
            ->orderBy('number', 'asc')
            ->get();
        $bookingVat = BookingVat::where('hotel_id', auth()->user()->hotel_id)->first();
        $vat = $bookingVat != null ? $bookingVat->vat : 0;
            
        return view('backend.admin.booking.create', compact('rooms', 'vat'));
    }

    public function store(BookingRequest $request)
    {

        $this->bookingObject->storeBooking($request);
        return back();
    }

    public function edit($id)
    {
        $bookingObject = new BookingDetail();
        $booking = $this->bookingObject->getBookingWithUser($id);
        //$booking = Booking::where('hotel_id', auth()->user()->hotel_id)->findOrFail($id);
        $bookingDetails = $bookingObject->getBookingDetail($id);
        $bankPayments = BankPayment::where('booking_id', $id)->select('date', 'bank', 'amount')->get();
        $cashPayments = BookingPayment::where('booking_id', $id)->select('date', 'paid')->get();
        $mobilePayments = MobilePayment::where('booking_id', $id)->select('date', 'mobile_number', 'amount')->get();
        return view('backend.admin.booking.edit', compact('booking', 'bookingDetails', 'bankPayments', 'cashPayments', 'mobilePayments'));
    }

    public function update(BookingRequest $request, $id)
    {
        $this->bookingObject->updateBooking($request, $id);
        return back();
    }

    public function checkout($id)
    {
        $serviceChargeObject = new ServiceCharge();
        $bookingObject = new BookingDetail();
        $parkingObject = new Parking();
        $orderObject = new Order();
        $booking = Booking::findOrFail($id);
        $bookingDetails = $bookingObject->getBookingDetail($id);
        $bankPayments = BankPayment::where('booking_id', $id)->select('date', 'bank', 'amount')->get();
        $cashPayments = BookingPayment::where('booking_id', $id)->select('date', 'paid')->get();
        $mobilePayments = MobilePayment::where('booking_id', $id)->select('date', 'mobile_number', 'amount')->get();
        $services = $serviceChargeObject->getBookingServiceCharge($id);
        $parkings = $parkingObject->getAllBookingParking($id);
        $orders = $orderObject->getBookingHotelOrders($id);
        return view('backend.admin.booking.checkout', compact('booking', 'bookingDetails', 'services', 'bankPayments', 'cashPayments', 'mobilePayments', 'parkings', 'orders'));
    }
}
