@extends('backend.layouts.app')
@section('title', 'Table Booking List')
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
                    <!-- Content Header (Table Booking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Table Booking List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.bookings.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Table Booking') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 25%;">{{ __('Table') }}</th>
                                        <th style="width: 25%;">{{ __('Room') }}</th>
                                        <th style="width: 10%;">{{ __('Date') }}</th>
                                        <th style="width: 10%;">{{ __('Time') }}</th>
                                        <th style="width: 10%;">{{ __('Duration') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($bookings as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->table }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ date('d M, Y', strtotime($item->date)) }}</td>
                                            <td>{{ date('h:i A', strtotime($item->start_time)) }}</td>
                                            <td>{{ $item->duration }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('restaurant.bookings.edit', [$item->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('restaurant.bookings.destroy', [$item->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ date('Y-m-d') }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                                                        event.preventDefault();
                                                                                        getElementById('delete-form-{{ $item->id }}').submit();
                                                                                        }else{
                                                                                        event.preventDefault();
                                                                                        }"><span
                                                        class="glyphicon glyphicon-trash"></span></a>
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
