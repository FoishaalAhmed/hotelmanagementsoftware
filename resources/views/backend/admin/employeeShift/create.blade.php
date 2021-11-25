@extends('backend.layouts.app')
@section('title', 'New Employee Shift')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Employee Shift</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('admin.employee-shifts.index') }}" class="btn btn-sm bg-green"><i
                                    class="fa fa-plus"></i> Employee Shift List</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <form action="{{ route('admin.employee-shifts.store') }}" class="form-horizontal"
                                method="POST">
                                @csrf
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <label for="">{{ __('Shifts') }}</label>
                                            <select name="shift_id" id="shift_id" class="form-control select2"
                                                style="width: 100%">
                                                @foreach ($shifts as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-12">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 25%;">Select</th>
                                                    <th style="width: 75%;">Employee</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $key => $employee)
                                                    <tr>
                                                        <td><input type="checkbox" name="employee_id[]"
                                                                value="{{ $employee->id }}"></td>
                                                        <td>{{ $employee->name }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <br />
                                <div class="col-md-12">
                                    <center>
                                        <button class="btn btn-sm bg-red" type="reset">{{ __('Reset') }}</button>
                                        <button class="btn btn-sm bg-teal" type="submit">{{ __('Save') }}</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
