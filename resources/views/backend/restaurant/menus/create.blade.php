@extends('backend.layouts.app')
@section('title', 'Today Menu')
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
                    <!-- Content Header (Today Menu header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Today Menu') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.menus.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Today Menu List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.menus.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>{{ __('Type') }}</label>
                                            <select name="food_type_id" class="form-control select2" id="food_type_id"
                                                style="width: 100%;" required="">
                                                <option value="">{{ __('Select Food Type') }}</option>
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
                                                id="food_category_id" style="width: 100%;" required=""
                                                onchange="getFoodItems()">
                                                <option value="">{{ __('Select Food Category') }}</option>
                                                @foreach ($categories as $key => $category)
                                                    <option value="{{ $category->id }}" @if (old('food_category_id') == $category->id) {{ 'selected' }}  @endif>
                                                        {{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <span id="item"></span>

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
        function getFoodItems() {
            let type = $('#food_type_id').val();
            let category = $('#food_category_id').val();

            if (type == '') {
                alert('Please Select A Food Type');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }
                });

                $.ajax({
                    url: "{{ route('fetch.food.items') }}",
                    method: 'POST',
                    data: {
                        'type': type,
                        'category': category,
                        'html': 'Yes',
                    },

                    success: function(data2) {
                        var data = JSON.parse(data2);
                        $('#item').html(data);

                    },

                    error: function(error) {

                        console.log(error);
                    }


                });
            }

        }
    </script>
@endsection
