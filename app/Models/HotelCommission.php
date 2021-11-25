<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelCommission extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id', 'commission',
    ];

    public static $validateRule = [
        'hotel_id' => ['required', 'numeric'],
        'commission' => ['required', 'numeric'],
    ];

    public function getAllHotelCommission()
    {
        $hotelCommissions = $this::join('hotels', 'hotel_commissions.hotel_id', '=', 'hotels.id')
            ->select('hotel_commissions.*', 'hotels.name', 'hotels.logo')
            ->get();
        return $hotelCommissions;
    }

    public function storeHotelCommission(Object $request)
    {
        $this->hotel_id = $request->hotel_id;
        $this->commission = $request->commission;
        $storeHotelCommission = $this->save();

        $storeHotelCommission
            ? session()->flash('message', 'New Hotel Commission Added SuccessfullY!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateHotelCommission(Object $request, Object $hotelCommission)
    {
        $hotelCommission->hotel_id = $request->hotel_id;
        $hotelCommission->commission = $request->commission;
        $updateHotelCommission = $hotelCommission->save();

        $updateHotelCommission
            ? session()->flash('message', 'Hotel Commission Updated SuccessfullY!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHotelCommission(Object $hotelCommission)
    {
        $destroyHotelCommission = $hotelCommission->delete();

        $destroyHotelCommission
            ? session()->flash('message', 'Hotel Commission Deleted SuccessfullY!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
