<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan_advance extends Model
{
    protected $fillable = [
        'hotel_id', 'date', 'employee_id', 'note', 'amount', 'department_id', 'type',
    ];

    public static $validateRule = [

        'amount'         => 'required|numeric',
        'date'           => 'required|date',
        'note'           => 'nullable|string',
        'employee_id'    => 'required|numeric',
        'department_id'  => 'required|numeric',
        'type'           => 'required|string|max:255',
    ];

    public function getAllLoanOrAdvanced()
    {
        $loan_advances = $this::leftJoin('employees', 'loan_advances.employee_id', '=', 'employees.id')
            ->leftJoin('departments', 'loan_advances.department_id', '=', 'departments.id')
            ->where('loan_advances.hotel_id', auth()->user()->hotel_id)
            ->orderBy('loan_advances.date', 'desc')
            ->select('loan_advances.*', 'departments.name as department', 'employees.name as employee')
            ->get();
        return $loan_advances;
    }

    public function getLoanOrAdvanceByEmployeeAndMonth($month, $employee)
    {
        $loan_advances = $this::whereMonth('date', $month)
            ->where('employee_id', $employee)
            ->selectRaw('SUM(amount) as total_amount');

        return  $loan_advances->count() > 0 ? $loan_advances->first()->total_amount : '0';
    }

    public function storeLoanAdvance($request)
    {
        $this->date          = date('Y-m-d', strtotime($request->date));
        $this->hotel_id      = auth()->user()->hotel_id;
        $this->employee_id   = $request->employee_id;
        $this->department_id = $request->department_id;
        $this->note          = $request->note;
        $this->amount        = $request->amount;
        $this->type          = $request->type;
        $storeLoanAdvance    = $this->save();
        $storeLoanAdvance
            ? session()->flash('message', 'Loan Or Advance Paid Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyLoanAdvance($id)
    {
        $loanAdvance = $this->findOrFail($id);
        $destroyLoanAdvance = $loanAdvance->delete();
        $destroyLoanAdvance
            ? session()->flash('message', 'Loan Or Advance Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
