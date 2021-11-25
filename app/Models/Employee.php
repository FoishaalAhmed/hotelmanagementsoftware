<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'hotel_id', 'department_id', 'name', 'employee_id', 'join_date', 'reference', 'phone', 'email', 'address', 'photo', 'designation', 'salary',
    ];

    public static $validateRule = [

        'photo'        => 'mimes:jpeg,jpg,png,gif|max:100|nullable',
        'name'         => 'required|string|max:255',
        'employee_id'  => 'string|max:255|required',
        'designation'  => 'string|max:255|required',
        'department_id' => 'numeric|required',
        'email'        => 'email|max:255|nullable',
        'phone'        => 'required|string|max:15',
        'reference'    => 'string|nullable|max:255',
        'address'      => 'string|nullable',
        'join_date'    => 'date|required',
    ];

    public function getAllEmployee()
    {
        $employees = $this::leftJoin('departments', 'employees.department_id', '=', 'departments.id')
            ->where('employees.hotel_id', auth()->user()->hotel_id)
            ->orderBy('employees.join_date', 'desc')
            ->select('employees.*', 'departments.name as department')
            ->get();
        return $employees;
    }

    public function storeEmployee($request)
    {
        $image = $request->file('photo');

        if ($image) {

            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/employees/' . $image_full_name;
            $success         = $image->storeAs('employees', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $this->hotel_id      = auth()->user()->hotel_id;
        $this->name          = $request->name;
        $this->employee_id   = $request->employee_id;
        $this->designation   = $request->designation;
        $this->department_id = $request->department_id;
        $this->email         = $request->email;
        $this->phone         = $request->phone;
        $this->reference     = $request->reference;
        $this->address       = $request->address;
        $this->salary        = $request->salary;
        $this->join_date     = date('Y-m-d', strtotime($request->join_date));
        $storeEmployee = $this->save();

        $storeEmployee
            ? session()->flash('message', 'Employee Created Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function updateEmployee($request, $id)
    {
        $employee = $this::findOrFail($id);
        $image = $request->file('photo');

        if ($image) {

            if (file_exists($employee->photo)) unlink($employee->photo);
            $image_name      = date('YmdHis');
            $ext             = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $image_url       = 'https://amarlodge.com/public/images/employees/' . $image_full_name;
            $success         = $image->storeAs('employees', $image_full_name, 'parent_disk');
            $this->photo     = $image_url;
        }

        $employee->hotel_id      = auth()->user()->hotel_id;
        $employee->name          = $request->name;
        $employee->employee_id   = $request->employee_id;
        $employee->designation   = $request->designation;
        $employee->department_id = $request->department_id;
        $employee->email         = $request->email;
        $employee->phone         = $request->phone;
        $employee->reference     = $request->reference;
        $employee->address       = $request->address;
        $employee->salary        = $request->salary;
        $employee->join_date     = date('Y-m-d', strtotime($request->join_date));

        $updateEmployee = $employee->save();

        $updateEmployee
            ? session()->flash('message', 'Employee Updated Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }

    public function destroyEmployee($id)
    {
        $employee = $this::findOrFail($id);
        if (file_exists($employee->photo)) unlink($employee->photo);
        $destroyEmployee = $employee->delete();

        $destroyEmployee
            ? session()->flash('message', 'Employee Deleted Successfully!')
            : session()->flash('message', 'Something Went Wrong!');
    }
}
