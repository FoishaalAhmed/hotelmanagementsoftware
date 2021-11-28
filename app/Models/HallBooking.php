<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'hall_id', 'booking_id', 'room_id', 'name', 'phone', 'email', 'address', 'type', 'start_time', 'end_time', 'start_date', 'end_date', 'rent', 'payment_method', 'paid',
    ];

    public function getHallBooking()
    {
        $bookings = $this::where('hall_bookings.hotel_id', auth()->user()->hotel_id)
            ->join('halls', 'hall_bookings.hall_id', '=', 'halls.id')
            ->leftJoin('rooms', 'hall_bookings.room_id', '=', 'rooms.id')
            ->orderBy('hall_bookings.id', 'desc')
            ->select('hall_bookings.*', 'halls.name as hall', 'rooms.number')
            ->get();

        return $bookings;
    }

    public function storeHallBooking(Object $request)
    {
        $booking_id = null;
        if ($request->type == 'In House') {
            $booking_id = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->latest()->firstOrFail()->booking_id;
        }
        $this->hotel_id = auth()->user()->hotel_id;
        $this->hall_id = $request->hall_id;
        $this->booking_id = $booking_id;
        $this->room_id = $request->room_id;
        $this->name = $request->name;
        $this->phone = $request->phone;
        $this->email = $request->email;
        $this->address = $request->address;
        $this->type = $request->type;
        $this->booking_type = $request->booking_type;
        $this->start_time = $request->booking_type == 'Hourly' ? date('H:i:s', strtotime($request->start_time)) : null;
        $this->end_time = $request->booking_type == 'Hourly' ? date('H:i:s', strtotime($request->end_time)) : null;
        $this->start_date = $request->booking_type == 'Daily' ? date('Y-m-d', strtotime($request->start_date)) : null;
        $this->end_date = $request->booking_type == 'Daily' ? date('Y-m-d', strtotime($request->end_date)) : null;

        $this->rent = $request->rent;
        $this->payment_method = $request->payment_method;
        $this->paid = $request->paid;
        $storeHallBooking = $this->save();

        if ($request->payment_method == 'Bank') {

            $bankTransaction = new BankTransaction();
            $bankTransaction->hotel_id = auth()->user()->hotel_id;
            $bankTransaction->bank_id = $request->bank;
            $bankTransaction->date = date('Y-m-d');
            $bankTransaction->type = 'Deposit';
            $bankTransaction->booking_payment = 1;
            $bankTransaction->amount = $request->paid;
            $bankTransaction->note = 'Hall Booking Payment';
            $bankTransaction->save();
        } elseif ($request->payment_method == 'MFS') {

            $mobileTransaction = new MobileTransaction();
            $mobileTransaction->hotel_id = auth()->user()->hotel_id;
            $mobileTransaction->mobile_bank_id = $request->mfs_payment_type;
            $mobileTransaction->date = date('Y-m-d');
            $mobileTransaction->type = 'Cash In';
            $mobileTransaction->amount = $request->paid;
            $mobileTransaction->booking_payment = 1;
            $mobileTransaction->note = 'Hall Booking Payment';
            $mobileTransaction->save();
        }

        $storeHallBooking
            ? session()->flash('message', 'Hall Booked Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHallBooking(Object $booking)
    {
        $destroyHallBooking = $booking->delete();

        $destroyHallBooking
            ? session()->flash('message', 'Hall Booking Info Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
