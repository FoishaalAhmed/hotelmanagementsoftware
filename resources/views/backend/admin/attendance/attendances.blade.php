@extends('backend.layouts.app')
@section('title', 'Attendance list')
@section('headSection')
    <style>
        .employee-class {
            border: 1px solid #83878d;
            padding: 5px;
            margin-bottom: 15px;
            background: #83878d;
            color: white;
        }
    </style>
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.attendance')}}"><i class="fa fa-group"></i> Attendance</a></li>
            <li class="active">list</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (attendance header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Employee Attendance</h3>
                        <div class="box-tools pull-right">
                        	
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @include('includes.error')
                        <div class="col-md-6">
                            <div class="employee-class">
                                <p> <b> Name : </b> {{$employee_info->name}}</p>
                                <p><b> Join date : {{date('d M, Y', strtotime($employee_info->join_date))}}</b> </p>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="employee-class">

                                <p><b> Reference : </b> {{$employee_info->reference}}</p>
                                <p><b> Contact : </b> {{$employee_info->phone}}</p>
                            </div> 
                            
                        </div>
                    
                        <div class="col-md-12">
                            <table class="table table_th_teal">
                                <thead>
                                    <tr>
                                        <th style="width: 25%">Date</th>
                                        <th style="width: 15%">In time</th>
                                        <th style="width: 15%">Out time</th>
                                        <th style="width: 15%">Late</th>
                                        <th style="width: 30%">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attendances as $key => $attendance) 
                                    <tr>
                                        <td> {{date('d M, Y', strtotime($attendance->date))}}</td>
                                        <td> {{$attendance->in_time}}</td>
                                        <td> {{$attendance->out_time}}</td>
                                        <td> {{$attendance->late_time}}</td>
                                        <td> {{$attendance->remarks}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <form action="{{route('admin.salary.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="salary-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Absent Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="absent" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Lone/Advance Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="loan" class="form-control" value="{{$loan_advances}}" autocomplete="off" readonly>

                                            <input type="hidden" name="month_id" value="{{$month}}" autocomplete="off">

                                            <input type="hidden" name="employee_id" value="{{$employee_info->id}}" autocomplete="off">

                                            <input type="hidden" name="department_id" value="{{$employee_info->department_id}}" autocomplete="off">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Late Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="late" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Late Fine Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="late_fine" class="form-control" autocomplete="off" id="late_fine" onkeyup="calculateSalary();">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Leave Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="leave" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Gross salary : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="gross_salary" class="form-control" autocomplete="off" value="{{$employee_info->salary}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Attendanse Of This Month : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="present" class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Rady to Pay : </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="amount" class="form-control" autocomplete="off" id="amount" value="{{$employee_info->salary- $loan_advances}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <center>
                                    <button type="submit" class="btn btn-sm bg-teal">Print</button>
                                </center>
                            </div>
                        </form>  
                        
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        $(function () {

            $('#date').datepicker({
                autoclose:   true,
                changeYear:  true,
                changeMonth: true,
                dateFormat:  "dd-mm-yy",
                yearRange:   "-10:+10"
            });
        });

        function calculateSalary() {

            let lateFine    = $('#late_fine').val();
            let advanced    = "{{$loan_advances}}";
            let grossSalary = "{{$employee_info->salary}}";

            let readyToPay = parseInt(grossSalary) - parseInt(lateFine) - parseInt(advanced);

            $('#amount').val(readyToPay);
        }
        
    </script>
@endsection

