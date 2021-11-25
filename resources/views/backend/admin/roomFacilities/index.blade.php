@extends('backend.layouts.app')
@section('title', 'Room Facility List')
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
                    <!-- Content Header (service header) -->
                    <div class="box box-6a8d9d box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Room Facility List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.room-facilities.create') }}"
                                    class="btn btn-sm bg-green"><i class="fa fa-plus"></i>
                                    {{ __('New Room Facility') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 35%;">{{ __('Room') }}</th>
                                        <th style="width: 30%;">{{ __('Service') }}</th>
                                        <th style="width: 15%;">{{ __('Charge') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomFacilities as $key => $facility)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $facility->number }}</td>
                                            <td>{{ $facility->facility }}</td>
                                            <td>{{ $facility->charge }}</td>

                                            <td>
                                                <a class="btn btn-sm btn-6a8d9d"
                                                    href="{{ route('admin.room-facilities.edit', [$facility->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form
                                                    action="{{ route('admin.room-facilities.destroy', [$facility->id]) }}"
                                                    method="post" style="display: none;"
                                                    id="delete-form-{{ $facility->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                                event.preventDefault();
                                                                getElementById('delete-form-{{ $facility->id }}').submit();
                                                                }else{
                                                                event.preventDefault();
                                                                }"><span class="glyphicon glyphicon-trash"></span>
                                                </a>
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
