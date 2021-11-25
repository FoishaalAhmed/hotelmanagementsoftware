@extends('backend.layouts.app')
@section('title', 'Parking List')
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
                    <!-- Content Header (Parking header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Parking List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('parking.parkings.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Parking') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Date') }}</th>
                                        <th style="width: 10%;">{{ __('Category') }}</th>
                                        <th style="width: 10%;">{{ __('Type') }}</th>
                                        <th style="width: 10%;">{{ __('Room') }}</th>
                                        <th style="width: 10%;">{{ __('Ticket') }}</th>
                                        <th style="width: 10%;">{{ __('In') }}</th>
                                        <th style="width: 10%;">{{ __('Out') }}</th>
                                        <th style="width: 10%;">{{ __('Charge') }}</th>
                                        <th style="width: 10%;">{{ __('Paid') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($parkings as $key => $item)
                                        <tr>
                                            <td>{{ date('d M, Y', strtotime($item->created_at)) }} </td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $item->ticket }}</td>
                                            <td>{{ date('h:i A', strtotime($item->in_time)) }}</td>
                                            <td>
                                                @if ($item->out_time != null)
                                                    {{ date('h:i A', strtotime($item->out_time)) }}
                                                @endif
                                                
                                            </td>
                                            <td>{{ $item->charge }}</td>
                                            <td>{{ $item->paid }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('parking.parkings.edit', [$item->id]) }}"><span
                                                        class="fa fa-edit"></span></a>

                                                <form action="{{ route('parking.parkings.destroy', [$item->id]) }}"
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
