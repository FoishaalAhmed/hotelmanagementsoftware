<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    private $shiftObject;

    public function __construct()
    {
        $this->shiftObject = new Shift();
    }

    public function index()
    {
        $shifts = Shift::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.shift', compact('shifts'));
    }

    public function store(Request $request)
    {
        $request->validate(Shift::$validateRule);
        $this->shiftObject->storeShift($request);
        return back();
    }

    public function edit($id)
    {
        $shift = Shift::findOrFail($id);
        $shifts = Shift::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.shift', compact('shifts', 'shift'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Shift::$validateRule);
        $this->shiftObject->updateShift($request, $id);
        return redirect()->route('admin.shifts.index');
    }

    public function destroy($id)
    {
        $this->shiftObject->destroyShift($id);
        return back();
    }
}
