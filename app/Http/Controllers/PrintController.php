<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Loan_advance;
use App\Models\Month;

class PrintController extends Controller
{
    public function salary($salary_id)
    {
        $attendance_object = new Attendance();
        $loan_advance      = new Loan_advance();

        $salary        = Salary::findOrFail($salary_id);
        $employee_info = Employee::findOrFail($salary->employee_id);
        $month         = Month::where('id', $salary->month_id)->firstOrFail()->name;
        $department    = Department::where('id', $salary->department_id)->firstOrFail()->name;
        $attendances   = $attendance_object->getEmployeeAttendanceByMonth($salary->month_id, $salary->employee_id);
        $loan_advances = $loan_advance->getLoanOrAdvanceByEmployeeAndMonth($salary->month_id, $salary->employee_id);

        return view('print.salary', compact('month', 'employee_info', 'department', 'salary', 'attendances', 'loan_advances'));
    }
}
