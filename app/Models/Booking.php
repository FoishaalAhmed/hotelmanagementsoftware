<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;
use DB;

class Booking extends Model
{
    protected $fillable = [
        'room_id', 'checkin_date', 'checkin_time', 'checkout_date', 'checkout_time', 'client', 'phone', 'address', 'photo', 'status',
    ];

    public function getRoomWithBooking()
    {
        $roomBooking = DB::table('rooms')
            ->leftJoin('bookings', 'rooms.id', '=', 'bookings.room_id')
            ->select('rooms.id', 'rooms.number', 'rooms.rent', 'rooms.type', 'bookings.id as booking_id', 'bookings.room_id', 'bookings.checkin_date', 'bookings.checkout_date', 'bookings.client', 'bookings.phone', 'bookings.address', 'bookings.status')
            ->orderBy('bookings.id', 'desc')
            ->groupBy('rooms.id')
            ->get();
        return $roomBooking;
    }

    public function getBookingByDate($start_date, $end_date = null)
    {
        $query = $this::where('hotel_id', auth()->user()->hotel_id);
        if ($end_date == null) {
            $query->whereDate('created_at', $start_date);
        } else {
            $query->whereBetween(DB::raw('date(created_at)'), [$start_date, $end_date]);
        }

        $bookings = $query->latest()
            ->select('name', 'email', 'phone', 'address', 'room', 'adult', 'children', 'total', 'created_at')
            ->get();
        return $bookings;
    }

    public function getHotelBookingByDate($start_date, $end_date = null)
    {
        $query = $this::where('hotel_id', auth()->user()->hotel_id)
            ->where('booked_by', 0);
        if ($end_date == null) {
            $query->whereDate('created_at', $start_date);
        } else {
            $query->whereBetween(DB::raw('date(created_at)'), [$start_date, $end_date]);
        }

        $bookings = $query->latest()
            ->select('name', 'email', 'phone', 'address', 'room', 'adult', 'children', 'total', 'created_at')
            ->get();
        return $bookings;
    }

    public function amarlodgeBooking($start_date, $end_date = null)
    {
        $query = $this::where('hotel_id', auth()->user()->hotel_id)
            ->where('booked_by', 1);
        if ($end_date == null) {
            $query->whereDate('created_at', $start_date);
        } else {
            $query->whereBetween(DB::raw('date(created_at)'), [$start_date, $end_date]);
        }
        $bookings = $query->latest()
            ->select('name', 'email', 'phone', 'address', 'room', 'adult', 'children', 'total', 'created_at')
            ->get();
        return $bookings;
    }

    public function getBookingWithUser($id)
    {
        $booking = $this::leftJoin('users', 'bookings.user_id', '=', 'users.id')
            ->where('bookings.hotel_id', auth()->user()->hotel_id)
            ->where('bookings.id', $id)
            ->select('bookings.*', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone', 'users.nid as user_nid')
            ->firstOrFail();
        return $booking;
    }

    public function storeBooking(Object $request)
    {
        $booking_count  = $this::whereDate('created_at', date('Y-m-d'))->count() + 1;
        if (strlen($booking_count) == 1) $invoice = date('ymd') . '0000' . $booking_count;
        elseif (strlen($booking_count) == 2) $invoice = date('ymd') . '000' . $booking_count;
        elseif (strlen($booking_count) == 3) $invoice = date('ymd') . '00' . $booking_count;
        elseif (strlen($booking_count) == 4) $invoice = date('ymd') . '0' . $booking_count;
        else $invoice = date('ymd') . $booking_count;
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/bookings/' . $image_full_name;
            $success         = $image->storeAs('bookings', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->invoice            = $invoice;
        $this->hotel_id           = auth()->user()->hotel_id;
        $this->check_in           = date('Y-m-d', strtotime($request->check_in));
        $this->checkin_time       = date('H:i');
        if ($request->check_out != null) $this->check_out = date('Y-m-d', strtotime($request->check_out));
        $this->name               = $request->name;
        $this->phone              = $request->phone;
        $this->email              = $request->email;
        $this->address            = $request->address;
        $this->adult              = $request->adult;
        $this->children           = $request->children;
        $this->nid_number         = $request->nid_number;
        $this->total              = $request->total;
        $this->room               = 1;
        $this->payment_method     = $request->payment_method;
        $this->rent               = $request->rent;
        $this->vat                = $request->vat;
        $this->vat_amount         = $request->vat_amount;
        $this->subtotal           = $request->subtotal;
        $this->discount           = $request->discount;
        $this->total              = $request->total;
        $this->status             = 1;
        $storeBooking             = $this->save();
        $booking_id               = $this->id;

        $bookingDetail = new BookingDetail();
        $bookingDetail->booking_id = $booking_id;
        $bookingDetail->hotel_id           = auth()->user()->hotel_id;
        $bookingDetail->invoice            = $invoice;
        $bookingDetail->room_id = $request->room_id;
        $bookingDetail->person = $request->adult + $request->children;
        $bookingDetail->name = $request->name;
        $bookingDetail->check_in = date('Y-m-d', strtotime($request->check_in));
        if ($request->check_out != null) $bookingDetail->check_out = date('Y-m-d', strtotime($request->check_out));
        $bookingDetail->status = 1;
        $bookingDetail->save();

        if ($request->payment_method == 'Cash') {

            $booking_payment = new BookingPayment();
            $booking_payment->booking_id = $booking_id;
            $booking_payment->hotel_id           = auth()->user()->hotel_id;
            $booking_payment->date       = date('Y-m-d');
            $booking_payment->invoice    = $invoice;
            $booking_payment->paid       = $request->paid;
            $booking_payment->save();
        } elseif ($request->payment_method == 'Bank') {

            $bank = new BankPayment();
            $bank->date                 = date('Y-m-d');
            $bank->hotel_id           = auth()->user()->hotel_id;
            $bank->invoice              = $invoice;
            $bank->method               = $request->bank_payment_type;
            $bank->bank                 = $request->bank;
            $bank->card_number          = $request->card_number;
            $bank->cheque_number        = $request->cheque_number;
            $bank->cheque_date          = date('Y-m-d', strtotime($request->cheque_date));
            $bank->acc_number           = $request->acc_number;
            $bank->deposited_acc_number = $request->deposited_acc;
            $bank->amount               = $request->paid;
            $bank->booking_id           = $booking_id;
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
            $mobile->booking_id     = $booking_id;
            $mobile->hotel_id           = auth()->user()->hotel_id;
            $mobile->date           = date('Y-m-d');
            $mobile->invoice        = $invoice;
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

        $storeBooking
            ? Session::flash('message', 'Booking Successfully Done!')
            : Session::flash('message', 'Something Went Wrong!');
    }

    public function storeMultipleBooking(Object $request)
    {
        //dd($request);
        $booking_count  = $this::whereDate('created_at', date('Y-m-d'))->count() + 1;
        if (strlen($booking_count) == 1) $invoice = date('ymd') . '0000' . $booking_count;
        elseif (strlen($booking_count) == 2) $invoice = date('ymd') . '000' . $booking_count;
        elseif (strlen($booking_count) == 3) $invoice = date('ymd') . '00' . $booking_count;
        elseif (strlen($booking_count) == 4) $invoice = date('ymd') . '0' . $booking_count;
        else $invoice = date('ymd') . $booking_count;
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/bookings/' . $image_full_name;
            $success         = $image->storeAs('bookings', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->invoice            = $invoice;
        $this->check_in           = date('Y-m-d', strtotime($request->check_in));
        $this->checkin_time       = date('H:i');
        if ($request->check_out != null) $this->check_out = date('Y-m-d', strtotime($request->check_out));
        $this->hotel_id           = auth()->user()->hotel_id;
        $this->name               = $request->client;
        $this->phone              = $request->phone;
        $this->email              = $request->email;
        $this->adult              = $request->adult;
        $this->children           = $request->children;
        $this->nid_number         = $request->nid_number;
        $this->total              = $request->total;
        $this->room               = $request->room;
        $this->payment_method     = $request->payment_method;
        $this->rent               = $request->rent;
        $this->vat                = $request->vat;
        $this->vat_amount         = $request->vat_amount;
        $this->subtotal           = $request->subtotal;
        $this->discount           = $request->discount;
        $this->total              = $request->total;
        $this->status             = 1;
        $storeBooking             = $this->save();
        $booking_id               = $this->id;

        foreach ($request->room_id as $key => $value) {
            if ($value == null) continue;
            $data[] = [
                'booking_id' => $booking_id,
                'hotel_id' => auth()->user()->hotel_id,
                'invoice'  => $invoice,
                'room_id' => $value,
                'person' => $request->person[$key],
                'name' => $request->name[$key],
                'check_in' => date('Y-m-d', strtotime($request->check_in)),
                'check_out' => date('Y-m-d', strtotime($request->check_out)),
                'status' => 1,
            ];
        }

        BookingDetail::insert($data);

        if ($request->payment_method == 'Cash') {

            $booking_payment = new BookingPayment();
            $booking_payment->booking_id = $booking_id;
            $booking_payment->hotel_id = auth()->user()->hotel_id;
            $booking_payment->date       = date('Y-m-d');
            $booking_payment->invoice    = $invoice;
            $booking_payment->paid       = $request->paid;
            $booking_payment->save();
        } elseif ($request->payment_method == 'Bank') {

            $bank = new BankPayment();
            $bank->date                 = date('Y-m-d');
            $bank->invoice              = $invoice;
            $bank->method               = $request->bank_payment_type;
            $bank->bank                 = $request->bank;
            $bank->card_number          = $request->card_number;
            $bank->cheque_number        = $request->cheque_number;
            $bank->cheque_date          = date('Y-m-d', strtotime($request->cheque_date));
            $bank->acc_number           = $request->acc_number;
            $bank->deposited_acc_number = $request->deposited_acc;
            $bank->amount               = $request->paid;
            $bank->booking_id           = $booking_id;
            $bank->hotel_id = auth()->user()->hotel_id;
            $bank->save();
        } elseif ($request->payment_method == 'MFS') {

            $mobile = new MobilePayment();
            $mobile->booking_id     = $booking_id;
            $mobile->hotel_id = auth()->user()->hotel_id;
            $mobile->date           = date('Y-m-d');
            $mobile->invoice        = $invoice;
            $mobile->mobile_number  = $request->mobile_number;
            $mobile->method         = $request->mfs_payment_type;
            $mobile->transaction_id = $request->transaction_id;
            $mobile->amount         = $request->paid;
            $mobile->save();
        }

        $storeBooking
            ? Session::flash('message', 'Booking Successfully Done!')
            : Session::flash('message', 'Something Went Wrong!');
    }

    public function updateBooking(Object $request, Int $id)
    {
        $booking = $this::findOrFail($id);
        $image = $request->file('photo');

        if ($image) {

            if (file_exists($booking->photo)) unlink($booking->photo);

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/bookings/' . $image_full_name;
            $success         = $image->storeAs('bookings', $image_full_name, 'parent_disk');
            $user->photo     = $image_url;
        }

        $booking->check_in           = date('Y-m-d', strtotime($request->check_in));
        $booking->checkin_time       = date('H:i');
        if ($request->check_out != null) $booking->check_out = date('Y-m-d', strtotime($request->check_out));
        $booking->name               = $request->name;
        $booking->hotel_id = auth()->user()->hotel_id;
        $booking->phone              = $request->phone;
        $booking->email              = $request->email;
        $booking->address            = $request->address;
        $booking->adult              = $request->adult;
        $booking->children           = $request->children;
        $booking->nid_number         = $request->nid_number;
        $booking->total              = $request->total;
        $booking->room               = $request->room;
        $booking->payment_method     = $request->payment_method;
        $booking->rent               = $request->rent;
        $booking->vat                = $request->vat;
        $booking->vat_amount         = $request->vat_amount;
        $booking->subtotal           = $request->subtotal;
        $booking->discount           = $request->discount;
        $booking->total              = $request->total;
        $updateBooking                = $booking->save();

        $updateBooking
            ? Session::flash('message', 'Booking Updated Successfully!')
            : Session::flash('message', 'Something Went Wrong!');
    }

    public function checkOutBooking(Int $id)
    {
        $booking                = $this::findOrFail($id);
        $booking->checkout_date = date('Y-m-d');
        $booking->checkout_time = date('H:i');
        $booking->status        = 2;
        $checkOutBooking        = $booking->save();

        $checkOutBooking
            ? Session::flash('message', 'Booking Checkout Successful!')
            : Session::flash('message', 'Something Went Wrong!');
    }
}
