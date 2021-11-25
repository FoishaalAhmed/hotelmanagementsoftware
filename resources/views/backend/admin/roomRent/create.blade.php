@extends('backend.layouts.app')
@section('title', 'Room Rent')
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
                        <h3 class="box-title">Room Rent</h3>
                        <div class="box-tools pull-right">
                            <a href="{{ route('admin.room-rents.index') }}" class="btn btn-sm bg-purple"><i
                                    class="fa fa-list"></i> Room Rent List</a>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="box-body">
                        @include('includes.error')
                        <br>
                        @if (!isset($rent))
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.room-rents.store') }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Room') }}</label>
                                                    <select name="room_id" id="room_id" class="form-control select2"
                                                        style="width: 100%" required>
                                                        @foreach ($rooms as $item)
                                                            <option value="{{ $item->id }}" @if (old('room_id') == $item->id) {{ 'selected' }} @endif>
                                                                {{ $item->number }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Rent Type') }}</label>
                                                    <select name="type" id="type" class="form-control select2"
                                                        style="width: 100%" required>
                                                        <option value="Seasonal Rate" @if (old('type') == 'Seasonal Rate') {{ 'selected' }} @endif>Seasonal
                                                            Rate</option>
                                                        <option value="Festival Rate" @if (old('type') == 'Festival Rate') {{ 'selected' }} @endif>Festival
                                                            Rate</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label for="name">{{ __('Rent') }}</label>
                                                    <input type="text" name="rent" class="form-control"
                                                        placeholder="{{ __('Rent') }}" required=""
                                                        value="{{ old('rent') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label for=""><br /></label>
                                            <button type="submit"
                                                class="btn btn-sm bg-teal form-control">{{ __('Save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="{{ route('admin.room-rents.update', $rent->id) }}" method="post"
                                        class="form-horizontal">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{ route('admin.room-rents.store') }}" method="post"
                                                    class="form-horizontal">
                                                    @csrf
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="name">{{ __('Room') }}</label>
                                                                <select name="room_id" id="room_id"
                                                                    class="form-control select2" style="width: 100%"
                                                                    required>
                                                                    @foreach ($rooms as $item)
                                                                        <option value="{{ $item->id }}" @if ($rent->room_id == $item->id) {{ 'selected' }} @endif>
                                                                            {{ $item->number }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="name">{{ __('Rent Type') }}</label>
                                                                <select name="type" id="type"
                                                                    class="form-control select2" style="width: 100%"
                                                                    required>
                                                                    <option value="Seasonal Rate" @if ($rent->type == 'Seasonal Rate') {{ 'selected' }} @endif>Seasonal
                                                                        Rate</option>
                                                                    <option value="Festival Rate" @if ($rent->type == 'Festival Rate') {{ 'selected' }} @endif>Festival
                                                                        Rate</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <label for="name">{{ __('Rent') }}</label>
                                                                <input type="text" name="rent" class="form-control"
                                                                    placeholder="{{ __('Rent') }}" required=""
                                                                    value="{{ $rent->rent }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label for=""><br /></label>
                                                        <button type="submit"
                                                            class="btn btn-sm bg-teal form-control">{{ __('Update') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
