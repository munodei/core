@extends('user')

@section('css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">

@stop
@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg white-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <h1 class="title">{{$page_title}}</h1>
                    </div><!-- //.breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <!-- login page content area start -->
    <section class="login-page-area">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="login-form-wrapper">
                        @include('errors.alert')

                        {!! Form::open(['method'=>'post','role'=>'form','name' =>'editForm', 'files'=>true]) !!}
                        <div class="row">


                            <div class="col-md-4">
                                <div class="form-element margin-bottom-20">

                                    <div class="fileinput fileinput-new " data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                             data-trigger="fileinput">
                                            @if($user->image == null)
                                                <img style="width: 200px"
                                                     src="{{ asset('assets/images/user/user-default.png') }}" alt="...">
                                            @else
                                                <img style="width: 200px"
                                                     src="{{ asset('assets/images/user/') }}/{{ $user->image }}"
                                                     alt="...">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail"
                                             style="max-width: 200px; max-height: 150px"></div>

                                        <div class="img-input-div">
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                            class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                            class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                            <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                               data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                        </div>

                                        <code>Image size 800*800</code>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 offset-md-3">

                                <div class="row">


                                    <div class="col-lg-12">
                                        <div class="form-element margin-bottom-20">

                                            <label>First Name : {{$user->fname}}</label><br>
                                            <label>Last Name : {{$user->lname}}</label><br>
                                            <label>Email : {{$user->email}}</label><br>
                                            <label>Contact No : {{$user->phone}}</label><br>
                                            <label>Country : {{$user->country->name}}</label><br>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-element margin-bottom-20">

                                    <label>First Name</label>
                                    <input type="text" name="fname" class="input-field" value="{{$user->fname}}"
                                           placeholder="First Name">
                                    @if ($errors->has('fname'))
                                        <span class="error">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-element margin-bottom-20">
                                    <label>Last Name</label>
                                    <input type="text"
                                           class="input-field"
                                           name="lname" value="{{ $user->lname }}"
                                           placeholder="Last Name">
                                    @if ($errors->has('lname'))
                                        <span class="error">
                                                     <strong>{{ $errors->first('lname') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-element margin-bottom-20">
                                    <label>Address:</label>
                                    <input type="text" name="address" value="{{ $user->address }}" placeholder="Address" class="input-field">
                                    @if ($errors->has('address'))
                                        <span class=" error">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-element margin-bottom-20">
                                    <label>City:</label>
                                    <input type="text" name="city" value="{{ $user->city }}" placeholder="City" class="input-field">
                                    @if ($errors->has('city'))
                                        <span class="error">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-element margin-bottom-20">
                                    <label>Zip Code :</label>
                                    <input type="text" name="zip_code" value="{{ $user->zip_code }}" placeholder="Zip code" class="input-field">
                                    @if ($errors->has('zip_code'))
                                        <span class="error">
                                            <strong>{{ $errors->first('zip_code') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="btn-wrapper">
                                    <input type="submit" class="submit-btn btn-block" value=" Update Profile">
                                </div>
                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div><!-- //. login form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- login page content area end -->






    <script>
        document.forms['editForm'].elements['country'].value = "{{$user->country_id}}"
    </script>
@endsection
@section('script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>

@endsection
