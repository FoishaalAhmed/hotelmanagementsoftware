<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Loan_advance;
use Illuminate\Http\Request;

class LoanAdvanceController extends Controller
{
    private $loanAdvanceObject;

    public function __construct()
    {
        $this->loanAdvanceObject = new Loan_advance();
    }

    public function index()
    {
        $loanAdvances = $this->loanAdvanceObject->getAllLoanOrAdvanced();
        return view('backend.admin.loanadvance.index', compact('loanAdvances'));
    }

    public function create()
    {
        $departments = Department::where('hotel_id', auth()->user()->hotel_id)->select('id', 'name')->get();
        return view('backend.admin.loanadvance.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate(Loan_advance::$validateRule);
        $this->loanAdvanceObject->storeLoanAdvance($request);
        return back();
    }

    public function destroy($id)
    {
        $this->loanAdvanceObject->destroyLoanAdvance($id);
        return back();
    }
}
