<?php

namespace App\Http\Controllers\Api\Hall;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallBookingRequest;
use App\Models\HallBooking;

class HallBookingController extends Controller
{
    protected $hallBookingObject;

    public function __construct()
    {
        $this->hallBookingObject = new HallBooking();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $bookings = $this->hallBookingObject->getHallBooking();
            return response()->json($bookings, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(HallBookingRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $this->hallBookingObject->storeHallBooking($request);
            $response = ['message' => 'Hall Booked Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy(HallBooking $hallBooking)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hall')) {
            $this->hallBookingObject->destroyHallBooking($hallBooking);
            $response = ['message' => 'Hall Booking Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
