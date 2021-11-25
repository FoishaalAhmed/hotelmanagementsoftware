<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\FoodVat;
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

    public function other()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $bookedTable = TableBooking::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('table_id');
            $tables = Table::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedTable)->select('id', 'number')->orderBy('number', 'asc')->get();
            $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
            $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
            $vat = FoodVat::select('percent')->latest()->first();
            $response = [
                'tables' => $tables,
                'rooms' => $rooms,
                'vat' => $vat,
            ];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $orders = $this->orderObject->getHotelOrders();
            return response($orders, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $request->validate(Order::$validateRule);
            $this->orderObject->storeOrder($request);
            $response = ['message' => 'Order Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $orderDetailObject = new OrderDetail();
            $order = $this->orderObject->getHotelOrderByID($id);
            $details = $orderDetailObject->getOrderDetailByOrderID($id);
            $response = [
                'order' => $order,
                'details' => $details,
            ];
            return response($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $this->orderObject->destroyOrder($id);
            $response = ['message' => 'Order Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
