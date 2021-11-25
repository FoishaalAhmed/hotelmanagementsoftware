@extends('backend.layouts.app')
@section('title', 'New Room')
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
                    <!-- Content Header (Room header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('New Room') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm bg-green"><i
                                        class="fa fa-list"></i> {{ __('Room List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.rooms.store') }}" method="POST" class="form-horizontal"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    <div class="col-md-9">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Number') }}</label>
                                                    <input name="number" placeholder="{{ __('Number') }}"
                                                        class="form-control" required="" type="text"
                                                        value="{{ old('number') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Type') }}</label>
                                                    <select name="type" class="form-control select2" id="type" required="" style="width: 100%">
                                                        @foreach ($types as $item)
                                                            <option value="{{ $item->type }}" @if (old('type') == $item->type) {{ 'selected' }} @endif>{{ $item->type }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Situate') }}</label>
                                                    <input name="situate" placeholder="{{ __('Situate') }}"
                                                        class="form-control" type="text" value="{{ old('situate') }}"
                                                        autocomplete="off" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Facing') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Facing') }}" name="facing"
                                                        value="{{ old('facing') }}" required="" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Bed') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Bed') }}" name="beds" required=""
                                                        value="{{ old('beds') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Rent') }}</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Rent') }}" name="rate" required=""
                                                        value="{{ old('rate') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Area') }} <span style="color: red">{{ __('(In Square FT)') }}</span> </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Area') }}" name="area" required=""
                                                        value="{{ old('area') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Bath') }} </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="{{ __('Bath') }}" name="bath" required=""
                                                        value="{{ old('bath') }}" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Description') }} </label>
                                                    <textarea name="description" id="description" rows="5" class="form-control"
                                                        placeholder="{{ __('Description') }}" autocomplete="off">{{ old('description') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Videos') }} <button class="btn btn-sm bg-teal"
                                                            type="button" onclick="makerowvisible()"><i
                                                                class="fa fa-plus"></i></button></label>
                                                    <input type="hidden" id="showrowid" value="1">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <input placeholder="{{ __('Videos') }}" class="form-control"
                                                            type="text" autocomplete="off"
                                                            onkeyup="youtube_parser({{ $i }});"
                                                            id="video-{{ $i }}"
                                                            style="margin-bottom: 10px; display: @if ($i > 0) {{ 'none' }} @endif">

                                                        <input type="hidden" name="video[]"
                                                            id="video_link-{{ $i }}"
                                                            style="display: @if ($i > 0) {{ 'none' }} @endif">
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"> {{ __('Display Photo') }} </h3>
                                            </div>

                                            <div class="box-body box-profile">
                                                <img class="profile-room-img img-responsive img-circle"
                                                    src="//placehold.it/200x200" alt="room profile picture"
                                                    id="dispaly-photo">
                                                <input type="file" name="display_photo" onchange="readPictureDisplay(this)">
                                            </div>
                                        </div>
                                        <div class="box box-success box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"> {{ __('Room Photo') }} </h3>
                                            </div>

                                            <div class="box-body box-profile">
                                                <img class="profile-room-img img-responsive img-circle"
                                                    src="//placehold.it/200x200" alt="room profile picture"
                                                    id="room-photo-1">
                                                <input type="file" name="photo[]" multiple="">
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
        function readPictureDisplay(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#dispaly-photo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function youtube_parser(id) {

            let url = $('#video-' + id).val();

            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);

            if ((match && match[7].length == 11)) $("#video_link-" + id).val(match[7]);
        }

        function makerowvisible() {
            var nextrownumber = $("#showrowid").val();
            $("#video-" + Number(nextrownumber)).show();
            $("#video_link-" + Number(nextrownumber)).show();
            $("#showrowid").val(Number(nextrownumber) + 1);
        }
    </script>
@endsection
