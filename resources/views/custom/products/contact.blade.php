@extends('merchant-1')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{$user->firstname . ' '.$user->lastname}}  @if($user->merchant ==1) <span
                    class="badge badge-success"> Merchant</span> @endif</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-3 col-sm-3">
            <div class="tile">
                <h4 class="tile-title">
                    <i class="fa fa-user"></i> {{ $user->firstname }} {{ $user->lastname }} Profile </h4>
                <div class="tile-body">
                    @if($user->photo!='')
                        <img src=" {{ url($user->photo) }} " class="img-responsive propic"
                             alt="{{ $user->firstname }} {{ $user->lastname }}" width="200px" height="200px">
                    @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " class="img-responsive propic"
                             alt="{{ $user->firstname }} {{ $user->lastname }}" width="200px" height="200px">
                    @endif

                    <hr>

                    <h5 class="bold">Name : {{ $user->firstname }} {{ $user->lastname }}</h5>

                    <hr>
                    <p>
                        <strong>Your Last Login : {{ Carbon\Carbon::parse($user->login_time)->diffForHumans() }}</strong>
                        <br>
                    </p>
                    <hr>
                    @if($last_login != null)

                        <strong>Last Login From</strong> <br> {{ $last_login->user_ip }} -  {{ $last_login->location }}
                        <br> Using {{ $last_login->details }} <br>

                    @endif
                </div>
            </div>

        </div>


        <div class="col-md-9 col-sm-9">
            @php
                $trans = \App\Deposit::whereUser_id($user->id)->count();
                $transAmount = \App\Deposit::whereUser_id($user->id)->sum('amount');

                $deposit = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->count();
                $depositAmount = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');


            @endphp

            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <h3 class="tile-title">
                            <i class="fa fa-user"></i> Update Profile
                            @if($user->merchant ==1) <span
                                class="badge badge-success pull-right"> Merchant</span> @endif
                        </h3>


                        <form id="form" method="POST" action="{{route('update-contact',[$user])}}}"
                              enctype="multipart/form-data" name="editForm" disabled>
                            {{ csrf_field() }}



                            <div class="tile-body">

                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        <label> <strong>First Name</strong></label>
                                        <input type="text" name="firstname" class="form-control form-control-lg"
                                               value="{{$user->firstname}}" disabled>
                                        @if ($errors->has('firstname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('firstname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        <label> <strong>Last Name</strong></label>
                                        <input type="text" name="lastname" class="form-control form-control-lg"
                                               value="{{$user->lastname}}" disabled>
                                        @if ($errors->has('lastname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lastname') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control form-control-lg"
                                               value="{{$user->email}}" disabled>
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('mobilephone') ? ' has-error' : '' }}">
                                        <label><strong>Mobile phone</strong></label>
                                        <input type="text" name="mobilephone" class="form-control form-control-lg"
                                               value="{{$user->mobilephone}}" disabled>
                                        @if ($errors->has('mobilephone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('mobilephone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label> <strong>City</strong></label>
                                        <input type="text" name="city" class="form-control form-control-lg"
                                               value="{{$user->city}}" disabled>
                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><strong>Zip Code</strong></label>
                                        <input type="text" name="zip_code" class="form-control form-control-lg"
                                               value="{{$user->zip_code}}" disabled>
                                        @if ($errors->has('zip_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Address</strong></label>
                                        <input type="text" name="address" class="form-control form-control-lg"
                                               value="{{$user->address}}" disabled>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group col-md-12 ">
                                        <label><strong>Country</strong></label>

                                        <select name="country_id" class="form-control form-control-lg" disabled>
                                            <option value="">Select Country</option>
                                            @foreach($country as $data)
                                            <option value="{{$data->id}}" @if($data->id == $user->country_id) selected @endif>{{$data->name}}</option>
                                                @endforeach

                                        </select>
                                    </div>

                                </div>


                            </div>

                            <div class="tile-footer">
                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <!-- Modal for Edit button -->
    <div id="changepass" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><strong><i class="fa fa-lock"></i> Change
                            Password</strong></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="{{route('user.passchange', $user->id)}}"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('put')}}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label"><strong>Password</strong></label>
                            <input id="password" type="password" class="form-control form-control-lg" name="password"
                                   placeholder="Passowrd"
                                   required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label"><strong>Confirm
                                    Password</strong></label>
                            <input id="password-confirm" type="password" class="form-control form-control-lg"
                                   placeholder="Confirm Passowrd"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">
                                Change Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.forms['editForm'].elements['country'].value = "{{$user->country}}"
    </script>

@endsection
@section('script')
    <script src="{{asset('assets/admin/js/nicEdit-latest.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        new nicEditor().panelInstance('merchant_info');
    </script>
@stop
