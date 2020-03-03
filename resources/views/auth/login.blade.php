@extends('layout')

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
                        <h2 class="title">Login Your Account</h2>
                    </div>
                </div>
            </div>


            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="login-form-wrapper"><!-- login form wrapper -->


                        @if (session('logout'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('logout') }}
                            </div>
                        @endif
                        @if (session('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('danger'))
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                {{ session('danger') }}
                            </div>
                        @endif


                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-element has-icon margin-bottom-20">
                                <input type="text" class="input-field" name="username" placeholder="Enter Username"  value="{{ old('username') }}">
                                <div class="the-icon">
                                    <i class="far fa-user"></i>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="error ">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                @endif
                            </div>
                            <div class="form-element has-icon margin-bottom-20">
                                <input type="password" class="input-field" name="password" placeholder="Enter Password">
                                <div class="the-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <div class="checkbox-area margin-bottom-20">
                                <div class="checkbox-element">
                                    <div class="checkbox-wrapper">
                                        <label class="checkbox-inner">Keep me logged in
                                            <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-wrapper margin-bottom-20">
                                <div class="left-content">
                                    <input type="submit" class="submit-btn" value="Login">
                                </div>
                                <div class="right-content">
                                    <a href="{{ route('password.request') }}" class="anchor">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="from-footer">
                                <span class="ftext">Not a member?  <a href="{{ route('register') }}">Create an Account</a></span>
                            </div>
                        </form>
                    </div><!-- //. login form wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- login page content area end -->

@endsection
