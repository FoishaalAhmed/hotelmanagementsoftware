<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ServiceCharge extends Model
{
    protected $fillable = [
        'booking_id', 'service_id', 'invoice', 'date', 'charge', 'paid', 'hotel_id',
    ];

    public static $validateRule = [
        'room_number'=> ['required', 'string', 'max:255'],
        'service_id' => ['required', 'numeric'],
        'charge'     => ['required', 'numeric'],
        'paid'       => ['nullable', 'numeric'],
    ];

    public function getBookingServiceCharge(Int $id)
    {
        $services = DB::table('service_charges')
                        ->join('services', 'service_charges.service_id', '=', 'services.id')
                        ->where('service_charges.booking_id', $id)
                        ->select('service_charges.date', 'service_charges.charge', 'service_charges.paid', 'services.name')
                        ->orderBy('service_charges.date', 'desc')
                        ->get();
        return $services;
    }

    public function storeServiceCharge(Object $request, Object $booking)
    {
        $this->hotel_id = auth()->user()->hotel_id;
        $this->booking_id = $booking->booking_id ;
        $this->service_id = $request->service_id ;
        $this->invoice    = $booking->invoice ;
        $this->date       = date('Y-m-d') ;
        $this->charge     = $request->charge ;
        $this->paid       = $request->paid ;
        $storeServiceCharge = $this->save() ;

        if ($request->payment_method == 'Bank') {
            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = 'Deposit';
            $bankTransaction->amount = $request->paid;
            $bankTransaction->note = 'Service Charge Payment';
            $bankTransaction->save();
        } elseif ($request->payment_method == 'MFS') {

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash Out';
            $mobileTransaction->amount = $request->paid;
            $mobileTransaction->note = 'Service Charge Payment';
            $mobileTransaction->save();
        }

        $storeServiceCharge 
        ? session()->flash('message', 'Charge Stored Successfully!')
        : session()->flash('message', 'Something Went Wrong!') ;
    }


}
