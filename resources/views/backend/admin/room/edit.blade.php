@extends('backend.layouts.app')
@section('title', 'Room Update')
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
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Room Update') }}</h3>
                            <div class="box-tools pull-right">
                                <a href="{{ route('admin.rooms.index') }}" class="btn btn-sm bg-red"><i
                                        class="fa fa-list"></i> {{ __('Room List') }}</a>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.rooms.update', [$room->id]) }}" method="POST"
                                class="form-horizontal" enctype="multipart/form-data" id="room-store">
                                @csrf
                                @method('PUT')
                                <div class="col-md-9">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Room Number') }}</label>
                                                <input name="number" placeholder="{{ __('Room Number') }}"
                                                    class="form-control" required="" type="text" autocomplete="off"
                                                    value="{{ $room->number }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Type') }}</label>
                                                <select name="type" class="form-control select2" id="type" required="" style="width: 100%">
                                                        @foreach ($types as $item)
                                                            <option value="{{ $item->type }}" @if ($room->type == $item->type) {{ 'selected' }} @endif>{{ $item->type }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Facing') }}</label>
                                                <input name="facing" placeholder="{{ __('Facing') }}"
                                                    class="form-control" required="" type="text" autocomplete="off"
                                                    value="{{ $room->facing }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Situate') }}</label>
                                                <input name="situate" placeholder="{{ __('Situate') }}"
                                                    class="form-control" required="" type="text" autocomplete="off"
                                                    value="{{ $room->situate }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Bed') }}</label>
                                                <input name="beds" placeholder="{{ __('Bed') }}" class="form-control"
                                                    required="" type="text" autocomplete="off" value="{{ $room->beds }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Rent') }}</label>
                                                <input name="rate" placeholder="{{ __('Rent') }}" class="form-control"
                                                    required="" type="number" autocomplete="off"
                                                    value="{{ $room->rate }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Area') }} <span
                                                        style="color: red">{{ __('(In Square FT)') }}</span> </label>
                                                <input type="text" class="form-control" placeholder="{{ __('Area') }}" name="area" required="" value="{{ $room->area }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Bath') }} </label>
                                                <input type="text" class="form-control" placeholder="{{ __('Bath') }}" name="bath" required="" value="{{ $room->bath }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>{{ __('Description') }} </label>
                                                    <textarea name="description" id="description" rows="5" class="form-control"
                                                        placeholder="{{ __('Description') }}" autocomplete="off">{{ $room->description }}</textarea>
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

                                                    <input type="hidden" name="video[]" id="video_link-{{ $i }}"
                                                        style="display: @if ($i > 0) {{ 'none' }} @endif">
                                                @endfor
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <center>
                                            <button type="reset" class="btn btn-sm bg-red">{{ __('Cancel') }}</button>
                                            <button type="submit" class="btn btn-sm bg-green">{{ __('Update') }}</button>
                                        </center>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"> {{ __('Display Photo') }} </h3>
                                        </div>

                                        <div class="box-body box-profile">
                                            <img class="profile-room-img img-responsive img-circle"
                                                src="{{ asset($room->photo) }}" alt="room profile picture"
                                                id="dispaly-photo" style="width: 200px; height:200px">
                                            <input type="file" name="display_photo" onchange="readPictureDisplay(this)">
                                        </div>
                                    </div>
                                    <div class="box box-success box-solid">
                                        <div class="box-header with-border">
                                            <h3 class="box-title"> {{ __('Room Photo') }} </h3>
                                        </div>

                                        <div class="box-body box-profile">
                                            <img class="profile-room-img img-responsive img-circle"
                                                src="//placehold.it/200x200" alt="room profile picture" id="room-photo-1">
                                            <input type="file" name="photo[]" multiple="">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
            @if ($roomPhotos->isNotEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <!-- Content Header (Room header) -->
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('Room Photo') }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <?php foreach ($roomPhotos as $key => $value) { ?>
                                <div class="col-md-3">
                                    <div class="form-group rzimg-wrap" id="to_be_hide_<?= $value->id ?>"
                                        style="margin-bottom: 5px;">
                                        <div class="col-md-12">
                                            <label for=""></label>
                                            <span class="rzclose" onclick="deleteThisImage(<?= $value->id ?>);"
                                                style="margin-top: 20px;">x</span>
                                            <img src="{{ asset($value->photo) }}" alt="" style="width: 100%"
                                                height="180px;">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($roomVideos->isNotEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <!-- Content Header (Room header) -->
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('Room Video') }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php foreach ($roomVideos as $key => $value) { ?>
                                <div class="col-md-3">
                                    <div class="form-group rzimg-wrap" id="video_to_be_hide_<?= $value->id ?>"
                                        style="margin-bottom: 5px;">
                                        <div class="col-md-12">
                                            <label for=""></label>
                                            <span class="rzclose" onclick="deleteThisVideo(<?= $value->id ?>);"
                                                style="margin-top: 20px;">x</span>
                                            <iframe width="240" height="160"
                                                src="https://www.youtube.com/embed/{{ $value->video }}" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen></iframe>

                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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

        function deleteThisImage(id) {

            if (confirm("Are you sure ?")) {

                var url = '{{ route('delete.room.photo') }}';

                $.ajaxSetup({

                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }

                });

                $.ajax({

                    url: url,
                    method: 'POST',
                    data: {
                        'id': id,
                    },

                    success: function(data) {

                        $("#to_be_hide_" + id).fadeOut(2000);

                    },

                    error: function(error) {

                        console.log(error);
                    }


                });

            }
        }

        function deleteThisVideo(id) {

            if (confirm("Are you sure ?")) {

                var url = '{{ route('delete.room.video') }}';

                $.ajaxSetup({

                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    }

                });

                $.ajax({

                    url: url,
                    method: 'POST',
                    data: {
                        'id': id,
                    },

                    success: function(data) {

                        $("#video_to_be_hide_" + id).fadeOut(2000);

                    },

                    error: function(error) {

                        console.log(error);
                    }


                });

            }
        }
    </script>
@endsection
