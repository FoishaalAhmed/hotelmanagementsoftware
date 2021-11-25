<?php

namespace App\Http\Controllers\Hall;

use App\Http\Controllers\Controller;
use App\Models\Hall;
use App\Models\HallCategory;
use Illuminate\Http\Request;

class HallController extends Controller
{
    protected $hallObject;

    public function __construct()
    {
        $this->hallObject = new Hall();
    }

    public function index()
    {
        $halls = $this->hallObject->getHalls();
        return view('backend.hall.halls.index', compact('halls'));
    }

    
    public function create()
    {
        $categories = HallCategory::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.hall.halls.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(Hall::$validateRule);
        $this->hallObject->storeHall($request);
        return back();
    }

    public function edit(Hall $hall)
    {
        $categories = HallCategory::orderBy('name', 'asc')->select('id', 'name')->get();
        return view('backend.hall.halls.edit', compact('categories', 'hall'));
    }

    public function update(Request $request, Hall $hall)
    {
        $request->validate(Hall::$validateRule);
        $this->hallObject->updateHall($request, $hall);
        return redirect()->route('hall.halls.index');
    }

    public function destroy(Hall $hall)
    {
        $this->hallObject->destroyHall($hall);
        return back();
    }
}
