@extends('merchant')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-key"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Password Settings</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">

            <div class="tile">
                <h3 class="tile-title">
                    <i class="fa fa-user"></i> Edit Profile
                </h3>


                <form id="form" method="POST" action="" enctype="multipart/form-data" name="editForm">
                    @csrf

                    <div class="tile-body">

                        <div class="row invoice-info">

                                <div class="form-group col-md-6">
                                    <h4>Username: <span class="padding-left-10 red"> {{Auth::user()->username}}</span></h4>
                                    <h4>Merchant Account: <span class="padding-left-10 red"> {{Auth::user()->merchant_identity}}</span></h4>
                                    <h4>Country: <span class="padding-left-10 red"> {{Auth::user()->country->name}}</span></h4>
                                    <h4>Email: <span class="padding-left-10 red"> {{Auth::user()->email}}</span></h4>
                                    <h4>Contact No: <span class="padding-left-10 red"> {{Auth::user()->phone}}</span></h4>


                                </div>
                            <div class="form-group col-md-6">
                                <label> <h4>Profile</h4></label>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                @if($user->image == null)
                                                    <div class="fileinput-new thumbnail" style="width: 215px; height: 215px;" data-trigger="fileinput">
                                                        <img style="width: 215px" src="{{ asset('assets/images/user/user-default.png') }}/" alt="...">
                                                    </div>
                                                @else
                                                    <div class="fileinput-new thumbnail" style="width: 215px; height: 215px;" data-trigger="fileinput">
                                                        <img style="width: 215px" src="{{ asset('assets/images/user/') }}/{{$user->image}}" alt="...">
                                                    </div>
                                                @endif

                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 215px; max-height: 215px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label> <strong>First Name</strong></label>
                                <input type="text" name="fname" class="form-control form-control-lg" value="{{$user->fname}}">
                                @if ($errors->has('fname'))
                                    <span class="error"><strong>{{ $errors->first('fname') }}</strong></span>
                                @endif
                            </div>
                            <div class="form-group col-md-6 ">
                                <label> <strong>Last Name</strong></label>
                                <input type="text" name="lname" class="form-control form-control-lg" value="{{$user->lname}}">
                                @if ($errors->has('lname'))
                                    <span class="error"><strong>{{ $errors->first('lname') }}</strong></span>
                                @endif
                            </div>


                        </div>


                        <div class="row">

                            <div class="form-group col-md-6">
                                <label><strong>Address</strong></label>
                                <input type="text" name="address" class="form-control form-control-lg" value="{{$user->address}}">
                                @if ($errors->has('address'))
                                    <span class="error"><strong>{{ $errors->first('address') }}</strong></span>
                                @endif

                            </div>
                            <div class="form-group col-md-3">
                                <label><strong>Zip Code</strong></label>
                                <input type="text" name="zip_code" class="form-control form-control-lg" value="{{$user->zip_code}}">
                                @if ($errors->has('zip_code'))
                                    <span class="error"><strong>{{ $errors->first('zip_code') }}</strong></span>
                                @endif
                            </div>


                            <div class="form-group col-md-3">
                                <label> <strong>City</strong></label>
                                <input type="text" name="city" class="form-control form-control-lg" value="{{$user->city}}">
                                @if ($errors->has('city'))
                                    <span class="error"><strong>{{ $errors->first('city') }}</strong></span>
                                @endif

                            </div>



                        </div>

                    </div>

                    <div class="tile-footer">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary btn-block">Update Profile</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.forms['editForm'].elements['country'].value = "{{$user->country_id}}"
    </script>
@stop
