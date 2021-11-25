@extends('backend.layouts.app')
@section('title', 'Room List')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{__('Dashboard')}}
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.rooms.index')}}"><i class="fa fa-group"></i> {{__('Rooms')}}</a></li>
            <li class="active">{{__('List')}}</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (Room header) -->
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Room List')}}</h3>
                        <div class="box-tools pull-right">
                        	<a href="{{route('admin.rooms.create')}}" class="btn btn-sm bg-green"><i class="fa fa-plus"></i> {{__('New Room')}}</a>
                        </div>		
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">{{__('Sl.')}}</th>
                                    <th style="width: 15%;">{{__('Number')}}</th>
                                    <th style="width: 15%;">{{__('Type')}}</th>
                                    <th style="width: 15%;">{{__('Situate')}}</th>
                                    <th style="width: 15%;">{{__('Facing')}}</th>
                                    <th style="width: 15%;">{{__('Bed')}}</th>
                                    <th style="width: 10%;">{{__('Rent')}}</th>
                                    <th style="width: 10%;">{{__('Action')}}</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @foreach ($rooms as $key => $room)
                                <tr>
                                    <td>{{$loop->index + 1}}</td>
                                    <td>{{$room->number}}</td>
                                    <td>{{$room->type}}</td>
                                    <td>{{$room->situate}}</td>
                                    <td>{{$room->facing}}</td>
                                    <td>{{$room->beds}}</td>
                                    <td>{{$room->rate}}</td>
                                    <td>
                                    	<a class="btn btn-sm bg-blue" href="{{route('admin.rooms.edit',[$room->id])}}"><span class="glyphicon glyphicon-edit"></span></a>

                                    	<form action="{{route('admin.rooms.destroy',[$room->id])}}" method="post" style="display: none;" id="delete-form-{{ $room->id}}">
                                            @csrf
                                            {{method_field('DELETE')}}
                                        </form>
                                        <a class="btn btn-sm bg-red" href="" onclick="if(confirm('Are You Sure To Delete?')){
                                            event.preventDefault();
                                            getElementById('delete-form-{{ $room->id}}').submit();
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