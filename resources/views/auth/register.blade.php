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
            @if($basic->registration == 0)
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2 class="title"> {{$page_title}} Has been Deactivated By Admin</h2>
                        </div>
                    </div>
                </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title">
                            <h2 class="title">Create An Account</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="login-form-wrapper"><!-- login form wrapper -->
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-element margin-bottom-20">
                                            <input type="text" name="fname" value="{{ old('fname') }}"
                                                   class="input-field" placeholder="First Name">
                                            @if ($errors->has('fname'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-element margin-bottom-20">
                                            <input type="text" name="lname" value="{{ old('lname') }}"
                                                   class="input-field" placeholder="Last Name">
                                            @if ($errors->has('lname'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('lname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-element margin-bottom-20">
                                            <input type="text" name="username" value="{{ old('username') }}"
                                                   class="input-field" placeholder="Username">
                                            @if ($errors->has('username'))
                                                <span class="error">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-element margin-bottom-20">
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                   class="input-field" placeholder="Contact Number">
                                            @if ($errors->has('phone'))
                                                <span class="error">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-element margin-bottom-20">
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                   class="input-field" placeholder="Email Address">
                                            @if ($errors->has('email'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-element margin-bottom-20 has-icon">

                                            <select name="country"  class="input-field ">
                                                <option value="">Select Country</option>
                                                @foreach($country as $data)
                                                    <option value="{{$data->id}}" {{(old('country') == $data->id?'selected':'')}} >  {{$data->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class=" @if($errors->has('country')) top-up10 @else  the-icon @endif"><i class="fas fa-arrow-down"></i></div>


                                            @if ($errors->has('country'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('country') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-element margin-bottom-20">
                                            <input type="password" name="password" class="input-field"
                                                   placeholder="Password">
                                            @if ($errors->has('password'))
                                                <span class="error ">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6">

                                        <div class="form-element margin-bottom-20">
                                            <input type="password" name="password_confirmation" class="input-field"
                                                   placeholder="Confirm Password">
                                        </div>
                                    </div>


                                    <div class="col-lg-12">
                                        <div class="checkbox-area margin-bottom-20">
                                            <div class="checkbox-element">
                                                <div class="checkbox-wrapper">
                                                    <label class="checkbox-inner">I agree with the terms & conditions
                                                        <input type="checkbox" required>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="btn-wrapper">
                                            <div class="left-content">
                                                <input type="submit" class="submit-btn" value="Regsiter">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="from-footer">
                                    <span class="ftext">Already have an account?  <a
                                            href="{{ route('login') }}">Sign In</a></span>
                                </div>

                            </form>
                        </div><!-- //. login form wrapper -->
                    </div>
                </div>

            @endif
        </div>
    </section>
    <!-- login page content area end -->

@endsection
