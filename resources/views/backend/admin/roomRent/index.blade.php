@extends('backend.layouts.app')
@section('title', 'Room Rent List')
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
                        <h3 class="box-title">Room Rent List</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('admin.room-rents.create') }}" class="btn btn-sm bg-purple"><i
                                    class="fa fa-plus"></i> New Room Rent</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Sl.</th>
                                    <th style="width: 20%">Room</th>
                                    <th style="width: 50%">Rent Type</th>
                                    <th style="width: 15%">Rent</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rents as $key => $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $value->number }}</td>
                                        <td>{{ $value->type }}</td>
                                        <td>{{ $value->rent }}</td>
                                        <td>
                                            <a class="btn btn-sm bg-teal"
                                                href="{{ route('admin.room-rents.edit', $value->id) }}"><span
                                                    class="glyphicon glyphicon-edit"></span></a>
                                            <form action="{{ route('admin.room-rents.destroy', $value->id) }}"
                                                method="post" style="display: none;"
                                                id="delete-form-{{ $value->id }}">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{ $value->id }}').submit();
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
