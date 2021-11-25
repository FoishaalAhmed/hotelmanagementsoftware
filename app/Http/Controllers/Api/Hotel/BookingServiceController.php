<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\HotelService;
use App\Models\Room;
use App\Models\ServiceCharge;
use Illuminate\Http\Request;

class BookingServiceController extends Controller
{
    private $ServiceChargeObject;

    public function __construct()
    {
        $this->ServiceChargeObject = new ServiceCharge();
    }

    public function index()
    {
        $hotelServiceObject = new HotelService();
        $services = $hotelServiceObject->getHotelChargeApplicableServicesByHotelId(auth()->user()->hotel_id);
        return response($services, 200);
    }

    public function store(Request $request)
    {
        $room_id = Room::where('hotel_id', auth()->user()->hotel_id)->where('number', $request->room_number)->firstOrFail()->id;
        $booking = BookingDetail::where('room_id', $room_id)->select('id', 'invoice', 'status', 'booking_id')->orderBy('id', 'desc')->first();

        if ($booking == null || $booking->status != 1) {

            $response = [
                'message' => 'This Room is not Currently Booked. Please Check The Room Number Again'
            ];

            return response($response, 404);
        }

        $request->validate(ServiceCharge::$validateRule);
        $this->ServiceChargeObject->storeServiceCharge($request, $booking);

        $response = [
            'message' => 'Charge Stored Successfully!'
        ];

        return response($response, 404);
    }
}
