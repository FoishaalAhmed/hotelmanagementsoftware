@extends('backend.layouts.app')
@section('title', 'Hall Rent List')
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
                    <!-- Content Header (Hall Rent header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Hall Rent List') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('hall.rents.create') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-plus"></i> {{ __('New Hall Rent') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">{{ __('Sl.') }}</th>
                                        <th style="width: 50%;">{{ __('Name') }}</th>
                                        <th style="width: 15%;">{{ __('Type') }}</th>
                                        <th style="width: 15%;">{{ __('Rent') }}</th>
                                        <th style="width: 10%;">{{ __('Action') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($rents as $key => $room)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $room->name }}</td>
                                            <td>{{ $room->type }}</td>
                                            <td>{{ $room->rent }}</td>
                                            <td>
                                                <a class="btn btn-sm bg-blue"
                                                    href="{{ route('hall.rents.edit', [$room->id]) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a>

                                                <form action="{{ route('hall.rents.destroy', [$room->id]) }}" method="post"
                                                    style="display: none;" id="delete-form-{{ $room->id }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                </form>
                                                <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                                event.preventDefault();
                                                getElementById('delete-form-{{ $room->id }}').submit();
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

@section('footer')
@endsection
