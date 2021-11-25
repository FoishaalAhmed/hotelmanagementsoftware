<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function combineBooking(Request $request)
    {
        $bookingObject = new Booking();
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date     = $request->end_date;
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));
        $bookings = $bookingObject->getBookingByDate($start_date, $end_date);
        return response($bookings, 200);
    }

    public function hotelBooking(Request $request)
    {
        $bookingObject = new Booking();
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date     = $request->end_date;
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));
        $bookings = $bookingObject->getHotelBookingByDate($start_date, $end_date);
        return response($bookings, 200);
    }

    public function amarlodgeBooking(Request $request)
    {
        $bookingObject = new Booking();
        $start_date = date('Y-m-d', strtotime($request->start_date));
        $end_date     = $request->end_date;
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));
        $bookings = $bookingObject->getAmarlodgeBookingByDate($start_date, $end_date);
        return response($bookings, 200);
    }

    public function restaurant(Request $request)
    {
        $orderObject = new Order();
        $start_date   = $request->start_date;
        $end_date     = $request->end_date;
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));
        $orders = $orderObject->getOrderByDate($start_date, $end_date);
        return response($orders, 200);
    }
}
