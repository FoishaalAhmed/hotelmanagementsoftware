

@extends('backend.layouts.app')
@section('title', 'Contact Update')
@section('head')
    <link rel="stylesheet" href="{{asset('public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            {{__('Dashboard')}}
            <small>Version 2.0</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin.contact')}}"><i class="fa fa-file"></i> {{__('Contact')}}</a></li>
            <li class="active">{{__('Update')}}</li>
        </ol>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (contact header) -->
                <div class="box box-danger box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Contact')}}</h3>
                        <div class="box-tools pull-right">
                            
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.error')
                        <form action="{{route('admin.contact.update',[$contact->id])}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('E-mail Address')}}</label>
                                        <input name="email" placeholder="{{__('E-mail Address')}}" class="form-control" type="email" value="{{ $contact->email }}" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Phone')}}</label>
                                        <input name="phone" placeholder="{{__('Phone')}}" class="form-control" type="text" value="{{ $contact->phone }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Mobile')}}</label>
                                        <input name="mobile" placeholder="{{__('Mobile')}}" class="form-control" type="text" value="{{ $contact->mobile }}" autocomplete="off" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Facebook')}}</label>
                                        <input name="facebook" placeholder="{{__('Facebook')}}" class="form-control" type="text" value="{{ $contact->fb }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Twitter')}}</label>
                                        <input name="twitter" placeholder="{{__('Twitter')}}" class="form-control" type="text" value="{{ $contact->twitter }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Youtube')}}</label>
                                        <input name="youtube" placeholder="{{__('Youtube')}}" class="form-control" type="text" value="{{ $contact->youtube }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Instagram')}}</label>
                                        <input name="instagram" placeholder="{{__('Instagram')}}" class="form-control" type="text" value="{{ $contact->instagram }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label>{{__('Address')}}</label>
                                        <textarea name="address" id="editor1" rows="3" class="form-control" placeholder="{{__('Address')}}" style="resize: vertical;">{{$contact->address}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">{{__('Cancel')}}</button>
                                    <button type="submit" class="btn btn-sm bg-green">{{__('Update')}}</button>
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

    <script src="{{asset('public/backend/bower_components/ckeditor/ckeditor.js')}}"></script>

    <!-- Bootstrap WYSIHTML5 -->

    <script src="{{asset('public/backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

    <script>

    $(function () {
        CKEDITOR.replace('editor1')
        //bootstrap WYSIHTML5 - text editor
        $('.textarea').wysihtml5()
    });
    </script>

@endsection

