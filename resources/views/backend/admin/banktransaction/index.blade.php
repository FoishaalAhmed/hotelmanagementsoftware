@extends('backend.layouts.app')
@section('title', 'Bank Transaction List')
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
                        <h3 class="box-title">Bank transaction list</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.bank-transactions.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> New bank transaction</a>
                            
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
                                            <th style="width: 15%;">Date</th>
                                            <th style="width: 15%;">Bank</th>
                                            <th style="width: 15%;">Type</th>
                                            <th style="width: 20%;">Description</th>
                                            <th style="width: 15%;">Amount</th>
                                            <th style="width: 15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $deposite = 0; $withdraw = 0; 
                                        @endphp
                                        @foreach ($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{$loop->index + 1}}</td>
                                            <td>{{date('d M, Y', strtotime($transaction->date))}}</td>
                                            <td>{{$transaction->name}}</td>
                                            <td>{{$transaction->type}}</td>
                                            <td>{{$transaction->note}}</td>
                                            <td>{{$transaction->amount}} <?php if($transaction->type == 'Deposit') $deposite += $transaction->amount; else $withdraw += $transaction->amount; ?></td>
                                            <td>
                                            	<a class="btn btn-sm bg-teal" href="{{route('admin.bank-transactions.edit',$transaction->id)}}"><span class="glyphicon glyphicon-edit"></span></a>

                                            	<form action="{{route('admin.bank-transactions.destroy',$transaction->id)}}" method="post" style="display: none;" id="delete-form-{{$transaction->id}}">
                                                    @csrf
                                                    {{method_field('DELETE')}}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                    event.preventDefault();
                                                    getElementById('delete-form-{{$transaction->id}}').submit();
                                                    }else{
                                                    event.preventDefault();
                                                    }"><span class="glyphicon glyphicon-trash"></span></a>
                                                
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <td colspan="5" style="text-align: right; font-weight: bold;">Deposit =</td>
                                        <td>{{$deposite}}</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="text-align: right; font-weight: bold;">Withdraw =</td>
                                        <td>{{$withdraw}}</td>
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