<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Parking;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function booking(Request $request)
    {
        $bookingObject = new Booking();
        $start_date   = $request->start_date;
        $end_date     = $request->end_date;

        if ($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($start_date != '' || $end_date != '') {
            $bookings = $bookingObject->getBookingByDate($start_date, $end_date);
            return view('backend.admin.report.booking', compact('bookings'));
        } else {
            return view('backend.admin.report.booking');
        }
    }

    public function restaurant(Request $request)
    {
        $orderObject = new Order();
        $start_date   = $request->start_date;
        $end_date     = $request->end_date;

        if ($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($start_date != '' || $end_date != '') {
            $orders = $orderObject->getOrderByDate($start_date, $end_date);
            return view('backend.admin.report.order', compact('orders'));
        } else {
            return view('backend.admin.report.order');
        }
    }

    public function parking(Request $request)
    {
        $parkingObject = new Parking();
        $start_date   = $request->start_date;
        $end_date     = $request->end_date;

        if ($start_date != '') $start_date = date('Y-m-d', strtotime($start_date));
        if ($end_date != '')   $end_date   = date('Y-m-d', strtotime($end_date));

        if ($start_date != '' || $end_date != '') {
            $parkings = $parkingObject->getParkingByDate($start_date, $end_date);
            return view('backend.admin.report.parking', compact('parkings'));
        } else {
            return view('backend.admin.report.parking');
        }
    }
}
