@extends('backend.layouts.app')

@section('title', 'Update Room Facility')
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
                            <h3 class="box-title">{{ __('Update Room Facility') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.room-facilities.index') }}"
                                    class="btn btn-sm bg-green"><i class="fa fa-list"></i>
                                    {{ __('Room Facility List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form
                                action="{{ route('admin.room-facilities.update', [$roomFacility->id]) }}"
                                method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room') }}</label>

                                                <select name="room_id" class="form-control select2" id="room_id" required>
                                                    @foreach ($rooms as $item)
                                                        <option value="{{ $item->id }}" @if ($roomFacility->room_id == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->number }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Facility') }}</label>
                                                <select name="facility_id" class="form-control select2" id="facility_id"
                                                    required>
                                                    <option value="">{{ 'Select Service' }}</option>
                                                    @foreach ($facility as $value)
                                                        <option value="{{ $value->id }}" @if ($value->id == $roomFacility->facility_id) {{ 'selected' }} @endif>
                                                            {{ $value->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Charge') }}</label>
                                                <select name="charge" class="form-control select2" id="" required>
                                                    <option value="Yes" @if ('Yes' == $roomFacility->charge) {{ 'selected' }} @endif>{{ 'Yes' }}
                                                    </option>
                                                    <option value="No" @if ('No' == $roomFacility->charge) {{ 'selected' }} @endif>{{ 'No' }}
                                                    </option>
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn-sm bg-purple">{{ __('Update') }}</button>
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

@section('footer')
@endsection
