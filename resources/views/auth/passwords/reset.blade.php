@extends('merchant-1')

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
                <div class="col-lg-8">
                    <div class="section-title">
                        <h2 class="title">Change Password</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="login-form-wrapper">


                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('success') }}
                            </div>
                        @endif
                        @if(Session::has('danger'))
                            <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ Session::get('danger') }}
                            </div>
                        @endif

                            <form method="POST" action="{{ route('user.password.request') }}" >
                                {{csrf_field()}}
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-element form-group margin-bottom-20">
                                        <input type="email" name="email" value="{{$email}}" class="input-field form-control" placeholder="Email Address" readonly>
                                        @if ($errors->has('email'))
                                            <span class="error ">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-element form-group margin-bottom-20">
                                        <input type="password" name="password"  class="input-field form-control" placeholder="New Password">
                                        @if ($errors->has('password'))
                                            <span class="error">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element form-group margin-bottom-20">
                                        <input type="password" name="password_confirmation"  class="input-field form-control" placeholder="Re-enter Password">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="btn-wrapper">
                                        <input type="submit" class="submit-btn btn-block" value=" Reset Password">
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div><!-- //. login form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- login page content area end -->


@endsection
