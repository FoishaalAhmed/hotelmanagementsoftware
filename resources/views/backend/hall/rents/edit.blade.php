@extends('backend.layouts.app')
@section('title', 'Hall Rent Update')
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
                            <h3 class="box-title">{{ __('Hall Rent Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('hall.rents.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Hall Rent List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('hall.rents.update', $rent->id) }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Hall') }}</label>
                                                <select name="hall_id" class="form-control select2" id="type"
                                                    required="" style="width: 100%">
                                                    @foreach ($halls as $item)
                                                        <option value="{{ $item->id }}" @if ($rent->hall_id == $item->name) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('type') }}</label>
                                                <select name="type" class="form-control" id="type" style="width: 100%"
                                                    required=''>
                                                    <option value="Hourly" @if ($rent->type == 'Hourly') {{ 'selected' }}

                                                        @endif>{{ __('Hourly') }}</option>
                                                    <option value="Daily" @if ($rent->type == 'Daily') {{ 'selected' }}

                                                        @endif>{{ __('Daily') }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Rent') }}</label>
                                                <input name="rent" placeholder="{{ __('Rent') }}"
                                                    class="form-control" type="numeric" value="{{ $rent->rent }}"
                                                    autocomplete="off" required="">
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
