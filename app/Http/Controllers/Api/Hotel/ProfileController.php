<?php

namespace App\Http\Controllers\Api\Hotel;

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

        $response = [
            'hotel' => $hotel,
            'divisions' => $divisions,
            'districts' => $districts,
            'upozilas' => $upozilas,
            'hotelPhotos' => $hotelPhotos,
            'hotelVideos' => $hotelVideos,
        ];

        return response($response, 200);
    }

    public function update(HotelRequest $request, $id)
    {
        $hotelObject = new Hotel();
        $hotelObject->updateHotel($request, $id);
        $response = ['message' => 'Hotel Profile Updated Successfully!'];
        return response($response, 200);
    }
}
