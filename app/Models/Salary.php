<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Session;

class Salary extends Model
{
    protected $fillable = [

        'date', 'employee_id', 'note', 'amount', 'department_id', 'month_id', 'late', 'leave_days', 'absent', 'present', 'late_fine',
    ];

    public static $validateRule = [

        'amount'         => 'required|numeric|between: 0,99999999999.99',
        //'date'           => 'required|date',
        'note'           => 'nullable|string',
        'employee_id'    => 'required|numeric',
        'department_id'  => 'required|numeric',
        'month_id'  => 'required|numeric',
        'late'  => 'nullable|numeric',
        'leave_days'  => 'nullable|numeric',
        'absent'  => 'nullable|numeric',
        'present'  => 'required|numeric',
        'late_fine'  => 'nullable|numeric',
    ];

    public function get_staff_salary_report($start_date, $end_date)
    {
        $query = $this::selectRaw('SUM(amount) as total')
                        ->whereBetween('created_at', [
                        $start_date.' 00:00:00',
                        $end_date.' 23:59:59'
                        ]);
        if ($query->count() > 0) {

            return $query->first()->total;

        } else {
            
            return '0';
        }                 
                        
    }

    public function getAllSalary()
    {
        $salaries = $this::leftJoin('employees', 'salaries.employee_id', '=', 'employees.id')
                          ->leftJoin('departments', 'salaries.department_id', '=', 'departments.id')
                          ->orderBy('salaries.date', 'desc')
                          ->select('salaries.*', 'departments.name as department', 'employees.name as employee')
                          ->get();
        return $salaries;
    }

    public function storeSalary($request)
    {
        $this->month_id      = $request->month_id;
        $this->date          = date('Y-m-d');
        $this->employee_id   = $request->employee_id;
        $this->department_id = $request->department_id;
        $this->late          = $request->late;
        $this->leave_days    = $request->leave;
        $this->absent        = $request->absent;
        $this->present       = $request->present;
        $this->late_fine     = $request->late_fine;
        $this->note          = $request->note;
        $this->amount        = $request->amount;

        $salary = $this->save();

        return $this->id;
    }

    public function destroySalary($id)
    {
        $destroySalary = $this->where('id', $id)->delete();
        $destroySalary
        ? Session::flash('message', 'Salary Deleted Successfully!')
        : Session::flash('message', 'Something Went Wrong!');
    }
}
