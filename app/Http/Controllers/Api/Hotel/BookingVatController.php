<?php

namespace App\Http\Controllers\Api\Hotel;

use App\Http\Controllers\Controller;
use App\Models\BookingVat;
use Illuminate\Http\Request;

class BookingVatController extends Controller
{
    private $bookingVatObject;

    public function __construct()
    {
        $this->bookingVatObject = new BookingVat();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $vat = BookingVat::where('hotel_id', auth()->user()->hotel_id)->first();
            return response()->json($vat, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(BookingVat::$validateRule);
            $this->bookingVatObject->storeBookingVat($request);
            $response = ['message' => 'New Booking Vat Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $vat = BookingVat::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->firstOrFail();
            return response()->json($vat, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $request->validate(BookingVat::$validateRule);
            $this->bookingVatObject->updateBookingVat($request, $id);
            $response = ['message' => 'Booking Vat Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Hotel')) {
            $this->bookingVatObject->destroyBookingVat($id);
            $response = ['message' => 'Booking Vat Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
