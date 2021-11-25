

@extends('layouts.app')
@section('title', ' Salary Update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('salaries.index')}}"><i class="fa fa-group"></i> Salaries</a></li>
            <li class="active"> Salary Update</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (salary header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Salary Update</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('salaries.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Salary list</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.errormessage')
                        <form action="{{route('salaries.update',$salary->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Staff</label>
                                        <input name="staff" placeholder="Staff" class="form-control" required="" type="text" value="{{ $salary->staff }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Method</label>
                                        <select name="payment_method" class="form-control" id="">
                                            <option value="Cash" @if ($salary->payment_method == 'Cash') {{ 'selected' }}
                                                
                                            @endif>Cash</option>
                                            <option value="Bank" @if ($salary->payment_method == 'Bank') {{ 'selected' }}
                                                
                                            @endif>Bank</option>
                                            <option value="Bkash" @if ($salary->payment_method == 'Bkash') {{ 'selected' }}
                                                
                                            @endif>Bkash</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Amount</label>
                                        <input name="amount" placeholder="Amount" class="form-control" required="" type="number" value="{{ $salary->amount }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>Note</label>
                                        <textarea name="note" placeholder="salary note" class="form-control" id="" rows="5">{{ $salary->note }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">Cancel</button>
                                    <button type="submit" class="btn btn-sm bg-teal">Update</button>
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

