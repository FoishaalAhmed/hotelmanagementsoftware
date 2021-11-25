

@extends('layouts.app')
@section('title', 'New salary payment')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('salary.index')}}"><i class="fa fa-group"></i> Salary payment</a></li>
            <li class="active">New salary payment</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (salary header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New salary payment</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('salary.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Salary payment list</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('salary.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Date</label>
                                        <input name="date" placeholder="Date" class="form-control" required="" type="text" value="{{ old('date') }}" autocomplete="off" id="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Employee</label>
                                        <select name="employee_id" class="form-control select2" id="employee">
                                            <option value="">Select Departments First</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Amount</label>
                                        <input name="amount" placeholder="Amount" class="form-control" required="" type="number" value="{{ old('amount') }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Note</label>
                                        <textarea name="note" placeholder="salary note" class="form-control" id="" rows="5">{{ old('note') }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">Reset</button>
                                    <button type="submit" class="btn btn-sm bg-teal">Save</button>
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

@section('footerSection')

    <script type="text/javascript">
        $(function () {
            $('#date').datepicker({
                autoclose:   true,
                changeYear:  true,
                changeMonth: true,
                dateFormat:  "dd-mm-yy",
                yearRange:   "-10:+10"
            });
        });

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

