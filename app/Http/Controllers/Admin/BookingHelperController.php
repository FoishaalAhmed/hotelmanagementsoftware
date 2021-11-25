<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingDetailRequest;
use App\Http\Requests\MultipleBookingRequest;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\BookingPayment;
use Illuminate\Http\Request;

class BookingHelperController extends Controller
{
    public function payment(Request $request)
    {
        $bookingPaymentObject = new BookingPayment();
        $bookingPaymentObject->storeBookingPayment($request);
        return back();
    }

    public function detail(BookingDetailRequest $request, $id)
    {
        $bookingDetailObject = new BookingDetail();
        $bookingDetailObject->storeBookingDetail($request, $id);
        return back();
    }

    public function multiple(MultipleBookingRequest $request)
    {
        $bookingObject = new Booking();
        $bookingObject->storeMultipleBooking($request);
        return back();
    }
}
