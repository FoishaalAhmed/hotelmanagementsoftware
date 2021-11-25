@extends('backend.layouts.app')
@section('title', 'Today Menu Update')
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
                            <h3 class="box-title">{{ __('Today Menu Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('restaurant.menus.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Today Menu List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('restaurant.menus.update', $id) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;"></th>
                                                <th style="width: 25%;">{{ __('Type') }}</th>
                                                <th style="width: 25%;">{{ __('Category') }}</th>
                                                <th style="width: 45%;">{{ __('Item') }}</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($items as $key => $item)
                                                <tr>
                                                    <td><input type="checkbox" name="item_id[]"
                                                            value="{{ $item->item_id }}" autocomplete="off" checked></td>
                                                    <td>
                                                        <select name="food_type_id[]" class="form-control select2"
                                                            id="food_type_id{{ $key }}" style="width: 100%;"
                                                            required="">
                                                            <option value="">{{ __('Select Food Type') }}</option>
                                                            @foreach ($types as $key => $type)
                                                                <option value="{{ $type->id }}"
                                                                    @if ($item->food_type_id == $type->id) {{ 'selected' }}  @endif>
                                                                    {{ $type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="food_category_id[]" class="form-control select2"
                                                            id="food_category_id{{ $key }}" style="width: 100%;"
                                                            required="">
                                                            <option value="">{{ __('Select Food Category') }}</option>
                                                            @foreach ($categories as $key => $category)
                                                                <option value="{{ $category->id }}"
                                                                    @if ($item->food_category_id == $category->id) {{ 'selected' }}  @endif>
                                                                    {{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>{{ $item->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <center>
                                        <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
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
