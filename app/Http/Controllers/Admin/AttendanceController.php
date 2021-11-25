<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Loan_advance;
use App\Models\Month;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    private $attendanceObject;

    public function __construct()
    {
        $this->attendanceObject = new Attendance();
    }

    public function index(Request $request)
    {
        $departments = Department::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $months      = Month::select('id', 'name')->get();

        $month    = $request->month;
        $employee = $request->employee_id;

        if ($month != '' || $employee != '') {

            $request->validate(Attendance::$validateSearchRule);
            $attendances = $this->attendanceObject->getEmployeeAttendanceByMonth($month, $employee);
            return view('backend.admin.attendance.index', compact('departments', 'months', 'attendances'));

        } else {

            return view('backend.admin.attendance.index', compact('departments', 'months'));
        }
    }

    public function create()
    {
        $employees = Employee::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name', 'employee_id')->get();
        $months    = Month::select('id', 'name')->get();
        $attendances = $this->attendanceObject->getTodaysAttendances();
        return view('backend.admin.attendance.create', compact('employees', 'months', 'attendances'));
    }

    public function store(Request $request)
    {
        $request->validate(Attendance::$validateRule);
        $this->attendanceObject->storeAttendance($request);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate(Attendance::$validateUpdateRule);
        $this->attendanceObject->updateAttendance($request);
        return redirect()->back();
    }

    public function employee()
    {
        $departments = Department::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        $months    = Month::select('id', 'name')->get();
        return view('backend.admin.attendance.search', compact('departments', 'months'));
    }

    public function employee_attend(Request $request)
    {
        $loanAdvance = new Loan_advance();
        $month    = $request->month;
        $employee = $request->employee_id;

        $request->validate(Attendance::$validateSearchRule);
        $employee_info = Employee::findOrFail($employee);
        $attendances = $this->attendanceObject->getEmployeeAttendanceByMonth($month, $employee);
        $loan_advances = $loanAdvance->getLoanOrAdvanceByEmployeeAndMonth($month, $employee);

        return view('backend.admin.attendance.attendances', compact('attendances', 'employee_info', 'loan_advances', 'month'));
    }
}
