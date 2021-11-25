<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\BankPayment;
use App\Models\BookingDetail;
use App\Models\BookingPayment;
use App\Models\FoodVat;
use App\Models\Item;
use App\Models\MobilePayment;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use App\Models\Table;
use App\Models\TableBooking;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderObject;

    public function __construct()
    {
        $this->orderObject = new Order();
    }

    public function index()
    {
        $orders = $this->orderObject->getHotelOrders();
        return view('backend.restaurant.orders.index', compact('orders'));
    }

    public function create()
    {
        $bookedTable = TableBooking::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('table_id');
        $tables = Table::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedTable)->select('id', 'number')->orderBy('number', 'asc')->get();
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $vat = FoodVat::select('percent')->latest()->first();
        $items = Item::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name', 'price')->orderBy('name', 'asc')->get();
        return view('backend.restaurant.orders.create', compact('tables', 'items', 'vat', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate(Order::$validateRule);
        $this->orderObject->storeOrder($request);
        return back();
    }

    public function show($id)
    {
        $orderDetailObject = new OrderDetail();
        $order = $this->orderObject->getHotelOrderByID($id);
        $details = $orderDetailObject->getOrderDetailByOrderID($id);
        $cashPayment = BookingPayment::where('order_id', $id)->first();
        $bankPayment = BankPayment::where('order_id', $id)->first();
        $mobilePayment = MobilePayment::where('order_id', $id)->first();
        return view('backend.restaurant.orders.show', compact('order', 'details', 'cashPayment', 'bankPayment', 'mobilePayment'));
    }

    public function destroy($id)
    {
        $this->orderObject->destroyOrder($id);
        return back();
    }
}
