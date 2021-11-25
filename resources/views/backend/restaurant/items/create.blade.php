@extends('backend.layouts.app')
@section('title', 'New Item')
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
                    <!-- Content Header (Item header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Item') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.items.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Item List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.items.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-9">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="food_type_id" class="form-control select2" id="food_type_id"
                                                    style="width: 100%;" required="">
                                                    @foreach ($types as $key => $type)
                                                        <option value="{{ $type->id }}" @if (old('food_type_id') == $type->id) {{ 'selected' }}  @endif>
                                                            {{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Category') }}</label>
                                                <select name="food_category_id" class="form-control select2"
                                                    id="food_category_id" style="width: 100%;" required="">
                                                    @foreach ($categories as $key => $category)
                                                        <option value="{{ $category->id }}" @if (old('food_category_id') == $category->id) {{ 'selected' }}  @endif>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
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
                                                <label>{{ __('Price') }}</label>
                                                <input name="price" placeholder="{{ __('Price') }}"
                                                    class="form-control" type="number" value="{{ old('price') }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Description') }}</label>
                                                <textarea name="description"
                                                    id="editor">{{ old('description') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"> {{ __('Item Photo') }} </h3>
                                        </div>
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                src="//placehold.it/200x200" alt="User profile picture" id="itemPhoto">
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
                    $('#itemPhoto')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            CKEDITOR.replace('editor')
        });
    </script>
@endsection
