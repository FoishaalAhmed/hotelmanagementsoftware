<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }

    public function getBookingDetail(Int $id)
    {
        $details = $this::join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->where('booking_details.booking_id', $id)
            ->select('rooms.number', 'booking_details.*')
            ->get();
        return $details;
    }

    public function getAvailableRooms()
    {
        $details = $this::join('rooms', 'booking_details.room_id', '=', 'rooms.id')
            ->where('booking_details.status', '!=', 1)
            ->select('rooms.number', 'rooms.rent', 'rooms.type', 'rooms.situate', 'rooms.facing', 'rooms.bed', 'rooms.id')
            ->orderBy('booking_details.created_at', 'desc')
            ->groupBy('booking_details.room_id')
            ->get();
        return $details;
    }

    public function storeBookingDetail(Object $request, Int $id)
    {
        $booking = Booking::where('id', $id)->firstOrFail();
        //dd($request);
        foreach ($request->room_id as $key => $value) {
            $data[] = [
                'booking_id' => $id,
                'user_id' => $booking->user_id,
                'invoice' => $booking->invoice,
                'hotel_id' => auth()->user()->hotel_id,
                'room_id' => $value,
                'person' => $request->person[$key],
                'name' => $request->name[$key],
                'check_in' => date('Y-m-d', strtotime($request->check_in[$key])),
                'check_out' => date('Y-m-d', strtotime($request->check_out[$key])),
                'status' => 1,
            ];
        }
        $this::where('booking_id', $id)->delete();
        $storeBookingDetail = $this::insert($data);

        $storeBookingDetail
            ? session()->flash('message', 'Booking Detail Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
