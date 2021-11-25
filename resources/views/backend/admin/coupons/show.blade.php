

@extends('backend.layouts.app')
@section('title', 'View Room')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{__('Dashboard')}}
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.rooms.index')}}"><i class="fa fa-group"></i> {{__('Rooms')}}</a></li>
            <li class="active">{{__('View Room')}}</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (Room header) -->
                <div class="box box-primary box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('View Room')}}</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.rooms.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> {{__('Room List')}}</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.error')
                        <form action="{{route('admin.rooms.update', $room->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Number')}}</label>
                                            <input name="number" placeholder="{{__('Number')}}" class="form-control" required="" type="text" value="{{ $room->number }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Type')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('Type')}}" name="type" value="{{$room->type}}" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Situate')}}</label>
                                            <input name="situate" placeholder="{{__('Situate')}}" class="form-control" type="text" value="{{ $room->situate }}" autocomplete="off" required="" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Facing')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('Facing')}}" name="facing" value="{{$room->facing}}" required="" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Bed')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('Bed')}}" name="bed" required="" value="{{$room->bed}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{__('Rent')}}</label>
                                            <input type="text" class="form-control" placeholder="{{__('Rent')}}" name="rent" required="" value="{{$room->rent}}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                @foreach ($facilities as $facility)
                                    
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>
                                        <input type="checkbox" class="flat-red" name="facilities[]" value="{{$facility->id}}" style="margin-left: 15px;" @if (in_array($facility->id, $roomFacility)) {{'checked'}}
                                            
                                        @endif>
                                        </label>
                                        <label>
                                        {{$facility->name}}
                                        </label>
                                    </div>
                                </div>

                                @endforeach

                            </div>
                            {{-- <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">{{__('Reset')}}</button>
                                    <button type="submit" class="btn btn-sm bg-blue">{{__('View')}}</button>
                                </center>
                            </div> --}}
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

