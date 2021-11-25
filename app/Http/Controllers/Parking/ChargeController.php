<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\Models\Charge;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    private $chargeObject;

    public function __construct()
    {
        $this->chargeObject = new Charge();
    }

    public function index()
    {
        $charges = $this->chargeObject->getParkingCharges();
        $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.parking.charge', compact('charges', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate(Charge::$validateRule);
        $this->chargeObject->storeCharge($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(Charge::$validateRule);
        $this->chargeObject->updateCharge($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->chargeObject->destroyCharge($id);
        return back();
    }
}
