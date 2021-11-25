@extends('backend.layouts.app')
@section('title', 'Attendance list')
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
                        <h3 class="box-title">Attendance List</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.attendance.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New Attendance</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                    	@include('includes.error')
                    	<form action="{{route('admin.attendance')}}" method="GET" class="form-horizontal" enctype="multipart/form-data">
                    		@csrf
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <label>Months</label>
                                        <select name="month" class="form-control select2" id="" required="">
                                            <option value="">Select Months</option>
                                            @foreach ($months as $month)
                                                <option value="{{$month->id}}" @if (old('month') == $month->id) {{'selected'}}
                                                    
                                                @endif>{{$month->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Departments</label>
                                        <select name="department_id" class="form-control select2" id="department" onchange="getDepartmentEmployees()">
                                            <option value="">Select Departments</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Employee</label>
                                        <select name="employee_id" class="form-control select2" id="employee" required>
                                            <option value="">Select Departments First</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label for=""><br></label>
	                        	<button type="submit" class="btn btn-sm bg-teal form-control">Search</button>
                            </div>
                            
                            @if (isset($attendances))
                                <br><br>
                            
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

                            
                            @endif  
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
        function getDepartmentEmployees() {

            var department_id = $('#department').val();
            var department = $('#department option:selected').text();

            var url = '{{route("find.employee")}}';

            $.ajaxSetup({

                headers: {'X-CSRF-Token' : '{{csrf_token()}}'}

            });

            $.ajax({

                url: url,
                method: 'POST',
                data: { 'department_id' : department_id, },

                success: function(data2){

                    var data = JSON.parse(data2);

                    $('#employee').find('option').remove().end().append("<option value=''>Select " + department + " Employee</option>");

                    $.each(data, function (i, item) {

                        $("#employee").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }));
                    }); 
                    
                },

                error: function(error) {

                    console.log(error);
                }


            });
        }
    </script>
@endsection

