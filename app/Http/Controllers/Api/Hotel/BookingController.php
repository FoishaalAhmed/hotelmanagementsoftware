<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\BankPayment;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingPayment;
use App\Models\MobilePayment;
use App\Models\RoomFacility;
use App\Models\Room;
use App\Models\ServiceCharge;

class BookingController extends Controller
{
    private $bookingObject;
    private $roomFacilityObject;

    public function __construct()
    {
        $this->bookingObject = new Booking();
        $this->roomFacilityObject = new RoomFacility();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->select('id', 'number', 'rate', 'type', 'situate', 'facing', 'beds')
                ->orderBy('number', 'asc')
                ->with(['bookings' => function ($query) {
                    $query->select('id', 'room_id', 'status', 'booking_id')
                        ->where('status', 1)
                        ->orderBy('id', 'desc')
                        ->get();
                }])
                ->get();
            return response()->json($rooms, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(BookingRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->bookingObject->storeBooking($request);
            $response = ['message' => 'New Booking Info Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $bookingObject = new BookingDetail();
            $booking = $this->bookingObject->getBookingWithUser($id);
            //$booking = Booking::where('hotel_id', auth()->user()->hotel_id)->findOrFail($id);
            $bookingDetails = $bookingObject->getBookingDetail($id);
            $bankPayments = BankPayment::where('Hotel_id', $id)->select('date', 'bank', 'amount')->get();
            $cashPayments = BookingPayment::where('Hotel_id', $id)->select('date', 'paid')->get();
            $mobilePayments = MobilePayment::where('Hotel_id', $id)->select('date', 'mobile_number', 'amount')->get();
            $response = [
                'booking' => $booking,
                'bookingDetails' => $bookingDetails,
                'bankPayments' => $bankPayments,
                'cashPayments' => $cashPayments,
                'mobilePayments' => $mobilePayments,
            ];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(BookingRequest $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $this->bookingObject->updateBooking($request, $id);
            $response = ['message' => 'Booking Info Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function checkout($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $serviceChargeObject = new ServiceCharge();
            $bookingObject = new BookingDetail();
            $booking = Booking::findOrFail($id);
            $bookingDetails = $bookingObject->getBookingDetail($id);
            $bankPayments = BankPayment::where('Hotel_id', $id)->select('date', 'bank', 'amount')->get();
            $cashPayments = BookingPayment::where('Hotel_id', $id)->select('date', 'paid')->get();
            $mobilePayments = MobilePayment::where('Hotel_id', $id)->select('date', 'mobile_number', 'amount')->get();
            $facilities = $this->roomFacilityObject->getRoomFacilities(1);
            $services = $serviceChargeObject->getBookingServiceCharge($booking->invoice);
            $response = ['message' => 'You have checked out successfully!!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        //
    }
}
