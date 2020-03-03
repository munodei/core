@extends('admin')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{$user->fname . ' '.$user->lname}}  @if($user->merchant ==1) <span
                    class="badge badge-success"> Merchant</span> @endif</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-3">
            <div class="tile">
                <h4 class="tile-title">
                    <i class="fa fa-user"></i> {{$user->username}} Profile </h4>
                <div class="tile-body">
                    @if( file_exists($user->image))
                        <img src=" {{url('assets/user/images/'.$user->image)}} " class="img-responsive propic"
                             alt="Profile Pic">
                    @else

                        <img src=" {{url('assets/user/images/user-default.png')}} " class="img-responsive propic"
                             alt="Profile Pic">
                    @endif

                    <hr>
                    <h5 class="bold">User Name : {{ $user->username }} </h5>
                    <h5 class="bold">Name : {{ $user->fname }} {{ $user->lname }}</h5>
                    <h5 class="bold">Balance
                        : {{number_format($user->balance, $basic->decimal)}} {{$basic->currency}}</h5>


                    <hr>
                    <p>
                        <strong>Last Login : {{ Carbon\Carbon::parse($user->login_time)->diffForHumans() }}</strong>
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


        <div class="col-md-9">
            @php
                $trans = \App\Deposit::whereUser_id($user->id)->count();
                $transAmount = \App\Deposit::whereUser_id($user->id)->sum('amount');

                $deposit = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->count();
                $depositAmount = \App\Deposit::whereUser_id($user->id)->whereStatus(1)->sum('amount');


            @endphp
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <a href="{{route('user.trans',$user->id)}}" class="text-decoration">
                        <div class="widget-small primary coloured-icon"><i class="icon fa fa-th fa-3x"></i>
                            <div class="info">
                                <h6>TRANSACTION</h6>
                                <p><b>History</b></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-6">
                    <a href="{{route('user.deposit',$user->id)}}" class="text-decoration">
                        <div class="widget-small info coloured-icon"><i class="icon fa fa-download fa-3x"></i>
                            <div class="info">
                                <h6>DEPOSITS</h6>
                                <p><b>{{$depositAmount}} {{$basic->currency}}</b></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <h3 class="tile-title"><i class="fa fa-cogs"></i> Operations</h3>
                        <div class="tile-body">


                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{route('user.balance',$user->id)}}"
                                       class="btn btn-lg btn-block btn-primary"><i class="fa fa-money"></i>
                                        Add/Substract Balance</a><br>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('user.login.history',$user->id)}}"
                                       class="btn btn-lg btn-block btn-primary"><i class="fa fa-sign-out"></i> Login
                                        History</a>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{route('user.email',$user->id)}}"
                                       class="btn btn-lg btn-block btn-primary"> <i
                                            class="fa fa-envelope"></i> Send Email</a>
                                    <br>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-lg btn-block"
                                            data-toggle="modal" data-target="#changepass"><i class="fa fa-lock"></i>
                                        Change Password
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">

                    <div class="tile">
                        <h3 class="tile-title">
                            <i class="fa fa-user"></i> Update Profile
                            @if($user->merchant ==1) <span
                                class="badge badge-success pull-right"> Merchant</span> @endif
                        </h3>


                        <form id="form" method="POST" action="{{route('user.status', $user->id)}}"
                              enctype="multipart/form-data" name="editForm">
                            {{ csrf_field() }}
                            {{method_field('put')}}


                            <div class="tile-body">

                                <div class="row">
                                    <div class="form-group col-md-6 {{ $errors->has('fname') ? ' has-error' : '' }}">
                                        <label> <strong>First Name</strong></label>
                                        <input type="text" name="fname" class="form-control form-control-lg"
                                               value="{{$user->fname}}">
                                        @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 {{ $errors->has('lname') ? ' has-error' : '' }}">
                                        <label> <strong>Last Name</strong></label>
                                        <input type="text" name="lname" class="form-control form-control-lg"
                                               value="{{$user->lname}}">
                                        @if ($errors->has('lname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lname') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-6 {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control form-control-lg"
                                               value="{{$user->email}}">
                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6 {{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label><strong>Phone</strong></label>
                                        <input type="text" name="phone" class="form-control form-control-lg"
                                               value="{{$user->phone}}">
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label> <strong>City</strong></label>
                                        <input type="text" name="city" class="form-control form-control-lg"
                                               value="{{$user->city}}">
                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label><strong>Zip Code</strong></label>
                                        <input type="text" name="zip_code" class="form-control form-control-lg"
                                               value="{{$user->zip_code}}">
                                        @if ($errors->has('zip_code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('zip_code') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label><strong>Address</strong></label>
                                        <input type="text" name="address" class="form-control form-control-lg"
                                               value="{{$user->address}}">
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group col-md-12 ">
                                        <label><strong>Country</strong></label>

                                        <select name="country_id" class="form-control form-control-lg" >
                                            <option value="">Select Country</option>
                                            @foreach($country as $data)
                                            <option value="{{$data->id}}" @if($data->id == $user->country_id) selected @endif>{{$data->name}}</option>
                                                @endforeach

                                        </select>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label><strong>User Status</strong></label>
                                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                                               data-size="large"
                                               data-offstyle="danger" data-width="100%" data-on="Active"
                                               data-off="Block" type="checkbox" value="1"
                                               name="status" {{ $user->status == "1" ? 'checked' : '' }}>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label><strong>Email Verification</strong></label>
                                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                                               data-size="large"
                                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                                               type="checkbox" value="1"
                                               name="email_verify" {{ $user->email_verify == "1" ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><strong>Phone Verification</strong></label>
                                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                                               data-size="large"
                                               data-offstyle="danger" data-width="100%" data-on="Yes" data-off="No"
                                               type="checkbox" value="1"
                                               name="phone_verify" {{ $user->phone_verify == "1" ? 'checked' : '' }}>
                                    </div>
                                </div>

                                @if($user->merchant == 1)
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label><strong>Merchant Account</strong></label>
                                        <input class="form-control" data-toggle="toggle" data-onstyle="success"
                                               data-size="large"
                                               data-offstyle="danger" data-width="100%" data-on="Active"
                                               data-off="Blocked"
                                               type="checkbox" value="1"
                                               name="merchant" {{ $user->merchant == "1" ? 'checked' : '' }}>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label> <strong>Merchant Identity</strong></label>
                                        <input type="text" name="merchant_identity" class="form-control form-control-lg"
                                               value="{{$user->merchant_identity}}">
                                        @if ($errors->has('merchant_identity'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('merchant_identity') }}</strong>
                                            </span>
                                        @endif
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label><strong>Merchant Info</strong></label>
                                        <textarea class="form-control form-control-lg" name="merchant_info" id="merchant_info" rows="10">{{$user->merchant_info}}</textarea>
                                    </div>
                                </div>

                                    @else
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label><strong>Make Merchant</strong></label>
                                            <input class="form-control" data-toggle="toggle" data-onstyle="success"
                                                   data-size="large"
                                                   data-offstyle="danger" data-width="100%" data-on="Yes"
                                                   data-off="No"
                                                   type="checkbox" value="1"
                                                   name="merchant" {{ $user->merchant == "1" ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    @endif


                            </div>

                            <div class="tile-footer">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Update</button>
                                    </div>
                                </div>
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


