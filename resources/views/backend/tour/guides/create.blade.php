@extends('backend.layouts.app')
@section('title', 'New Guide')
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
                    <!-- Content Header (Guide header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Guide') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('tour.guides.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Guide List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('tour.guides.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-9">
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
                                                <label>{{ __('Gender') }}</label>
                                                <select name="gender" id="gender" class="form-control" required
                                                    style="width: 100%">
                                                    <option value="Male" @if (old('gender') == 'Male') {{ 'selected' }} @endif>{{ __('Male') }}
                                                    </option>
                                                    <option value="Female" @if (old('gender') == 'Female') {{ 'selected' }} @endif>{{ __('Female') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Age') }}</label>
                                                <input type="numeric" class="form-control"
                                                    placeholder="{{ __('Age') }}" name="age"
                                                    value="{{ old('age') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('E-mail Address') }}</label>
                                                <input type="email" class="form-control"
                                                    placeholder="{{ __('E-mail Address') }}" name="email"
                                                    value="{{ old('email') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Phone') }}</label>
                                                <input name="phone" placeholder="{{ __('Phone') }}"
                                                    class="form-control" type="text" value="{{ old('phone') }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Address') }}</label>
                                                <textarea name="address" rows="3" class="form-control"
                                                    placeholder="{{ __('Address') }}"
                                                    style="resize: vertical;">{{ old('address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"> {{ __('Photo') }} </h3>
                                        </div>
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                src="//placehold.it/200x200" alt="Guide Picture" id="user-photo">
                                            <input type="file" name="photo" onchange="readPicture(this)">
                                        </div>
                                        <!-- /.box-body -->
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
        function readPicture(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#user-photo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
