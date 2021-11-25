@extends('backend.layouts.app')
@section('title', 'Order List')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                {{ __('Dashboard') }}
                <small>Version 2.0</small>
            </h1>
        </section>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Content Header (Order header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Order List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.orders.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Order') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 20%;">{{ __('Date & Time') }}</th>
                                        <th style="width: 10%;">{{ __('Invoice') }}</th>
                                        <th style="width: 10%;">{{ __('Room') }}</th>
                                        <th style="width: 10%;">{{ __('Table') }}</th>
                                        <th style="width: 15%;">{{ __('Total') }}</th>
                                        <th style="width: 15%;">{{ __('Paid') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ date('d M, Y', strtotime($item->date)) }}
                                                {{ date('h:i A', strtotime($item->time)) }}</td>
                                            <td>{{ $item->invoice }}</td>
                                            <td>{{ $item->room }}</td>
                                            <td>{{ $item->table }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td>{{ $item->paid }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('restaurant.orders.show', [$item->id]) }}"><span
                                                        class="fa fa-eye"></span></a>

                                                <form action="{{ route('restaurant.orders.destroy', [$item->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                                event.preventDefault();
                                                                getElementById('delete-form-{{ $item->id }}').submit();
                                                                }else{
                                                                event.preventDefault();
                                                                }"><span class="glyphicon glyphicon-trash"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
