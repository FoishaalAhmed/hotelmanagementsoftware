<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeShift extends Model
{
    protected $fillable = [
        'employee_id', 'shift_id',
    ];

    public function getEmployeeShift(Int $shift_id)
    {
        $employees = $this::join('employees', 'employee_shifts.employee_id', '=', 'employees.id')
            ->join('shifts', 'employee_shifts.shift_id', '=', 'shifts.id')
            ->leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where('employee_shifts.shift_id', $shift_id)
            ->select('employees.name', 'departments.name as department', 'employees.designation', 'employee_shifts.id', 'shifts.name as shift')
            ->get();
        return $employees;
    }

    public function storeEmployeeShift(Object $request)
    {
        foreach ($request->employee_id as $key => $value) {
            $shift = new EmployeeShift();
            $shift->employee_id = $value;
            $shift->shift_id = $request->shift_id;
            $storeEmployeeShift = $shift->save();
        }

        isset($storeEmployeeShift)
            ? session()->flash('message', 'Employee Shift Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateEmployeeShift(Object $request, Int $id)
    {

        $shift = $this::findOrFail($id);
        $shift->employee_id = $request->employee_id;
        $shift->shift_id = $request->shift_id;
        $updateEmployeeShift = $shift->save();

        $updateEmployeeShift
            ? session()->flash('message', 'Employee Shift Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyEmployeeShift(Int $id)
    {
        $shift = $this::findOrFail($id);
        $destroyEmployeeShift = $shift->delete();

        $destroyEmployeeShift
            ? session()->flash('message', 'Employee Shift Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
