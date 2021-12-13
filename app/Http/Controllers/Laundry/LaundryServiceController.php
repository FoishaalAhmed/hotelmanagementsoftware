<?php

namespace App\Http\Controllers\Laundry;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BookingDetail;
use App\Models\LaundryProduct;
use App\Models\LaundryService;
use App\Models\LaundryServiceDetail;
use App\Models\MobileBank;
use App\Models\Room;
use Illuminate\Http\Request;

class LaundryServiceController extends Controller
{
    protected $laundryServiceObject;

    public function __construct()
    {
        $this->laundryServiceObject = new LaundryService();
    }

    public function index()
    {
        $services = $this->laundryServiceObject->getLaundryServices();
        return view('backend.laundry.services.index', compact('services'));
    }

    public function create()
    {
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $products = LaundryProduct::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $banks = Bank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();
        $mobileBanks = MobileBank::where('hotel_id', auth()->user()->id)->select('id', 'name')->get();

        return view('backend.laundry.services.create', compact('rooms', 'products', 'banks', 'mobileBanks'));
    }

    public function store(Request $request)
    {
        $this->laundryServiceObject->storeLaundryService($request);
        return back();
    }

    public function show(LaundryService $service)
    {
        $laundryServiceDetailObject = new LaundryServiceDetail();
        $details = $laundryServiceDetailObject->getLaundryServiceDetail($service->id);
        $room = Room::where('id', $service->room_id)->firstOrFail();
        return view('backend.laundry.services.show', compact('service', 'details', 'room'));
    }

    public function destroy(LaundryService $service)
    {
        $this->laundryServiceObject->destroyLaundryService($service);
        return back();
    }
}
