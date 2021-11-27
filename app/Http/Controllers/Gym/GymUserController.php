<?php

namespace App\Http\Controllers\Gym;

use App\Http\Controllers\Controller;
use App\Models\BookingDetail;
use App\Models\Gym;
use App\Models\GymUser;
use App\Models\Room;
use Illuminate\Http\Request;

class GymUserController extends Controller
{
    protected $gymUserObject;

    public function __construct()
    {
        $this->gymUserObject = new GymUser();
    }

    public function index()
    {
        $users = $this->gymUserObject->getGymUsers();
        return view('backend.gym.users.index', compact('users'));
    }

    public function create()
    {
        $bookedRoom = BookingDetail::where('hotel_id', auth()->user()->hotel_id)->where('status', 1)->pluck('room_id');
        $rooms = Room::where('hotel_id', auth()->user()->hotel_id)->whereIn('id', $bookedRoom)->select('id', 'number')->orderBy('number', 'asc')->get();
        $gyms = Gym::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->select('id', 'name')->get();

        return view('backend.gym.users.create', compact('rooms', 'gyms'));
    }

    public function store(Request $request)
    {
        $request->validate(GymUser::$validateRule);
        $this->gymUserObject->storeGymUser($request);
        return back();
    }

    public function destroy(GymUser $user)
    {
        $this->gymUserObject->destroyGymUser($user);
        return back();
    }
}
