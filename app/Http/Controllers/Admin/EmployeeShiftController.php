<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeShift;
use App\Models\Shift;
use Illuminate\Http\Request;
use DB;

class EmployeeShiftController extends Controller
{
    private $employeeShiftObject;

    public function __construct()
    {
        $this->employeeShiftObject = new EmployeeShift();
    }

    public function index(Request $request)
    {
        $shifts = Shift::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        if ($request->shift_id != '') {
            $employees = $this->employeeShiftObject->getEmployeeShift($request->shift_id);
            return view('backend.admin.employeeShift.index', compact('shifts', 'employees'));
        } else {

            return view('backend.admin.employeeShift.index', compact('shifts'));
        }
    }

    public function create()
    {
        $shifts = Shift::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $employees =  DB::table("employees")->where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->whereNotIn('id', function ($query) {
            $query->select('employee_id')->from('employee_shifts');
        })->get();
        return view('backend.admin.employeeShift.create', compact('shifts', 'employees'));
    }

    public function store(Request $request)
    {
        $this->employeeShiftObject->storeEmployeeShift($request);
        return back();
    }

    public function edit($id)
    {
        $emShift   = EmployeeShift::findOrFail($id);
        $shifts    = Shift::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $employees =  DB::table("employees")->where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->whereNotIn('id', function ($query) {
            $query->select('employee_id')->from('employee_shifts');
        })->get();
        return view('backend.admin.employeeShift.edit', compact('shifts', 'employees', 'emShift'));
    }

    public function update(Request $request, $id)
    {
        $this->employeeShiftObject->updateEmployeeShift($request, $id);
        return redirect()->route('admin.employee-shifts.index');
    }

    public function destroy($id)
    {
        $this->employeeShiftObject->destroyEmployeeShift($id);
        return back();
    }
}
