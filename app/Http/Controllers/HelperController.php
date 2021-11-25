<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use App\Models\Coupon;
use App\Models\District;
use App\Models\Employee;
use App\Models\HotelPhoto;
use App\Models\HotelVideo;
use App\Models\Item;
use App\Models\Room;
use App\Models\RoomRent;
use App\Models\RoomFacility;
use App\Models\RoomPhoto;
use App\Models\RoomVideo;
use App\Models\Upozila;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function employee(Request $request)
    {
        $department = $request->department_id;

        $employees = Employee::where('hotel_id', auth()->user()->hotel_id)->where('department_id', $department)->select('id', 'name')->get();

        echo json_encode($employees);
    }

    public function coupon(Request $request)
    {
        $today = date('Y-m-d');
        $coupon = Coupon::where('code', $request->code)->select('id', 'amount', 'expire', 'status')->first();
        if ($today > $coupon->expire || $coupon->status == 0) {
            echo 'Coupon Expire';
        } else {
            echo json_encode($coupon);
        }
    }

    public function room_facility(Request $request)
    {
        $roomFacilityObject = new RoomFacility();
        $facilities = $roomFacilityObject->getRoomFacilities($request->room_id);

        $response = '';
        foreach ($facilities as $key => $value) {
            $response .= '<div class="row"> <div class="col-lg-7 col-xs-6 text-left"> <h4 class="h4-tag-style">' . $value->name . ':</h4></div> <div class="col-lg-5 col-xs-6 text-right"> <h4 class="h4-tag-style">Yes</h4> </div> </div>';
        }
        echo json_encode($response);
    }

    public function room_rent(Request $request)
    {
        $room = Room::findOrFail($request->room_id);
        echo json_encode($room);
    }

    public function delete_hotel_photo(Request $request)
    {
        $hotel_photo = HotelPhoto::findOrFail($request->id);
        if (file_exists($hotel_photo->photo)) unlink($hotel_photo->photo);
        $hotel_photo->delete();
    }

    public function delete_hotel_video(Request $request)
    {
        $video = HotelVideo::findOrFail($request->id);
        $video->delete();
    }

    public function delete_room_photo(Request $request)
    {
        $roomPhoto = RoomPhoto::findOrFail($request->id);
        if (file_exists($roomPhoto->photo)) unlink($roomPhoto->photo);
        $roomPhoto->delete();
    }

    public function delete_room_video(Request $request)
    {
        $video = RoomVideo::findOrFail($request->id);
        $video->delete();
    }

    public function district(Request $request)
    {
        $districts = District::where('division_id', $request->division_id)->select('id', 'name')->get();
        echo json_encode($districts);
    }

    public function charge(Request $request)
    {
        $types = Charge::where('category', $request->category)->select('id', 'type')->get();
        echo json_encode($types);
    }

    public function upozilla(Request $request)
    {
        $upozilas = Upozila::where('district_id', $request->district_id)->select('id', 'name')->get();
        echo json_encode($upozilas);
    }

    public function food_items(Request $request)
    {
        $items = Item::where('food_category_id', $request->category)->where('food_type_id', $request->type)->select('id', 'name', 'price')->get();

        $foodItems = '<table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Select</th>
                                <th style="width: 85%;">Item</th>
                            </tr>
                        </thead>
                        <tbody>';

        foreach ($items as $key => $value) {
            $foodItems .= '<tr>
                <td><input type="checkbox" name="item_id[]" value="' . $value->id . '" autocomplete="off"></td>
                <td>' . $value->name . '</td>
            </tr>';
        }

        $foodItems .= '</tbody></table>';

        if ($request->has('html') && $request->html == 'Yes') {
            echo json_encode($foodItems);
        } else {
            echo json_encode($items);
        }
    }
    
    public function room_other_rent(Request $request)
    {

        $rent = Room::findOrFail($request->room_id)->rate;

        if ($request->type != 'Normal Rate') {
            $room = RoomRent::where('room_id', $request->room_id)->where('type', $request->type)->first();

            if ($room != null) {
                $rent = $room->rent;
            }
        }

        echo $rent;
        
    }
}
