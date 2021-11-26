@extends('backend.layouts.app')
@section('title', 'Gym Update')
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
                    <!-- Content Header (Gym header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Gym Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('gym.gyms.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Gym List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('gym.gyms.update', $gym->id) }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Name') }}</label>
                                                <input name="name" placeholder="{{ __('Name') }}" class="form-control"
                                                    required="" type="text" value="{{ $gym->name }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Capacity') }}</label>
                                                <input name="capacity" placeholder="{{ __('Capacity') }}"
                                                    class="form-control" type="numeric" value="{{ $gym->capacity }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="type" class="form-control" id="type" style="width: 100%"
                                                    required=''>
                                                    <option value="Male" @if ($gym->type == 'Male') {{ 'selected' }}

                                                        @endif>{{ __('Male') }}</option>
                                                    <option value="Female" @if ($gym->type == 'Female') {{ 'selected' }}

                                                        @endif>{{ __('Female') }}</option>

                                                    <option value="Combine" @if ($gym->type == 'Combine') {{ 'selected' }}

                                                        @endif>{{ __('Combine') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Trainer') }}</label>
                                                <select name="trainer" class="form-control" id="trainer"
                                                    style="width: 100%" required=''>
                                                    <option value="1" @if ($gym->trainer == 1)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if ($gym->trainer == 0)
                                                        {{ 'selected' }}

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
                                                    <option value="1" @if ($gym->ac == 1)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Available') }}</option>
                                                    <option value="0" @if ($gym->ac == 0)
                                                        {{ 'selected' }}

                                                        @endif>{{ __('Not Available') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Reset') }}</button>
                                        <button type="submit" class="btn btn-sm bg-blue">{{ __('Update') }}</button>
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
