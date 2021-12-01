<?php

namespace App\Http\Controllers\Tour;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Guide;
use App\Models\Room;
use App\Models\Tour;
use App\Models\TourPackage;
use App\Models\TourUser;
use Illuminate\Http\Request;

class TourController extends Controller
{
    protected $tourObject;

    public function __construct()
    {
        $this->tourObject = new Tour();
    }

    public function index()
    {
        $tours = $this->tourObject->getTours();
        return view('backend.tour.tours.index', compact('tours'));
    }

    public function create()
    {
        $guides = Guide::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $packages = TourPackage::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();

        return view('backend.tour.tours.create', compact('guides', 'packages', 'rooms'));
    }

    public function store(Request $request)
    {
        $this->tourObject->storeTour($request);
        return back();
    }

    public function show($id)
    {
        $tourUserObject = new TourUser();
        $tour = $this->tourObject->getTourById($id);
        $users = $tourUserObject->getTourUsers($id);
        return view('backend.tour.tours.view', compact('tour', 'users'));
    }

    public function destroy(Tour $tour)
    {
        $this->tourObject->destroyTour($tour);
        return back();
    }
}
