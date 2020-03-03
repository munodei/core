@extends('admin')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}
                    <a href="{{route('merchant.index')}}" class="btn btn-primary btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Merchant
                    </a>
                </h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('merchant.store')}}" name="editForm" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> First Name</h5>
                                <div class="input-group">
                                    <input type="text" name="fname" value="{{old('fname')}}" class="form-control form-control-lg" placeholder="First Name" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('fname'))
                                    <div class="error">{{ $errors->first('fname') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5> Last Name</h5>
                                <div class="input-group">
                                    <input type="text" value="{{old('lname')}}" class="form-control form-control-lg" placeholder="Last Name" name="lname">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('lname'))
                                    <div class="error">{{ $errors->first('lname') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Username </h5>
                                <div class="input-group">
                                    <input type="text" name="username" value="{{old('username')}}" class="form-control form-control-lg" placeholder=" Username" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('username'))
                                    <div class="error">{{ $errors->first('username') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5> Email </h5>
                                <div class="input-group">
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-lg" placeholder=" Email Address" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5> Phone </h5>
                                        <div class="input-group">
                                            <input type="text" name="phone" value="{{old('phone')}}" class="form-control form-control-lg" placeholder="Contact Number">
                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                        </div>
                                        @if ($errors->has('phone'))
                                            <div class="error">{{ $errors->first('phone') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> City </h5>
                                        <div class="input-group">
                                            <input type="text" name="city" value="{{old('city')}}" class="form-control form-control-lg" placeholder=" City" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> Zip Code </h5>
                                        <div class="input-group">
                                            <input type="text" name="zip_code" value="{{old('zip_code')}}" class="form-control form-control-lg" placeholder="Zip Code">
                                            <div class="input-group-append"><span class="input-group-text">Zip Code</span></div>
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-6">
                                <h4>Address</h4>
                                <textarea name="address" placeholder="Write Address" rows="8" class="form-control form-control-lg"> {{old('address')}}</textarea>
                            </div>


                        </div>



                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Image</h4>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Image" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Others Info</h4>
                                <textarea name="merchant_info" id="area1"  rows="10" class="form-control form-control-lg">{{old('merchant_info')}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Merchant</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
    <script src="{{ asset('assets/admin/js/nicEdit-latest.js') }}"></script>

    <script>
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
@stop
