<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CheckOutPayment;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private $checkOutPaymentObject;

    public function __construct()
    {
        $this->checkOutPaymentObject = new CheckOutPayment();
    }

    public function store(Request $request)
    {
        $request->validate(CheckOutPayment::$validateRule);
        $this->checkOutPaymentObject->storeCheckout($request);
        return redirect()->route('admin.booking.index');
    }
}
