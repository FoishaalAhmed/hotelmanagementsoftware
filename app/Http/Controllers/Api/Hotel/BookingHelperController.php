<?php

namespace App\Http\Controllers\Api\Hotel;

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
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $bookingPaymentObject = new BookingPayment();
            $bookingPaymentObject->storeBookingPayment($request);
            $response = ['message' => 'Payment Successful!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function detail(BookingDetailRequest $request, $id)
    {
         //return response()->json($request, 200);
        //dd($id);
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $bookingDetailObject = new BookingDetail();
            $bookingDetailObject->storeBookingDetail($request, $id);
            $response = ['message' => 'Booking Detail Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function multiple(MultipleBookingRequest $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {

            $bookingObject = new Booking();
            $bookingObject->storeMultipleBooking($request);
            $response = ['message' => 'Booking Successfully Done!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
