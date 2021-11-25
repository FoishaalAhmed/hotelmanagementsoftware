<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HotelRequest;
use App\Models\Booking;
use App\Models\District;
use App\Models\Division;
use App\Models\Hotel;
use App\Models\HotelCommission;
use App\Models\HotelPhoto;
use App\Models\HotelVideo;
use App\Models\Order;
use App\Models\Parking;
use App\Models\Upozila;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = date('Y-m-d');
        $previousSevenDay = Carbon::now()->subDays(7);
        $firstDay = date("Y-n-j", strtotime("first day of previous month"));
        $lastDay = date("Y-n-j", strtotime("last day of previous month"));

        $todayBooking = Booking::whereDate('created_at', $today)->selectRaw('sum(total) as totalBooking')->first()->totalBooking;
        $previousSevenDayBooking = Booking::where('created_at','>=', $previousSevenDay)->selectRaw('sum(total) as totalBooking')->first()->totalBooking;
        $lastMonthBooking = Booking::whereBetween(DB::raw('date(created_at)'), [$firstDay, $lastDay])->selectRaw('sum(total) as totalBooking')->first()->totalBooking;

        $todayBookingByAmarlodge = Booking::whereDate('created_at', $today)->where('booked_by', 1)->selectRaw('sum(total) as totalBooking')->first()->totalBooking;
        $previousSevenDayBookingByAmarlodge = Booking::where('created_at','>=', $previousSevenDay)->where('booked_by', 1)->selectRaw('sum(total) as totalBooking')->first()->totalBooking;
        $lastMonthBookingByAmarlodge = Booking::whereBetween(DB::raw('date(created_at)'), [$firstDay, $lastDay])->where('booked_by', 1)->selectRaw('sum(total) as totalBooking')->first()->totalBooking;

        $todayOrder = Order::whereDate('created_at', $today)->selectRaw('sum(paid) as totalOrder')->first()->totalOrder;
        $previousSevenDayOrder = Order::where('created_at', '>=', $previousSevenDay)->selectRaw('sum(paid) as totalOrder')->first()->totalOrder;
        $lastMonthOrder = Order::whereBetween(DB::raw('date(created_at)'), [$firstDay, $lastDay])->selectRaw('sum(paid) as totalOrder')->first()->totalOrder;
        
        $todayParking = Parking::whereDate('created_at', $today)->selectRaw('sum(paid) as totalParking')->first()->totalParking;
        $previousSevenDayParking = Parking::where('created_at', '>=', $previousSevenDay)->selectRaw('sum(paid) as totalParking')->first()->totalParking;
        $lastMonthParking = Parking::whereBetween(DB::raw('date(created_at)'), [$firstDay, $lastDay])->selectRaw('sum(paid) as totalParking')->first()->totalParking;

        $commission = HotelCommission::where('hotel_id', auth()->user()->hotel_id)->first();
        

        return view('backend.admin.dashboard', compact('todayBooking', 'previousSevenDayBooking', 'lastMonthBooking', 'todayOrder', 'previousSevenDayOrder', 'lastMonthOrder', 'todayParking', 'previousSevenDayParking', 'lastMonthParking', 'todayBookingByAmarlodge', 'previousSevenDayBookingByAmarlodge', 'lastMonthBookingByAmarlodge'));
    }

    public function profile()
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
}
