<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableBooking extends Model
{
    protected $fillable = [
        'hotel_id', 'table_id', 'user_id', 'status',
    ];

    public static $validateRule = [
        'table_id' => ['required', 'numeric'],
        'room_id' => ['required', 'numeric'],
    ];

    public function getBookingTable()
    {
        $bookings = $this::leftJoin('users', 'table_bookings.user_id', '=', 'users.id')
            ->join('tables', 'table_bookings.table_id', '=', 'tables.id')
            ->where('table_bookings.hotel_id', auth()->user()->hotel_id)
            ->where('table_bookings.status', 1)
            ->orderBy('table_bookings.created_at', 'desc')
            ->select('table_bookings.number', 'table_bookings.id', 'users.name', 'tables.number as table')
            ->get();
        return $bookings;
    }

    public function storeTableBooking(Object $request, Int $user_id=null)
    {
        $number = Room::findOrFail($request->room_id)->number;
        $this->hotel_id = auth()->user()->hotel_id;
        $this->table_id = $request->table_id;
        $this->number   = $number;
        $this->user_id  = $user_id;
        $this->status   = 1;
        $storeTableBooking = $this->save();

        $storeTableBooking
            ? session()->flash('message', 'Table Booked Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateTableBooking(Object $request, Int $id, Int $user_id=null)
    {
        $booking = $this->findOrFail($id);
        $number = Room::findOrFail($request->room_id)->number;
        $booking->hotel_id = auth()->user()->hotel_id;
        $booking->table_id = $request->table_id;
        $booking->number   = $number;
        $booking->user_id  = $user_id;
        $updateTableBooking = $booking->save();

        $updateTableBooking
            ? session()->flash('message', 'Table Booking Info updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyTableBooking(Int $id)
    {
        $booking = $this->findOrFail($id);
        $destroyTableBooking = $booking->delete();

        $destroyTableBooking
            ? session()->flash('message', 'Table Booking Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
