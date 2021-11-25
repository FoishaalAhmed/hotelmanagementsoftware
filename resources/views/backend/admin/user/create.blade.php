@extends('backend.layouts.app')
@section('title', 'New User')
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
                    <!-- Content Header (user header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New User') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('User List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.users.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Name') }}</label>
                                                <input name="name" placeholder="{{ __('Name') }}" class="form-control"
                                                    required="" type="text" value="{{ old('name') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('E-mail Address') }}</label>
                                                <input type="email" class="form-control"
                                                    placeholder="{{ __('E-mail Address') }}" name="email"
                                                    value="{{ old('email') }}" required="" autocomplete="off">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Password') }}</label>
                                                <input type="password" class="form-control"
                                                    placeholder="{{ __('Password') }}" name="password"
                                                    value="{{ old('password') }}" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Confirm Password') }}</label>
                                                <input type="password" class="form-control"
                                                    placeholder="{{ __('Confirm Password') }}" name="password_confirmation"
                                                    required="" value="{{ old('password') }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Permission') }}</label>
                                                <select name="permission_id[]" class="form-control select2" id=""
                                                    style="width: 100%;" required="" multiple>
                                                    @foreach ($permissions as $key => $permission)
                                                        <option value="{{ $permission->id }}">{{ $permission->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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

                                            <h3 class="box-title"> {{ __('User Photo') }} </h3>

                                        </div>
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                src="//placehold.it/200x200" alt="User profile picture" id="user-photo">
                                            <input type="file" name="photo" onchange="readPicture(this)">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">

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
