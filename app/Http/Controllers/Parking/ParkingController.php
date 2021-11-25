<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BookingDetail;
use App\Models\Charge;
use App\Models\MobileBank;
use App\Models\Parking;
use App\Models\Room;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    private $parkingObject;

    public function __construct()
    {
        $this->parkingObject = new Parking();
    }

    public function index()
    {
        $parkings = $this->parkingObject->getAllParking();
        return view('backend.parking.park.index', compact('parkings'));
    }

    public function create()
    {
        $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        return view('backend.parking.park.create', compact('categories', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate(Parking::$validateRule);
        $this->parkingObject->storeParking($request);
        return back();
    }

    public function edit($id)
    {
        $parking = Parking::findOrFail($id);
        $charges = Charge::where('hotel_id', auth()->user()->hotel_id)->where('category', $parking->vehicle_category_id)->select('id', 'type')->get();
        $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        return view('backend.parking.park.edit', compact('charges', 'rooms', 'parking', 'bookedRoom', 'categories', 'banks', 'mobileBanks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Parking::$validateRule);
        $this->parkingObject->updateParking($request, $id);
        return redirect()->route('parking.parkings.index');
    }

    public function destroy($id)
    {
        $this->parkingObject->destroyParking($id);
        return back();
    }
}
