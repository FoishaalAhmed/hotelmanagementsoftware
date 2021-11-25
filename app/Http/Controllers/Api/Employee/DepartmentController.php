<?php

namespace App\Http\Controllers\Api\Employee;

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
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Employee')) {
            $departments = Department::where('hotel_id', auth()->user()->hotel_id)->get();
            return response()->json($departments, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Employee')) {
            $request->validate(Department::$validateRule);
            $this->departmentObject->storeDepartment($request);
            $response = ['message' => 'New Department Stored Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function show($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Employee')) {
            $department = Department::where('hotel_id', auth()->user()->hotel_id)->where('id', $id)->first();
            return response()->json($department, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Employee')) {
            $request->validate(Department::$validateRule);
            $this->departmentObject->updateDepartment($request, $id);
            $response = ['message' => 'Department Updated Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }

    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('All') || auth()->user()->hasPermissionTo('Employee')) {
            $this->departmentObject->deleteDepartment($id);
            $response = ['message' => 'Department Deleted Successfully!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'You are unauthorized for this action'];
            return response()->json($response, 401);
        }
    }
}
