@extends('backend.layouts.app')
@section('title', 'Employee List')
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
                            <h3 class="box-title">Employee list</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.employee-shifts.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> New employee</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="col-md-12">
                                <form action="" method="get" class="form-horizontal">
                                    @csrf
                                    <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label for="">{{ __('Shifts') }}</label>
                                                <select name="shift_id" id="shift_id" class="form-control select2"
                                                    style="width: 100%">
                                                    <option value="">{{ __('Select Shift') }}</option>
                                                    @foreach ($shifts as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <label for=""><br /></label>
                                        <button class="btn btn-sm bg-teal form-control"
                                            type="submit">{{ __('Search') }}</button>
                                    </div>
                                    <div class="col-md-3"></div>
                                </form>
                            </div>
                            @if (isset($employees))
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sl.</th>
                                            <th style="width: 25%;">Shift</th>
                                            <th style="width: 25%;">Employee</th>
                                            <th style="width: 20%;">Department</th>
                                            <th style="width: 15%;">Designation</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $key => $employee)
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td>
                                                <td>{{ $employee->shift }}</td>
                                                <td>{{ $employee->name }}</td>
                                                <td>{{ $employee->department }}</td>
                                                <td>{{ $employee->designation }}</td>
                                                <td>

                                                    <form
                                                        action="{{ route('admin.employee-shifts.destroy', $employee->id) }}"
                                                        method="post" style="display: none;"
                                                        id="delete-form-{{ $employee->id }}">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                    <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                event.preventDefault();
                                                getElementById('delete-form-{{ $employee->id }}').submit();
                                                }else{
                                                event.preventDefault();
                                                }"><span class="glyphicon glyphicon-trash"></span></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
