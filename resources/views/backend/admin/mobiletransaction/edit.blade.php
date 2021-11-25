@extends('backend.layouts.app')
@section('title', 'Mobile Transaction Update')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Dashboard
            <small>Version 2.0</small>
        </h1>
    </section>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Content Header (bank header) -->
                <div class="box box-teal box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mobile Transaction Update</h3>
                        <div class="box-tools pull-right">
                            <a href="{{route('admin.mobile-transactions.index')}}" class="btn btn-sm bg-green"><i class="fa fa-list"></i> Mobile Transaction List</a>
                        </div>      
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <br>
                        @include('includes.error')
                        <form action="{{route('admin.mobile-transactions.update',$mobileTransaction->id)}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Mobile Bank</label>
                                        <div class="col-sm-10">
                                            <select name="mobile_bank_id" class="form-control select2" required="" id="">
                                                <option value="">Select Mobile Bank</option>
                                                @foreach ($banks as $item)

                                                    <option value="{{$item->id}}" @if ($item->id == $mobileTransaction->mobile_bank_id) {{'selected'}}
                                                        
                                                    @endif>{{$item->name}}</option>

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Date</label>
                                        <div class="col-sm-10">
                                            <input name="date" placeholder="Date" class="form-control" required="" type="text" value="{{ $mobileTransaction->date }}" autocomplete="off" id="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Type</label>
                                        <div class="col-sm-10">
                                            <select name="type" class="form-control" id="">
                                                <option value="Cash In" @if ($mobileTransaction->type == 'Cash In')
                                                    {{'selected'}}
                                                @endif>Cash In</option>
                                                <option value="Cash Out" @if ($mobileTransaction->type == 'Cash Out')
                                                    {{'selected'}}
                                                @endif>Cash Out</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-2">Amount</label>
                                        <div class="col-sm-10">
                                            <input name="amount" placeholder="Amount" class="form-control" required="" type="number" value="{{ $mobileTransaction->amount }}" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <label class="control-label col-md-1">Note</label>
                                        <div class="col-sm-11">
                                            <textarea name="note" placeholder="Bank Note" class="form-control" id="" rows="5">{{ $mobileTransaction->note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <center>
                                    <button type="reset" class="btn btn-sm bg-red">Cancel</button>
                                    <button type="submit" class="btn btn-sm bg-teal">Update</button>
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

@section('footerSection')
    <script>
        $(function () {
            $('#date').datepicker({
                autoclose:   true,
                changeYear:  true,
                changeMonth: true,
                dateFormat:  "dd-mm-yy",
                yearRange:   "-10:+10"
            });
        });
    </script>
@endsection

