<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    private $departmentObject;

    public function __construct()
    {
        $this->departmentObject = new Department();
    }

    public function index()
    {
        $departments = Department::where('hotel_id', auth()->user()->hotel_id)->get();
        return view('backend.admin.department', compact('departments'));
    }

    public function store(Request $request)
    {
        $request->validate(Department::$validateRule);
        $this->departmentObject->storeDepartment($request);
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $request->validate(Department::$validateRule);
        $this->departmentObject->updateDepartment($request, $request->id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->departmentObject->deleteDepartment($id);
        return redirect()->back();
    }
}
