<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hotel extends Model
{

    protected $fillable = [
        'name', 'email', 'phone', 'mobile', 'fax', 'map', 'website', 'road_house', 'zip_code', 'division_id', 'district_id', 'upozila_id', 'logo', 'floor', 'star', 'trade_license', 'tin_number', 'about', 'bank', 'account_number', 'contact_person', 'contact_number', 'facebook', 'instagram', 'twitter', 'linkedin', 'room', 'min_rate', 'max_rate',
    ];

    public static $validateBankInfo = [
        'bank' => ['required', 'max: 255', 'string'],
        'account_number' => ['required', 'max: 255', 'string'],
        'contact_person' => ['required', 'max: 255', 'string'],
        'contact_number' => ['required', 'max: 15', 'string'],
    ];

    public function updateHotel(Object $request, Int $id)
    {
        DB::transaction(function () use ($request, $id) {

            $hotel = $this::findOrFail($id);
            $image = $request->file('logo');

            if ($image) {
                if (file_exists($hotel->logo)) unlink($hotel->logo);
                $image_name      = date('YmdHis');
                $ext             = strtolower($image->getClientOriginalExtension());
                $image_full_name = $image_name . '.' . $ext;
                $image_url       = 'https://amarlodge.com/public/images/hotels/' . $image_full_name;
                $success         = $image->storeAs('hotels', $image_full_name, 'parent_disk');
                $hotel->photo     = $image_url;
            }

            $hotel->name          = $request->name;
            $hotel->email         = $request->email;
            $hotel->phone         = $request->phone;
            $hotel->mobile        = $request->mobile;
            $hotel->fax           = $request->fax;
            $hotel->map           = $request->map;
            $hotel->website       = $request->website;
            $hotel->road_house    = $request->road_house;
            $hotel->zip_code      = $request->zip_code;
            $hotel->division_id   = $request->division_id;
            $hotel->district_id   = $request->district_id;
            $hotel->upozila_id    = $request->upozila_id;
            $hotel->floor         = $request->floor;
            $hotel->star          = $request->star;
            $hotel->trade_license = $request->trade_license;
            $hotel->tin_number    = $request->tin_number;
            $hotel->about         = $request->about;
            $hotel->facebook      = $request->facebook;
            $hotel->instagram     = $request->instagram;
            $hotel->twitter       = $request->twitter;
            $hotel->linkedin      = $request->linkedin;
            $hotel->room          = $request->room;
            $hotel->min_rate      = $request->min_rate;
            $hotel->max_rate      = $request->max_rate;
            $updateHotel          =  $hotel->save();

            if ($files = $request->file('photo')) {

                foreach ($files as $file) {

                    $multiple_upload_path = 'https://amarlodge.com/public/images/hotels/';
                    $name                 = $file->getClientOriginalName();
                    $multiple_image_name  = date('YmdHis') . '_' . $name;
                    $file->storeAs('hotels', $multiple_image_name, 'parent_disk');

                    $HotelPhoto           = new HotelPhoto;
                    $HotelPhoto->photo    = $multiple_upload_path . $multiple_image_name;
                    $HotelPhoto->hotel_id = $id;
                    $HotelPhoto->save();
                }
            }
            if ($request->video) {
                foreach ($request->video as $key => $value) {
                    if ($value == null) continue;
                    $hotelVideo           = new HotelVideo();
                    $hotelVideo->hotel_id = $id;
                    $hotelVideo->video    = $value;
                    $hotelVideo->save();
                }
            }

            $updateHotel
                ? session()->flash('message', 'Hotel Info Updated Successfully!')
                : session()->flash('message', 'Something Went Wrong!');
        });
    }

    public function updateHotelLogo(Object $request)
    {
        $hotel = $this::findOrFail(auth()->user()->hotel_id);
        $image = $request->file('logo');
        if (file_exists($hotel->logo)) unlink($hotel->logo);
        $image_name      = date('YmdHis');
        $ext             = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $image_url       = 'https://amarlodge.com/public/images/hotels/' . $image_full_name;
        $success         = $image->storeAs('hotels', $image_full_name, 'parent_disk');
        $hotel->photo     = $image_url;
        $hotel->save();
    }

    public function storeHotelBankInfo(Object $request)
    {
        $hotel = $this::findOrFail(auth()->user()->hotel_id);
        $hotel->bank = $request->bank;
        $hotel->account_number = $request->account_number;
        $hotel->contact_person = $request->contact_person;
        $hotel->contact_number = $request->contact_number;
        $storeHotelBankInfo = $hotel->save();

        $storeHotelBankInfo
            ? session()->flash('message', 'Bank Info Stored Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
