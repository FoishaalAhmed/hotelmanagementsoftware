<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\Table;
use App\Models\TableBooking;
use Illuminate\Http\Request;

class TableBookingController extends Controller
{
    private $tableBookingObject;

    public function RoomAndTableInfo()
    {
        $bookedTable = TableBooking::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('table_id');
        $tables = Table::where('hotel_id', auth()->user()->hotel_id)->whereNotIn('id', $bookedTable)->select('id', 'number')->orderBy('number', 'asc')->get();

        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();

        $response = array('tables' => $tables, 'rooms' => $rooms);
        return response()->json($response, 200);
    }

    public function __construct()
    {
        $this->tableBookingObject = new TableBooking();
    }

    public function index()
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $bookings = $this->tableBookingObject->getBookingTable();
            return response($bookings, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->select('id', 'invoice', 'status', 'user_id')->orderBy('id', 'desc')->first();
            $request->validate(TableBooking::$validateRule);
            $this->tableBookingObject->storeTableBooking($request, $booking->user_id);
            $response = ['message' => 'Table Booking Info Stored Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $booking = TableBooking::findOrFail($id);
            return response($booking, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->select('id', 'invoice', 'status', 'user_id')->orderBy('id', 'desc')->first();
            $request->validate(TableBooking::$validateRule);
            $this->tableBookingObject->updateTableBooking($request, $id, $booking->user_id);
            $response = ['message' => 'Table Booking Info Updated Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Restaurant')) {
            $this->tableBookingObject->destroyTableBooking($id);
            $response = ['message' => 'Table Booking Deleted Successfully!'];
            return response()->json($response, 200);
        } else {

            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
