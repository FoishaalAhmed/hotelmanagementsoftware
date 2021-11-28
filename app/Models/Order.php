<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $fillable = [
        'date', 'time', 'invoice',  'hotel_id', 'room_id', 'table_id',  'user_id', 'subtotal', 'vat',  'discount', 'total', 'paid', 'method',
    ];

    public static $validateRule = [
        'room_id' => ['required', 'numeric', 'min:1'],
        'table_id' => ['nullable', 'numeric', 'min:1'],
        'subtotal' => ['required', 'numeric', 'min:1'],
        'vat' => ['required', 'numeric', 'min:1'],
        'discount' => ['nullable', 'numeric', 'min:1'],
        'grand_total' => ['required', 'numeric', 'min:1'],
        'paid' => ['nullable', 'numeric', 'min:1'],
        'payment_method' => ['nullable', 'string', 'max:4'],
        'bank_payment_type' => ['required_if:payment_method,==,Bank', 'nullable', 'max:4'],
        'bank' => ['required_if:payment_method,==,Bank', 'nullable', 'max:255'],
        'card_number' => ['required_if:bank_payment_type,==,Card', 'nullable', 'max:255'],
        'cheque_number' => ['required_if:bank_payment_type,==,Cheque', 'nullable', 'max:255'],
        'cheque_date' => ['required_if:bank_payment_type,==,Cheque', 'nullable'],
        'mfs_payment_type' => ['required_if:payment_method,==,MFS', 'nullable', 'max:15'],
        'mobile_number' => ['required_if:payment_method,==,MFS', 'nullable', 'max:15'],
        'transaction_id' => ['required_if:payment_method,==,MFS', 'nullable', 'max:25'],
        'item_id.*' => ['required', 'numeric', 'min:1'],
        'price.*' => ['required', 'numeric', 'min:1'],
        'quantity.*' => ['required', 'numeric', 'min:1'],
        'total.*' => ['required', 'numeric', 'min:1'],
    ];

    public function getHotelOrders()
    {
        $orders = $this::join('rooms', 'orders.room_id', '=', 'rooms.id')
            ->leftJoin('tables', 'orders.table_id', '=', 'tables.id')
            ->where('orders.hotel_id', auth()->user()->hotel_id)
            ->orderBy('orders.created_at', 'desc')
            ->select('orders.*', 'rooms.number as room', 'tables.number as table')
            ->get();
        return $orders;
    }
    
    public function getBookingHotelOrders($booking_id)
    {
        $orders = $this::join('rooms', 'orders.room_id', '=', 'rooms.id')
            ->leftJoin('tables', 'orders.table_id', '=', 'tables.id')
            ->where('orders.hotel_id', auth()->user()->hotel_id)
            ->where('orders.booking_id', $booking_id)
            ->orderBy('orders.created_at', 'desc')
            ->select('orders.*', 'rooms.number as room', 'tables.number as table')
            ->get();
        return $orders;
    }

    public function getHotelOrderByID($id)
    {
        $order = $this::join('rooms', 'orders.room_id', '=', 'rooms.id')
            ->leftJoin('tables', 'orders.table_id', '=', 'tables.id')
            ->where('orders.hotel_id', auth()->user()->hotel_id)
            ->where('orders.id', $id)
            ->orderBy('orders.created_at', 'desc')
            ->select('orders.*', 'rooms.number as room', 'tables.number as table')
            ->first();
        return $order;
    }
    
    public function getOrderByDate($start_date, $end_date = null)
    {
        $query = $this::join('rooms', 'orders.room_id', '=', 'rooms.id')
            ->leftJoin('tables', 'orders.table_id', '=', 'tables.id')
            ->where('orders.hotel_id', auth()->user()->hotel_id);

            if ($end_date == null) {
                $query->whereDate('date', $start_date);
            } else {
                $query->whereBetween('date', [$start_date, $end_date]);
            }

        $orders = $query->orderBy('orders.created_at', 'desc')
            ->select('orders.*', 'rooms.number as room', 'tables.number as table')
            ->get();
        return $orders;
    }

    public function storeOrder(Object $request)
    {
        DB::transaction(function () use ($request) {

            $count  = $this::whereDate('created_at', date('Y-m-d'))->count() + 1;
            if (strlen($count) == 1) $invoice = date('ymd') . '0000' . $count;
            elseif (strlen($count) == 2) $invoice = date('ymd') . '000' . $count;
            elseif (strlen($count) == 3) $invoice = date('ymd') . '00' . $count;
            elseif (strlen($count) == 4) $invoice = date('ymd') . '0' . $count;
            else $invoice = date('ymd') . $count;
            $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->first();
            $this->date = date('Y-m-d');
            $this->time = date('H:i');
            $this->invoice = $invoice;
            $this->hotel_id = auth()->user()->hotel_id;
            $this->room_id = $request->room_id;
            $this->table_id = $request->table_id;
            $this->user_id = $booking->user_id;
            $this->booking_id = $booking->booking_id;
            $this->subtotal = $request->subtotal;
            $this->vat = $request->vat;
            $this->discount = $request->discount;
            $this->total = $request->grand_total;
            $this->paid = $request->paid;
            $this->method = $request->payment_method;
            $this->save();
            $order_id = $this->id;
            foreach ($request->item_id as $key => $value) {
                $data[] = [
                    'order_id' => $order_id,
                    'invoice' => $invoice,
                    'hotel_id' => auth()->user()->hotel_id,
                    'item_id' => $value,
                    'quantity' => $request->quantity[$key],
                    'price' => $request->price[$key],
                    'total' => $request->total[$key],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];
            }
            OrderDetail::insert($data);

            if ($request->payment_method == 'Cash' && $request->paid != null) {

                $booking_payment = new BookingPayment();
                $booking_payment->booking_id = $booking->booking_id;
                $booking_payment->order_id = $order_id;
                $booking_payment->hotel_id = auth()->user()->hotel_id;
                $booking_payment->date       = date('Y-m-d');
                $booking_payment->invoice    = $invoice;
                $booking_payment->paid       = $request->paid;
                $booking_payment->save();
                
            } elseif ($request->payment_method == 'Bank' && $request->paid != null) {

                $bank = new BankPayment();
                $bank->date                 = date('Y-m-d');
                $bank->invoice              = $invoice;
                $bank->order_id             = $order_id;
                $bank->method               = $request->bank_payment_type;
                $bank->bank                 = $request->bank;
                $bank->card_number          = $request->card_number;
                $bank->cheque_number        = $request->cheque_number;
                $bank->cheque_date          = date('Y-m-d', strtotime($request->cheque_date));
                $bank->acc_number           = $request->acc_number;
                $bank->deposited_acc_number = $request->deposited_acc;
                $bank->amount               = $request->paid;
                $bank->booking_id           = $booking->booking_id;
                $bank->hotel_id = auth()->user()->hotel_id;
                $bank->save();
            } elseif ($request->payment_method == 'MFS' && $request->paid != null) {

                $mobile = new MobilePayment();
                $mobile->booking_id     = $booking->booking_id;
                $mobile->hotel_id = auth()->user()->hotel_id;
                $mobile->date           = date('Y-m-d');
                $mobile->order_id       = $order_id;
                $mobile->invoice        = $invoice;
                $mobile->mobile_number  = $request->mobile_number;
                $mobile->method         = $request->mfs_payment_type;
                $mobile->transaction_id = $request->transaction_id;
                $mobile->amount         = $request->paid;
                $mobile->save();
            }

            $order_id
                ? session()->flash('message', 'Order Placed Successfully')
                : session('message', 'Something Went Wrong!');
        });
    }

    public function destroyOrder(Int $id)
    {
        DB::transaction(function () use ($id) {
            $order = $this::findOrFail($id);
            OrderDetail::where('order_id', $id)->delete();
            BookingPayment::where('order_id', $id)->delete();
            BankPayment::where('order_id', $id)->delete();
            MobilePayment::where('order_id', $id)->delete();
            $destroyOrder = $order->delete();

            $destroyOrder
                ? session()->flash('message', 'Order Deleted Successfully')
                : session('message', 'Something Went Wrong!');
        });
    }
}
