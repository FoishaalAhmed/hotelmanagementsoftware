<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\HotelCommission;
use App\Models\Order;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    
}
