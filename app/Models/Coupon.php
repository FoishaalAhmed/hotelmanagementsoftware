<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'amount', 'expire', 'status',
    ];

    public static $validateRule = [
        'code' => ['required', 'string', 'max:25'],
        'amount' => ['required', 'numeric'],
        'expire' => ['required', 'date'],
        'status' => ['required', 'numeric']
    ];

    public function storeCoupon(Object $request)
    {
        $this->code = $request->code;
        $this->amount = $request->amount;
        $this->expire = date('Y-m-d', strtotime($request->expire));
        $this->status = $request->status;
        $storeCoupon = $this->save();

        $storeCoupon
            ? session()->flash('message', 'Coupon Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateCoupon(Object $request, Int $id)
    {
        $coupon = $this::findOrFail($id);
        $coupon->code = $request->code;
        $coupon->amount = $request->amount;
        $coupon->expire = date('Y-m-d', strtotime($request->expire));
        $coupon->status = $request->status;
        $updateCoupon = $coupon->save();

        $updateCoupon
            ? session()->flash('message', 'Coupon Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyCoupon(Int $id)
    {
        $coupon = $this::findOrFail($id);
        $destroyCoupon = $coupon->delete();

        $destroyCoupon
            ? session()->flash('message', 'Coupon Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
