<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelService extends Model
{

    protected $fillable = [
        'hotel_id', 'service_id', 'charge', 'charge_amount'
    ];

    public static $validateRule = [
        'service_id' => ['required', 'numeric', 'min:1'],
        'charge' => ['required', 'numeric', 'min:0'],
        'charge_amount' => ['required_if:charge, 1', 'numeric', 'min:0'],
    ];

    public function getAllHotelServices()
    {
        $hotel_services = $this::join('hotels', 'hotel_services.hotel_id', '=', 'hotels.id')
            ->join('services', 'hotel_services.service_id', '=', 'services.id')
            ->select('hotel_services.id', 'hotel_services.charge', 'hotel_services.charge_amount', 'hotels.name', 'services.name as service')
            ->get();
        return $hotel_services;
    }

    public function getHotelServicesByHotelId(Int $hotel_id)
    {
        $hotel_services = $this::join('services', 'hotel_services.service_id', '=', 'services.id')
            ->where('hotel_services.hotel_id', $hotel_id)
            ->select('hotel_services.*', 'services.name as service')
            ->get();
        return $hotel_services;
    }
    
    public function getHotelServices(Int $hotel_id, Int $id)
    {
        $hotel_service = $this::join('services', 'hotel_services.service_id', '=', 'services.id')
            ->where('hotel_services.hotel_id', $hotel_id)
            ->where('hotel_services.id', $id)
            ->select('hotel_services.*', 'services.name as service')
            ->firstOrFail();
        return $hotel_service;
    }

    public function getHotelChargeApplicableServicesByHotelId(Int $hotel_id)
    {
        $hotel_services = $this::join('services', 'hotel_services.service_id', '=', 'services.id')
            ->where('hotel_services.hotel_id', $hotel_id)
            ->where('hotel_services.charge', 1)
            ->select('hotel_services.service_id', 'services.name')
            ->get();
        return $hotel_services;
    }

    public function storeHotelService($request)
    {

        $this->hotel_id      = auth()->user()->hotel_id;
        $this->service_id    = $request->service_id;
        $this->charge        = $request->charge;
        $this->charge_amount = $request->charge_amount;
        $storeHotelService   = $this->save();

        $storeHotelService
            ? session()->flash('message', 'Hotel Service Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateHotelService($request, $id)
    {
        $hotelService                = $this::findOrFail($id);
        $hotelService->service_id    = $request->service_id;
        $hotelService->charge        = $request->charge;
        $hotelService->charge_amount = $request->charge_amount;
        $updateHotelService          = $hotelService->save();

        $updateHotelService
            ? session()->flash('message', 'Hotel Service Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyHotelService($id)
    {
        $hotelService = $this::findOrFail($id);
        $destroyHotelService = $hotelService->delete();

        $destroyHotelService
            ? session()->flash('message', 'Hotel Service Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
