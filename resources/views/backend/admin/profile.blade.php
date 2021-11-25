@extends('backend.layouts.app')
@section('title', 'Hotel Update')
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
                    <!-- Content Header (Hotel header) -->
                    <div class="box box-primary box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('Hotel Update') }}</h3>
                            <div class="box-tools pull-right">
                                
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <br>
                            @include('includes.error')
                            <form action="{{ route('admin.profile.update', [$hotel->id]) }}"
                                method="POST" class="form-horizontal" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-9">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Name') }}</label>
                                                <input name="name" placeholder="{{ __('Name') }}" class="form-control"
                                                    required="" type="text" value="{{ $hotel->name }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('E-mail Address') }}</label>
                                                <input type="email" class="form-control"
                                                    placeholder="{{ __('E-mail Address') }}" name="email"
                                                    value="{{ $hotel->email }}" required="" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Phone') }}</label>
                                                <input name="phone" placeholder="{{ __('Phone') }}" class="form-control"
                                                    type="text" value="{{ $hotel->phone }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Mobile') }}</label>
                                                <input name="mobile" placeholder="{{ __('Mobile') }}"
                                                    class="form-control" type="text" value="{{ $hotel->mobile }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Fax') }}</label>
                                                <input name="fax" placeholder="{{ __('Fax') }}" class="form-control"
                                                    type="text" value="{{ $hotel->fax }}" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Website') }}</label>
                                                <input name="website" placeholder="{{ __('Website') }}"
                                                    class="form-control" type="text" value="{{ $hotel->website }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Floor') }}</label>
                                                <input name="floor" placeholder="{{ __('Floor') }}" class="form-control"
                                                    type="text" value="{{ $hotel->floor }}" autocomplete="off"
                                                    required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Star') }}</label>
                                                <input name="star" placeholder="{{ __('Star') }}" class="form-control"
                                                    type="text" value="{{ $hotel->star }}" autocomplete="off"
                                                    required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Trade License') }}</label>
                                                <input name="trade_license" placeholder="{{ __('Trade License') }}"
                                                    class="form-control" type="text" value="{{ $hotel->trade_license }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Tin Number') }}</label>
                                                <input name="tin_number" placeholder="{{ __('Tin Number') }}"
                                                    class="form-control" type="text" value="{{ $hotel->tin_number }}"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Road House') }}</label>
                                                <input name="road_house" placeholder="{{ __('Road House') }}"
                                                    class="form-control" type="text" value="{{ $hotel->road_house }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Zipcode') }}</label>
                                                <input name="zip_code" placeholder="{{ __('Zipcode') }}"
                                                    class="form-control" type="text" value="{{ $hotel->zip_code }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Division') }}</label>
                                                <select name="division_id" id="division_id" class="form-control select2"
                                                    style="width: 100%" required onchange="getAllDistrictsByDivision()">
                                                    <option value="">{{ __('Select Division') }}</option>
                                                    @foreach ($divisions as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $hotel->division_id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('District') }}</label>
                                                <select name="district_id" id="district_id" class="form-control select2"
                                                    style="width: 100%" required onchange="getAllUpozilasByDistrict()">
                                                    <option value="">{{ __('Select Division First') }}</option>
                                                    @foreach ($districts as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $hotel->district_id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Upozila') }}</label>
                                                <select name="upozila_id" id="upozila_id" class="form-control select2"
                                                    style="width: 100%" required>
                                                    <option value="">{{ __('Select District First') }}</option>
                                                    @foreach ($upozilas as $item)
                                                        <option value="{{ $item->id }}" @if ($item->id == $hotel->upozila_id) {{ 'selected' }} @endif>
                                                            {{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Facebook') }}</label>
                                                <input name="facebook" placeholder="{{ __('Facebook') }}"
                                                    class="form-control" type="text" value="{{ $hotel->facebook }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Instagram') }}</label>
                                                <input name="instagram" placeholder="{{ __('Instagram') }}"
                                                    class="form-control" type="text" value="{{ $hotel->instagram }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Twitter') }}</label>
                                                <input name="twitter" placeholder="{{ __('Twitter') }}"
                                                    class="form-control" type="text" value="{{ $hotel->twitter }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Linkedin') }}</label>
                                                <input name="linkedin" placeholder="{{ __('Linkedin') }}"
                                                    class="form-control" type="text" value="{{ $hotel->linkedin }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Total Room') }}</label>
                                                <input name="room" placeholder="{{ __('Total Room') }}"
                                                    class="form-control" type="text" value="{{ $hotel->room }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Min Rate') }}</label>
                                                <input name="min_rate" placeholder="{{ __('Min Rate') }}"
                                                    class="form-control" type="text" value="{{ $hotel->min_rate }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('Max Rate') }}</label>
                                                <input name="max_rate" placeholder="{{ __('Max Rate') }}"
                                                    class="form-control" type="text" value="{{ $hotel->max_rate }}"
                                                    autocomplete="off" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <label>{{ __('About') }}</label>
                                                <textarea name="about" rows="3" class="form-control"
                                                    placeholder="{{ __('About') }}"
                                                    style="resize: vertical;">{{ $hotel->about }}</textarea>
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
                                                        style="margin-bottom: 10px; display: @if ($i>
                                                    0) {{ 'none' }} @endif">

                                                    <input type="hidden" name="video[]" id="video_link-{{ $i }}"
                                                        style="display: @if ($i> 0) {{ 'none' }} @endif">
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">

                                            <h3 class="box-title"> {{ __('Hotel Logo') }} </h3>

                                        </div>
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                src="{{ asset($hotel->logo) }}" alt="Hotel Logo" id="hotel-logo">
                                            <input type="file" name="logo" onchange="readPicture(this)">
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <div class="box box-primary box-solid">
                                        <div class="box-header with-border">

                                            <h3 class="box-title"> {{ __('More Photos') }} </h3>

                                        </div>
                                        <div class="box-body box-profile">
                                            <img class="profile-user-img img-responsive img-circle"
                                                src="//placehold.it/200x200" alt="Hotel Logo">
                                            <input type="file" name="photo[]" multiple>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
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
            @if ($hotelPhotos->isNotEmpty())

                <div class="row">
                    <div class="col-md-12">
                        <!-- Content Header (Hotel header) -->
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('Hotel Photo') }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <?php foreach ($hotelPhotos as $key => $value) { ?>
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
            @if ($hotelVideos->isNotEmpty())
                <div class="row">
                    <div class="col-md-12">
                        <!-- Content Header (Hotel header) -->
                        <div class="box box-success box-solid">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('Hotel Video') }}</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php foreach ($hotelVideos as $key => $value) { ?>
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
        function readPicture(input) {

            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#hotel-logo')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        function getAllDistrictsByDivision() {

            var division_id = $('#division_id').val();
            var division = $('#division_id option:selected').text();

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: '{{ route('find.district', app()->getLocale()) }}',
                method: 'POST',
                data: {
                    'division_id': division_id,
                },

                success: function(data2) {

                    var data = JSON.parse(data2);

                    $('#district_id').find('option').remove().end().append("<option value=''>Select " +
                        division + "\'s Districts</option>");

                    $.each(data, function(i, item) {

                        $("#district_id").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }));
                    });

                },

                error: function(error) {

                    console.log(error);
                }


            });
        }

        function getAllUpozilasByDistrict() {

            var district_id = $('#district_id').val();
            var district = $('#district_id option:selected').text();

            $.ajaxSetup({

                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }

            });

            $.ajax({

                url: '{{ route('find.upozilla', app()->getLocale()) }}',
                method: 'POST',
                data: {
                    'district_id': district_id,
                },

                success: function(data2) {

                    var data = JSON.parse(data2);

                    $('#upozila_id').find('option').remove().end().append("<option value=''>Select " +
                        district + "\'s Upozilla</option>");

                    $.each(data, function(i, item) {

                        $("#upozila_id").append($('<option>', {
                            value: this.id,
                            text: this.name,
                        }));
                    });

                },

                error: function(error) {

                    console.log(error);
                }


            });
        }

        function makerowvisible() {

            var nextrownumber = $("#showrowid").val();
            $("#video-" + Number(nextrownumber)).show();
            $("#video_link-" + Number(nextrownumber)).show();
            $("#showrowid").val(Number(nextrownumber) + 1);
        }

        function youtube_parser(id) {

            let url = $('#video-' + id).val();

            var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = url.match(regExp);

            if ((match && match[7].length == 11)) $("#video_link-" + id).val(match[7]);
        }

        function deleteThisImage(id) {

            if (confirm("Are you sure ?")) {

                var url = '{{ route('delete.hotel.photo', app()->getLocale()) }}';

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

                var url = '{{ route('delete.hotel.video', app()->getLocale()) }}';

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
