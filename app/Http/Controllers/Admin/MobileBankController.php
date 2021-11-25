<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobileBank;
use Illuminate\Http\Request;

class MobileBankController extends Controller
{
    private $mobileBankObject;

    public function __construct()
    {
        $this->mobileBankObject = new MobileBank();
    }

    public function index()
    {
        $banks = MobileBank::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.mobileBank', compact('banks'));
    }

    public function store(Request $request)
    {
        $request->validate(MobileBank::$validateRule);
        $this->mobileBankObject->storeMobileBank($request);
        return back();
    }

    public function update(Request $request)
    {
        $request->validate(MobileBank::$validateRule);
        $this->mobileBankObject->updateMobileBank($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->mobileBankObject->destroyMobileBank($id);
        return back();
    }
}
