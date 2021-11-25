<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'charge_id', 'ticket', 'vehicle', 'registration_number', 'in_time', 'out_time', 'charge', 'room_id', 'user_id', 'remark', 'status'
    ];

    public static $validateRule = [
        'charge_id' => ['required', 'numeric', 'min:1'],
        'vehicle' => ['required', 'string', 'max:255'],
        'registration_number' => ['required', 'string', 'max:255'],
        //'in_time' => ['required',],
        //'out_time' => ['nullable', 'after:in_time'],
        //'charge' => ['required', 'numeric', 'min:1'],
        'room_id' => ['nullable', 'numeric', 'min:1'],
        'remark' => ['nullable', 'string', 'max:255'],
    ];

    public function getAllParking()
    {
        $parkings = $this::join('charges', 'parkings.charge_id', '=', 'charges.id')
            ->join('vehicle_categories', 'charges.category', '=', 'vehicle_categories.id')
            ->leftJoin('rooms', 'parkings.room_id', '=', 'rooms.id')
            ->where('parkings.hotel_id', auth()->user()->hotel_id)
            ->orderBy('parkings.created_at', 'desc')
            ->select('parkings.*', 'rooms.number', 'charges.type', 'vehicle_categories.name')
            ->get();
        return $parkings;
    }
    
    public function getAllBookingParking($booking_id)
    {
        $parkings = $this::join('charges', 'parkings.charge_id', '=', 'charges.id')
            ->join('rooms', 'parkings.room_id', '=', 'rooms.id')
            ->where('parkings.hotel_id', auth()->user()->hotel_id)
            ->where('parkings.booking_id', $booking_id)
            ->orderBy('parkings.created_at', 'desc')
            ->select('parkings.*', 'rooms.number', 'charges.category')
            ->get();
        return $parkings;
    }

    public function getParkingByDate($start_date, $end_date)
    {
        $parkings = $this::join('charges', 'parkings.charge_id', '=', 'charges.id')
            ->join('rooms', 'parkings.room_id', '=', 'rooms.id')
            ->where('parkings.hotel_id', auth()->user()->hotel_id)
            ->whereBetween(DB::raw('DATE(parkings.created_at)'), [$start_date, $end_date])
            ->orderBy('parkings.created_at', 'desc')
            ->select('parkings.*', 'rooms.number', 'charges.category')
            ->get();
        return $parkings;
    }

    public function storeParking(Object $request)
    {
        $parking_count  = $this::whereDate('created_at', date('Y-m-d'))->count() + 1;
        if (strlen($parking_count) == 1) $ticket = date('ymd') . '0000' . $parking_count;
        elseif (strlen($parking_count) == 2) $ticket = date('ymd') . '000' . $parking_count;
        elseif (strlen($parking_count) == 3) $ticket = date('ymd') . '00' . $parking_count;
        elseif (strlen($parking_count) == 4) $ticket = date('ymd') . '0' . $parking_count;
        else $ticket = date('ymd') . $parking_count;

        $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->first();
        $this->hotel_id = auth()->user()->hotel_id;
        $this->vehicle_category_id  = $request->category_id;
        $this->charge_id = $request->charge_id;
        $this->ticket = $ticket;
        $this->vehicle = $request->vehicle;
        $this->registration_number = $request->registration_number;
        $this->in_time = date('H:i:s');
        $this->room_id = $request->room_id;
        $this->user_id = $booking != null ? $booking->user_id : null ;
        $this->booking_id = $booking != null ? $booking->booking_id : null ;
        $this->remark = $request->remark;
        $this->status = 1;
        $storeParking = $this->save();

        $storeParking
            ? session()->flash('message', 'New Parking Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateParking(Object $request, Int $id)
    {
        $parking = $this::findOrFail($id);
        $parking->hotel_id = auth()->user()->hotel_id;
        $parking->charge_id = $request->charge_id;
        $parking->vehicle_category_id = $request->category_id;
        $parking->vehicle = $request->vehicle;
        $parking->registration_number = $request->registration_number;
        $parking->out_time = $request->out_time != null ? date('H:i', strtotime($request->out_time)) : null;
        $parking->charge = $request->charge;
        $parking->room_id = $request->room_id;
        $parking->remark = $request->remark;
        $parking->method = $request->payment_method;
        $parking->paid = $request->paid;
        $parking->status = $request->status;
        $updateParking = $parking->save();

        if ($request->payment_method == 'Bank') {

            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = 'Deposit';
            $bankTransaction->booking_payment = 1;
            $bankTransaction->amount = $request->paid;
            $bankTransaction->note = 'Parking Charge Payment';
            $bankTransaction->save();
        } elseif ($request->payment_method == 'MFS') {

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash In';
            $mobileTransaction->amount = $request->paid;
            $mobileTransaction->booking_payment = 1;
            $mobileTransaction->note = 'Parking Charge Payment';
            $mobileTransaction->save();
        }

        $updateParking
            ? session()->flash('message', 'Parking Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyParking(Int $id)
    {
        $parking = $this::findOrFail($id);
        $destroyParking = $parking->delete();

        $destroyParking
            ? session()->flash('message', 'Parking Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
