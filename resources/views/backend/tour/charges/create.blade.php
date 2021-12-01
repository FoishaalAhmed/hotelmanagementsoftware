@extends('backend.layouts.app')
@section('title', 'New Guide Charge')
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
                    <!-- Content Header (Guide Charge header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Guide Charge') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('tour.charges.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Guide Charge List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('tour.charges.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Guide') }}</label>
                                                <select name="guide_id" id="guide_id" class="form-control" required
                                                    style="width: 100%">
                                                    @foreach ($guides as $item)
                                                        <option value="{{ $item->id }}" @if (old('guide_id') == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="type" id="type" class="form-control" required
                                                    style="width: 100%" onchange="showHidePackage(this.value)">
                                                    <option value="Daily" @if (old('type') == 'Daily') {{ 'selected' }} @endif>{{ __('Daily') }}
                                                    </option>
                                                    <option value="Hourly" @if (old('type') == 'Hourly') {{ 'selected' }} @endif>{{ __('Hourly') }}
                                                    </option>
                                                    <option value="Package" @if (old('type') == 'Package') {{ 'selected' }} @endif>{{ __('Package') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="package" style="display: none">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Package') }}</label>
                                                <select name="package_id" id="package_id" class="form-control" style="width: 100%">
                                                    <option value="">{{ __('Select Package') }}
                                                    </option>
                                                    @foreach ($packages as $item)
                                                        <option value="{{ $item->id }}" @if (old('package_id') == $item->id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Charge') }}</label>
                                                <input name="charge" placeholder="{{ __('Charge') }}"
                                                    class="form-control" type="text" value="{{ old('charge') }}"
                                                    autocomplete="off" required="">
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

@section('footer')
    <script>
        function showHidePackage(type) {
            if (type == 'Package') {
                $('#package').show();
            } else {
                $('#package').hide();
            }
        }
    </script>
@endsection
