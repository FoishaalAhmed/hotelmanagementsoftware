<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    private $employeeObject;

    public function __construct()
    {
        $this->employeeObject = new Employee();
    }

    public function index()
    {
        $employees = $this->employeeObject->getAllEmployee();
        return view('backend.admin.employee.index', compact('employees'));
    }

    public function create()
    {
        $departments = Department::all();
        return view('backend.admin.employee.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate(Employee::$validateRule);
        $this->employeeObject->storeEmployee($request);
        return redirect()->back();
    }

    public function edit($id)
    {
        $departments = Department::all();
        $employee    = Employee::findOrFail($id);
        return view('backend.admin.employee.edit', compact('departments', 'employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(Employee::$validateRule);
        $this->employeeObject->updateEmployee($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->employeeObject->destroyEmployee($id);
        return redirect()->back();
    }
}
