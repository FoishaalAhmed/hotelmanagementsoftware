<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Attendance extends Model
{
    protected $fillable = [

        'month', 'date', 'employee_id', 'in_time', 'out_time', 'late_time', 'remarks',
    ];

    public static $validateRule = [

        "employee_id.*" => "required|string",
        "in_time.*"     => "nullable|string|max:8",
        "out_time.*"    => "nullable|string|max:8",
        "late_time.*"   => "nullable|string|max:50",
        "remarks"       => "array|nullable",
    ];

    public static $validateUpdateRule = [

        "employee_id.*" => "required|string",
        "in_time.*"     => "nullable|string|max:8",
        "out_time.*"    => "nullable|string|max:8",
        "late_time.*"   => "nullable|string|max:50",
        "remarks"       => "array|nullable",
    ];

    public static $validateSearchRule = [
        "month"         => "required|numeric|max:12",
        "employee_id"   => "required|numeric",
    ];

    public function getEmployeeAttendanceByMonth($month, $employee)
    {
        $attendance = $this::where('month', $month)
            ->where('employee_id', $employee)
            ->orderBy('date', 'asc')
            ->get();
        return $attendance;
    }

    public function getTodaysAttendances()
    {
        $attendances = $this::join('employees', 'attendances.employee_id', '=', 'employees.id')
            ->where('attendances.hotel_id', auth()->user()->hotel_id)
            ->where('attendances.date', date('Y-m-d'))
            ->select('attendances.*', 'employees.name', 'employees.employee_id as em_id')
            ->get();
        return $attendances;
    }

    public function storeAttendance($request)
    {

        foreach ($request->late_time as $key => $value) {

            $attendance              = new Attendance();
            $attendance->date        = date('Y-m-d');
            $attendance->month       = date('m');
            $attendance->employee_id = $request->employee_id[$key];
            $attendance->in_time     = $request->in_time[$key];
            $attendance->out_time    = $request->out_time[$key];
            $attendance->remarks     = $request->remarks[$key];
            $attendance->hotel_id    = auth()->user()->hotel_id;
            $attendance->late_time   = $value;
            $attendances             = $attendance->save();
        }

        if ($attendances) {

            Session::flash('message', 'Attendance Taken Successfully!');
        } else {

            Session::flash('message', 'Attendance Failed!');
        }
    }

    public function updateAttendance($request)
    {
        $this::where('date', date('Y-m-d'))->delete();

        foreach ($request->late_time as $key => $value) {

            $attendance              = new Attendance();
            $attendance->date        = date('Y-m-d');
            $attendance->month       = date('m');
            $attendance->employee_id = $request->employee_id[$key];
            $attendance->in_time     = $request->in_time[$key];
            $attendance->out_time    = $request->out_time[$key];
            $attendance->remarks     = $request->remarks[$key];
            $attendance->late_time   = $value;
            $attendance->hotel_id    = auth()->user()->hotel_id;
            $attendances             = $attendance->save();
        }

        if ($attendances) {

            Session::flash('message', 'Attendance Updated Successfully!');
        } else {

            Session::flash('message', 'Attendance Update Failed!');
        }
    }
}
