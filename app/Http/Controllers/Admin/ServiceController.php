<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\HotelService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    private $serviceObject;

    public function __construct()
    {
        $this->serviceObject = new HotelService();
    }

    public function index()
    {
        $services = Service::orderBy('name', 'asc')->get();
        $hotelService = $this->serviceObject->getHotelServicesByHotelId(auth()->user()->hotel_id);
        return view('backend.admin.service', compact('services', 'hotelService'));
    }

    public function store(Request $request)
    {
        $request->validate(HotelService::$validateRule);
        $this->serviceObject->storeHotelService($request);
        return back();
    }

    public function edit($id)
    {
        $service = HotelService::findOrFail($id);
        $services = Service::orderBy('name', 'asc')->get();
        $hotelService = $this->serviceObject->getHotelServicesByHotelId(auth()->user()->hotel_id);
        return view('backend.admin.service', compact('services', 'service', 'hotelService'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(HotelService::$validateRule);
        $this->serviceObject->updateHotelService($request, $id);
        return redirect()->route('admin.services.index');
    }

    public function destroyHotelService($id)
    {
        $this->serviceObject->destroyService($id);
        return redirect()->route('admin.services.index');
    }
}
