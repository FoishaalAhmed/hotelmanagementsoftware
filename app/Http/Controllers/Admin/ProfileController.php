<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Models\District;
use App\Models\Division;
use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Models\HotelVideo;
use App\Models\Upozila;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $hotel = Hotel::findOrFail(auth()->user()->hotel_id);
        $divisions = Division::select('id', 'name')->get();
        $districts = District::where('division_id', $hotel->division_id)->select('id', 'name')->get();
        $upozilas = Upozila::where('district_id', $hotel->district_id)->select('id', 'name')->get();
        $hotelPhotos = HotelPhoto::where('hotel_id', auth()->user()->hotel_id)->select('id', 'photo')->get();
        $hotelVideos = HotelVideo::where('hotel_id', auth()->user()->hotel_id)->select('id', 'video')->get();
        return view('backend.admin.profile', compact('hotel', 'divisions', 'districts', 'upozilas', 'hotelPhotos', 'hotelVideos'));
    }

    public function update(HotelRequest $request, $id)
    {
        $hotelObject = new Hotel();
        $hotelObject->updateHotel($request, $id);
        return back();
    }

    public function create()
    {
        $hotel = Hotel::where('id', auth()->user()->hotel_id)->select('bank', 'account_number', 'contact_person', 'contact_number')->firstOrFail();
        return view('backend.admin.bankInfo', compact('hotel'));
    }

    public function store(Request $request)
    {
        $hotelObject = new Hotel();
        $request->validate(Hotel::$validateBankInfo);
        $hotelObject->storeHotelBankInfo($request);
        return back();
    }
}
