@extends('backend.layouts.app')
@section('title', 'Guide List')
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
                    <!-- Content Header (Guide header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Guide List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('tour.guides.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Guide') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">{{ __('Sl.') }}</th>
                                        <th style="width: 15%;">{{ __('Name') }}</th>
                                        <th style="width: 15%;">{{ __('Email') }}</th>
                                        <th style="width: 10%;">{{ __('Phone') }}</th>
                                        <th style="width: 15%;">{{ __('Gender') }}</th>
                                        <th style="width: 10%;">{{ __('Photo') }}</th>
                                        <th style="width: 20%;">{{ __('Address') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($guides as $key => $item)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>
                                                <img src="{{ asset($item->photo) }}" alt=""
                                                    style="width: 50px; height: 50px;">
                                            </td>
                                            <td>{{ $item->address }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('tour.guides.edit', [$item->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('tour.guides.destroy', [$item->id]) }}"
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
