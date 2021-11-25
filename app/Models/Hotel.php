<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hotel extends Model
{

    protected $fillable = [
        'name', 'email', 'phone', 'mobile', 'fax', 'map', 'website', 'road_house', 'zip_code', 'division_id', 'district_id', 'upozila_id', 'logo', 'floor', 'star', 'trade_licence', 'tin_number', 'about',
    ];

    public static $validateFrontRule = [

        'type'          => 'required|string|max:255',
        'name'          => 'required|string|max:255',
        'username'      => 'required|string|max:255',
        'password'      => 'required|string|min:8|confirmed',
        'email'         => 'required|email|max:255|unique:users,email',
        'mobile'        => 'required|string|max:15|unique:users,phone',
        'phone'         => 'nullable|string|max:15',
        'floor'         => 'required|string|max:10',
        'star'          => 'required|string|max:7',
        'fax'           => 'nullable|string|max:255',
        'google_map'    => 'nullable|string',
        'website'       => 'nullable|string|max:255',
        'road_house'    => 'nullable|string|max:255',
        'zip_code'      => 'nullable|string|max:255',
        'city'          => 'nullable|string|max:255',
        'division_id'   => 'required|numeric',
        'district_id'   => 'required|numeric',
        'upozila_id'    => 'required|numeric',
        'trade_licence' => 'nullable|string|max:255',
        'tin_number'    => 'nullable|string|max:255',
        'about'         => 'nullable|string|',
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
            $hotel->trade_licence = $request->trade_licence;
            $hotel->tin_number    = $request->tin_number;
            $hotel->about         = $request->about;
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
}
