<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    protected $fillable = [
        'booking_id', 'date', 'invoice', 'paid',
    ];

    public function storeBookingPayment(Object $request)
    {
        if ($request->payment_method == 'Cash') {

            $this->hotel_id       = auth()->user()->hotel_id;
            $this->booking_id     = $request->booking_id;
            $this->date           = date('Y-m-d');
            $this->invoice        = $request->invoice;
            $this->paid           = $request->paid;
            $this->save();

        } elseif ($request->payment_method == 'Bank') {

            $bank = new BankPayment();
            $bank->date                 = date('Y-m-d');
            $bank->invoice              = $request->invoice;
            $bank->method               = $request->bank_payment_type;
            $bank->bank                 = $request->bank;
            $bank->card_number          = $request->card_number;
            $bank->cheque_number        = $request->cheque_number;
            $bank->cheque_date          = date('Y-m-d', strtotime($request->cheque_date));
            $bank->acc_number           = $request->acc_number;
            $bank->deposited_acc_number = $request->deposited_acc;
            $bank->amount               = $request->paid;
            $bank->booking_id           = $request->booking_id;
            $bank->hotel_id             = auth()->user()->hotel_id;
            $bank->save();

            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = $request->type;
            $bankTransaction->booking_payment = 1;
            $bankTransaction->amount = $request->paid;
            $bankTransaction->note = 'Room Booking Payment';
            $bankTransaction->save();  

        } elseif ($request->payment_method == 'MFS') {

            $mobile = new MobilePayment();
            $mobile->booking_id     = $request->booking_id;
            $mobile->hotel_id       = auth()->user()->hotel_id;
            $mobile->date           = date('Y-m-d');
            $mobile->invoice        = $request->invoice;
            $mobile->mobile_number  = $request->mobile_number;
            $mobile->method         = $request->mfs_payment_type;
            $mobile->transaction_id = $request->transaction_id;
            $mobile->amount         = $request->paid;
            $mobile->save();

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash In';
            $mobileTransaction->amount = $request->paid;
            $mobileTransaction->booking_payment = 1;
            $mobileTransaction->note = 'Room Booking Payment';
            $mobileTransaction->save();
        }

        if ($request->has('checkout') && $request->checkout == 'yes') {
            Booking::where('id', $request->booking_id)->update(['status' => 3, 'checkout_time' => date('H:i')]);
            BookingDetail::where('booking_id', $request->booking_id)->update(['status' => 3]);
            session()->flash('message', 'Check Out Complete!');
        } else {
            session()->flash('message', 'Payment Successful!');
        }
    }
}
