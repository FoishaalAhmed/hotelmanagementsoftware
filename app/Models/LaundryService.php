<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryService extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'booking_id', 'room_id', 'charge', 'method', 'paid',
    ];

    public function getLaundryServices()
    {
        $services = $this->join('rooms', 'laundry_services.room_id', '=', 'rooms.id')
                         ->where('laundry_services.hotel_id', auth()->user()->hotel_id)
                         ->orderBy('rooms.number', 'asc')
                         ->select('laundry_services.*', 'rooms.number')
                         ->get();
        return $services;
    }

    public function storeLaundryService(Object $request)
    {
        $booking_id = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->first()->booking_id;
        $this->hotel_id = auth()->user()->hotel_id;
        $this->booking_id = $booking_id;
        $this->room_id = $request->room_id;
        $this->charge = $request->charge;
        $this->method = $request->payment_method;
        $this->paid = $request->paid;
        $this->save();

        if ($request->total != null) {
            foreach ($request->total as $key => $value) {
                if ($value == 0) continue;
                $data[] = [
                    'hotel_id' => auth()->user()->hotel_id,
                    'laundry_service_id' => $this->id,
                    'laundry_product_id' => $request->laundry_product_id[$key],
                    'type' => $request->type[$key],
                    'quantity' => $request->quantity[$key],
                    'charge' => $request->rate[$key],
                    'total' => $value,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            LaundryServiceDetail::insert($data);
        }

        if ($request->payment_method == 'Bank') {

            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = 'Deposit';
            $bankTransaction->booking_payment = 1;
            $bankTransaction->amount = $request->paid;
            $bankTransaction->note = 'Laundry Service Payment';
            $bankTransaction->save();
        } elseif ($request->payment_method == 'MFS') {

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash In';
            $mobileTransaction->amount = $request->paid;
            $mobileTransaction->booking_payment = 1;
            $mobileTransaction->note = 'Laundry Service Payment';
            $mobileTransaction->save();
        }

        session()->flash('message', 'New Laundry Service Request Stored!');
    }

    public function destroyLaundryService(Object $service)
    {
        $destroyLaundryService = $service->save();

        $destroyLaundryService
            ? session()->flash('message', 'Laundry Service Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
