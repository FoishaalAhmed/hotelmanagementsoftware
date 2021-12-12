@extends('backend.layouts.app')
@section('title', 'Laundry Service List')
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
                    <!-- Content Header (Laundry Service header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Laundry Service List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('laundry.services.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Laundry Service') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 25%;">{{ __('Room') }}</th>
                                        <th style="width: 15%;">{{ __('Charge') }}</th>
                                        <th style="width: 25%;">{{ __('Method') }}</th>
                                        <th style="width: 15%;">{{ __('Paid') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($services as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->number }}</td>
                                            <td>{{ $item->charge }}</td>
                                            <td>{{ $item->method }}</td>
                                            <td>{{ $item->paid }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('laundry.services.show', [$item->id]) }}"><span
                                                        class="fa fa-eye"></span></a>

                                                <form action="{{ route('laundry.services.destroy', [$item->id]) }}"
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
