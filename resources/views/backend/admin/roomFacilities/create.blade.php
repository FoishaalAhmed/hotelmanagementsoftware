@extends('backend.layouts.app')

@section('title', 'Room Facility Add')
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
                    <!-- Content Header (slider header) -->
                    <div class="box box-purple box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Room Facility') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.room-facilities.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i>
                                    {{ __('Room Facility List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.room-facilities.store') }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room') }}</label>
                                                <select name="room_id" class="form-control select2" id="room_id" required>
                                                    <option value="">{{ 'Select Room' }}</option>
                                                    @foreach ($rooms as $room)
                                                        <option value="{{ $room->id }}">{{ $room->number }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @foreach ($facility as $key => $item)
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td width="10%"></td>
                                                    <td width="40%">
                                                        <div class="form-group">
                                                            <label>
                                                                <input type="checkbox" class="flat-red"
                                                                    name="facility_id[]" value="{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td width="50%">
                                                        <div class="form-group">
                                                            <label> Charge Applicable
                                                                <input type="radio"
                                                                    name="charge[]" id="yes<?= $key ?>" value="Yes"> <label for="yes<?= $key ?>">Yes</label>
                                                                <input type="radio"
                                                                    name="charge[]" id="no<?= $key ?>" value="No"> <label for="no<?= $key ?>">No</label>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-purple">{{ __('Save') }}</button>
                                    </center>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
