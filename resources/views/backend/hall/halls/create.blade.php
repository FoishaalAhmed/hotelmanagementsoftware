@extends('backend.layouts.app')
@section('title', 'New Hall')
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
                    <!-- Content Header (hall header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Hall') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('hall.halls.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Hall List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('hall.halls.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Name') }}</label>
                                                <input name="name" placeholder="{{ __('Name') }}" class="form-control"
                                                    required="" type="text" value="{{ old('name') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Category') }}</label>
                                                <select name="hall_category_id" class="form-control select2" id="type"
                                                    required="" style="width: 100%">
                                                    @foreach ($categories as $item)
                                                        <option value="{{ $item->id }}" @if (old('hall_category_id') == $item->name) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Capacity') }}</label>
                                                <input name="capacity" placeholder="{{ __('Capacity') }}"
                                                    class="form-control" type="numeric" value="{{ old('capacity') }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Board') }}</label>
                                                <select name="board" class="form-control" id="board" style="width: 100%"
                                                    required=''>
                                                    <option value="1" @if (old('board') == 1) {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('board') == 0) {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Stage') }}</label>
                                                <select name="stage" class="form-control" id="stage" style="width: 100%"
                                                    required=''>
                                                    <option value="1" @if (old('stage') == 1) {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('stage') == 0) {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Projector') }}</label>
                                                <select name="projector" class="form-control" id="projector"
                                                    style="width: 100%" required=''>
                                                    <option value="1" @if (old('projector') == 1) {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('projector') == 0) {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Air Condition') }}</label>
                                                <select name="ac" class="form-control" id="ac" style="width: 100%"
                                                    required=''>
                                                    <option value="1" @if (old('ac') == 1)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('ac') == 0)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Fan') }}</label>
                                                <select name="fan" class="form-control" id="fan" style="width: 100%"
                                                    required=''>
                                                    <option value="1" @if (old('fan') == 1)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('fan') == 0)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Sound System') }}</label>
                                                <select name="sound_system" class="form-control" id="sound_system"
                                                    style="width: 100%" required=''>
                                                    <option value="1" @if (old('sound_system') == 1) {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if (old('sound_system') == 0) {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Save') }}</button>
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
