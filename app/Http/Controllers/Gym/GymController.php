<?php

namespace App\Http\Controllers\Gym;

use App\Http\Controllers\Controller;
use App\Models\Gym;
use Illuminate\Http\Request;

class GymController extends Controller
{
    protected $gymObject;

    public function __construct()
    {
        $this->gymObject = new Gym();
    }

    public function index()
    {
        $gyms = Gym::where('hotel_id', auth()->user()->hotel_id)->orderBy('name', 'asc')->get();
        return view('backend.gym.gyms.index', compact('gyms'));
    }

    public function create()
    {
        return view('backend.gym.gyms.create');
    }

    public function store(Request $request)
    {
        $request->validate(Gym::$validateRule);
        $this->gymObject->storeGym($request);
        return back();
    }

    public function edit(Gym $gym)
    {
        return view('backend.gym.gyms.edit', compact('gym'));
    }

    public function update(Request $request, Gym $gym)
    {
        $request->validate(Gym::$validateRule);
        $this->gymObject->updateGym($request, $gym);
        return redirect()->route('gym.gyms.index');
    }

    public function destroy(Gym $gym)
    {
        $this->gymObject->destroyGym($gym);
        return back();
    }
}
