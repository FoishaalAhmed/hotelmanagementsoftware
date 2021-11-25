

@extends('backend.layouts.app')
@section('title', 'New Loan Or Advance add')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.loan.advance')}}"><i class="fa fa-group"></i> Loan Or Advances</a></li>
            <li class="active">New salary</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (salary header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">New Loan Or Advance</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.loan.advance')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Loan Or Advance list</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.error')
                        <form action="{{route('admin.loan.advance.store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Date</label>
                                        <input name="date" placeholder="Date" class="form-control" required="" type="text" value="{{ date('d-m-Y') }}" autocomplete="off" id="date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Departments</label>
                                        <select name="department_id" class="form-control select2" id="department" onchange="getDepartmentEmployees()" required>
                                            <option value="">Select Departments</option>
                                            @foreach ($departments as $department)
                                                <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Employee</label>
                                        <select name="employee_id" class="form-control select2" id="employee" required>
                                            <option value="">Select Departments First</option>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Payment Type</label>
                                        <select name="type" class="form-control select2" id="type" required="">
                                            <option value="Loan">Loan</option>
                                            <option value="Advance">Advance</option>
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
                                        <textarea name="note" placeholder="Loan or advance note" class="form-control" id="" rows="5">{{ old('note') }}</textarea>
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

@section('footer')

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

