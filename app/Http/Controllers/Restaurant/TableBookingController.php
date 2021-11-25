<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\Table;
use App\Models\TableBooking;
use Illuminate\Http\Request;

class TableBookingController extends Controller
{
    private $tableBookingObject;

    private function RoomAndTableInfo()
    {
        $bookedTable = TableBooking::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('table_id');
        $tables = Table::where('hotel_id', auth()->user()->hotel_id)->whereNotIn('id', $bookedTable)->select('id', 'number')->orderBy('number', 'asc')->get();

        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();

        return array('tables' => $tables, 'rooms' => $rooms);
    }

    public function __construct()
    {
        $this->tableBookingObject = new TableBooking();
    }

    public function index()
    {
        $bookings = $this->tableBookingObject->getBookingTable();
        return view('backend.restaurant.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $roomTables = $this->RoomAndTableInfo();
        $rooms = $roomTables['rooms'];
        $tables = $roomTables['tables'];
        return view('backend.restaurant.bookings.create', compact('tables', 'rooms'));
    }

    public function store(Request $request)
    {
        $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->select('id', 'invoice', 'status', 'user_id')->orderBy('id', 'desc')->first();
        $request->validate(TableBooking::$validateRule);
        $this->tableBookingObject->storeTableBooking($request, $booking->user_id);
        return back();
    }

    public function edit($id)
    {
        $booking = TableBooking::findOrFail($id);
        $table = Table::where('id', $booking->table_id)->select('id', 'number')->firstOrFail();
        $room = Room::where('hotel_id', auth()->user()->hotel_id)->where('number', $booking->number)->select('id', 'number')->first();
        $roomTables = $this->RoomAndTableInfo();
        $rooms = $roomTables['rooms'];
        $tables = $roomTables['tables'];
        return view('backend.restaurant.bookings.edit', compact('tables', 'rooms', 'booking', 'table', 'room'));
    }

    public function update(Request $request, $id)
    {
        $booking = BookingDetail::where('room_id', $request->room_id)->where('status', 1)->select('id', 'invoice', 'status', 'user_id')->orderBy('id', 'desc')->first();
        $request->validate(TableBooking::$validateRule);
        $this->tableBookingObject->updateTableBooking($request, $id, $booking->user_id);
        return redirect()->route('restaurant.bookings.index');
    }

    public function destroy($id)
    {
        $this->tableBookingObject->destroyTableBooking($id);
        return back();
    }
}
