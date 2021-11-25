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
                            <form action="{{ route('admin.employee-shifts.update', $emShift->id) }}"
                                class="form-horizontal" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="">{{ __('Employees') }}</label>
                                            <select name="employee_id" id="employee_id" class="form-control select2"
                                                style="width: 100%">
                                                @foreach ($employees as $item)
                                                    <option value="{{ $item->id }}" @if ($emShift->employee_id == $item->id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="col-md-12">

                                            <label for="">{{ __('Shifts') }}</label>
                                            <select name="shift_id" id="shift_id" class="form-control select2"
                                                style="width: 100%">
                                                @foreach ($shifts as $item)
                                                    <option value="{{ $item->id }}" @if ($emShift->shift_id == $item->id) {{ 'selected' }} @endif>
                                                        {{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for=""><br /></label>
                                    <button class="btn btn-sm bg-teal form-control"
                                        type="submit">{{ __('Update') }}</button>
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
