<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckOutPayment extends Model
{
    protected $fillable = [
        'booking_id', 'date', 'invoice', 'total_bill', 'previously_paid', 'paid', 'discount_percentage', 'discount_amount',
    ];

    public static $validateRule = [
        'booking_id'          => ['required', 'numeric'],
        'total_bill'          => ['required', 'numeric'], 
        'previously_paid'     => ['required', 'numeric'], 
        'paid'                => ['required', 'numeric'], 
        'discount_percentage' => ['nullable', 'numeric'], 
        'discount_amount'     => ['nullable', 'numeric'],
    ];

    public function storeCheckout(Object $request)
    {
        $booking = Booking::findOrFail($request->booking_id);
        $booking->checkout_date = date('Y-m-d');
        $booking->checkout_time = date('H:i:s');
        $booking->status = 0;
        $booking->save();

        if ($request->paid != 0) {

            $cash_payment = new CashPayment();
            $cash_payment->booking_id     = $request->booking_id;
            $cash_payment->date           = date('Y-m-d');
            $cash_payment->invoice        = $booking->invoice;
            $cash_payment->paid           = $request->paid;
            $cash_payment->save();
        }

        if ($request->method == 'Bank') {

            $bank = new BankPayment();
            $bank->date                 = date('Y-m-d');
            $bank->invoice              = $booking->invoice;
            $bank->method               = $request->bank_payment_type;
            $bank->bank                 = $request->bank;
            $bank->card_number          = $request->card_number;
            $bank->cheque_number        = $request->cheque_number;
            $bank->cheque_date          = date('Y-m-d', strtotime($request->cheque_date));
            $bank->acc_number           = $request->acc_number;
            $bank->deposited_acc_number = $request->deposited_acc;
            $bank->amount               = $request->other_paid;
            $bank->booking_id           = $request->booking_id;
            $bank->save();

        } elseif ($request->method == 'MFS') {

            $mobile = new MobilePayment();

            $mobile->booking_id     = $request->booking_id;
            $mobile->date           = date('Y-m-d');
            $mobile->invoice        = $booking->invoice;
            $mobile->mobile_number  = $request->mobile_number;
            $mobile->method         = $request->mfs_payment_type;
            $mobile->transaction_id = $request->transaction_id;
            $mobile->amount         = $request->other_paid;
            $mobile->save();
        }

        $this->booking_id          = $request->booking_id ;
        $this->date                = date('Y-m-d');
        $this->invoice             = $booking->invoice ;
        $this->total_bill          = $request->total_bill ;
        $this->previously_paid     = $request->previously_paid ;
        $this->paid                = $request->paid + $request->other_paid;
        $this->discount_percentage = $request->discount_percentage ;
        $this->discount_amount     = $request->discount_amount ;
        $storeCheckout = $this->save() ;

        $storeCheckout
        ? session()->flash('message', 'Checkout Successful!')
        : session()->flash('message', 'Something Went Wrong!');
    }
}
