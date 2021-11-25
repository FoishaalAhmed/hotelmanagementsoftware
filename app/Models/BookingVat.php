<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingVat extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'vat',
    ];

    public static $validateRule = [
        'vat' => ['required', 'numeric'],
    ];

    public function storeBookingVat(Object $request)
    {
        $vat = $this::where('hotel_id', auth()->user()->hotel_id)->first();
        if ($vat) {
            $vat->hotel_id = auth()->user()->hotel_id;
            $vat->vat = $request->vat;
            $storeBookingVat = $vat->save();
        } else {
            $this->hotel_id = auth()->user()->hotel_id;
            $this->vat = $request->vat;
            $storeBookingVat = $this->save();
        }

        $storeBookingVat
            ? session()->flash('message', 'New Booking Vat Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateBookingVat(Object $request, Int $id)
    {
        $vat = $this::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->firstOrFail();
        $vat->hotel_id = auth()->user()->hotel_id;
        $vat->vat = $request->vat;
        $updateBookingVat = $vat->save();

        $updateBookingVat
            ? session()->flash('message', 'Booking Vat Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyBookingVat(Object $vat)
    {
        $destroyBookingVat = $vat->delete();

        $destroyBookingVat
            ? session()->flash('message', 'Booking Vat Delete Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
