@extends('backend.layouts.app')
@section('title', 'Loan advance List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.loan.advance')}}"><i class="fa fa-group"></i> Loan or Advances</a></li>
            <li class="active">List</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (user header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Loan advance list</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.loan.advance.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New loan advance</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%;">Sl.</th>
                                            <th style="width: 10%;">Date</th>
                                            <th style="width: 15%;">Employee</th>
                                            <th style="width: 15%;">Department</th>
                                            <th style="width: 10%;">Type</th>
                                            <th style="width: 25%;">Note</th>
                                            <th style="width: 10%;">Amount</th>
                                            <th style="width: 10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $net_total = 0;
                                        @endphp
                                        @foreach ($loanAdvances as $key => $loanAdvance)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{date('d M, Y', strtotime($loanAdvance->date))}}</td>
                                            <td>{{$loanAdvance->employee}}</td>
                                            <td>{{$loanAdvance->department}}</td>
                                            <td>{{$loanAdvance->type}}</td>
                                            <td>{{$loanAdvance->note}}</td>
                                            <td>{{$loanAdvance->amount}} <?php $net_total +=$loanAdvance->amount; ?></td>
                                            <td>
                                            	<form action="{{route('admin.loan.advance.destroy',$loanAdvance->id)}}" method="post" style="display: none;" id="delete-form-{{$loanAdvance->id}}">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{$loanAdvance->id}}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <td colspan="6" style="text-align: right; font-weight: bold;">Total=</td>
                                        <td>{{$net_total}}</td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection