<?php

namespace App\Http\Controllers\Admin;

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
        $vat = BookingVat::where('hotel_id', auth()->user()->hotel_id)->first();
        return view('backend.admin.vat', compact('vat'));
    }

    public function store(Request $request)
    {
        $request->validate(BookingVat::$validateRule);
        $this->bookingVatObject->storeBookingVat($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(BookingVat::$validateRule);
        $this->bookingVatObject->updateBookingVat($request, $request->id);
        return back();
    }

    public function destroy(BookingVat $bookingVat)
    {
        $this->bookingVatObject->destroyBookingVat($bookingVat);
        return back();
    }
}
