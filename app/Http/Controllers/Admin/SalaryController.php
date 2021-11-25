<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    private $salaryObject;

    public function __construct()
    {
        $this->salaryObject = new Salary();
    }

    public function index()
    {
        $salaries = $this->salaryObject->getAllSalary();

        return view('backend.admin.salary.index', compact('salaries'));
    }

    public function store(Request $request)
    {

        $request->validate(Salary::$validateRule);
        $salary_id = $this->salaryObject->storeSalary($request);
        return redirect(route('salary.print', $salary_id));
    }

    public function destroy($id)
    {
        $this->salaryObject->destroySalary($id);

        return redirect()->back();
    }
}
