<?php

namespace App\Http\Controllers\Parking;

use App\Http\Controllers\Controller;
use App\Models\VehicleCategory;
use Illuminate\Http\Request;

class VehicleCategoryController extends Controller
{
    protected $vehicleCategoryObject;

    public function __construct()
    {
        $this->vehicleCategoryObject = new VehicleCategory();
    }

    public function index()
    {
        $categories = VehicleCategory::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.parking.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(VehicleCategory::$validateRule);
        $this->vehicleCategoryObject->storeVehicleCategory($request);
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate(VehicleCategory::$validateRule);
        $this->vehicleCategoryObject->updateVehicleCategory($request, $request->id);
        return back();
    }

    public function destroy($id)
    {
        $this->vehicleCategoryObject->destroyVehicleCategory($id);
        return back();
    }
}
