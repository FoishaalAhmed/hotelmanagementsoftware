<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $couponObject;

    public function __construct()
    {
        $this->couponObject = new Coupon();
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('backend.admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('backend.admin.coupons.create');
    }

    public function store(Request $request)
    {
        $request->validate(Coupon::$validateRule);
        $this->couponObject->storeCoupon($request);
        return back();
    }

    public function edit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Coupon::$validateRule);
        $this->couponObject->updateCoupon($request, $id);
        return redirect()->route('admin.coupons.index');
    }

    public function destroy($id)
    {
        $this->couponObject->destroyCoupon($id);
        return back();
    }
}
