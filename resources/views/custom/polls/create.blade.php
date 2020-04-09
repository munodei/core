@extends('custom.admin')

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
                    <a href="{{route('contacts.index')}}" class="btn btn-primary btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Your Polls
                    </a>
                </h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('polls.store')}}" name="editForm" enctype="multipart/form-data">
                        @csrf


                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5>Poll Name</h5>
                                <div class="input-group">
                                    <input type="text" name="name" value="{{old('name')}}" class="form-control form-control-lg" placeholder="First Name" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-bar-chart"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif
                            </div>

                        </div>
                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5> Poll Question</h5>
                                <div class="input-group">
                                    <input type="text" value="{{old('question')}}" class="form-control form-control-lg" placeholder="Last Name" name="question">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-question"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('question'))
                                    <div class="error">{{ $errors->first('question') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                              <div class="form-group  col-md-12">
                                <h5>Time Limited </h5>


                                    <div class="col-md-3">
                                      <p>Days</p>
                                    <select name="days" class="form-control">
                                    <option value="0">0</option>
                                    @for($i=1;$i<=365;$i++)
                                      <option value="{{ $i }}">{{ $i }} Days</option>
                                    @endfor
                                    </select>
                                    </div>

                                    <div class="col-md-3"><p>Hours</p>
                                    <select name="hours" class="form-control">
                                    <option value="0">0</option>
                                    @for($i=1;$i<=24;$i++)
                                      <option value="{{ $i }}">{{ $i }} Hours</option>
                                    @endfor
                                    </select>
                                    </div>

                                    <div class="col-md-3"><p>Minutes</p>
                                    <select name="minutes" class="form-control">
                                    <option value="0">0</option>
                                    @for($i=1;$i<=60;$i++)
                                      <option value="{{ $i }}">{{ $i }} Minutes</option>
                                    @endfor
                                    </select>
                                    </div>


                            </div>

                            <div class="form-group col-md-12">
                                <h5> Public Poll </h5>
                                <div class="input-group">

                                    <select name="public" class="form-control form-control-lg">
                                      <option value="0">Public</option>
                                      <option value="1">Private</option>

                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('public'))
                                    <div class="error">{{ $errors->first('public') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5> User Restricted </h5>
                                        <div class="input-group">
                                          <select name="user_restriction" class="form-control form-control-lg">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                          </select>
                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-workphone"></i></span></div>
                                        </div>
                                        @if ($errors->has('user_restriction'))
                                            <div class="error">{{ $errors->first('user_restriction') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> IP Restriction </h5>
                                        <div class="input-group">
                                          <select name="ip_restriction" class="form-control form-control-lg">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                          </select>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('ip_restriction'))
                                            <div class="error">{{ $errors->first('ip_restriction') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> Cookie Restricted </h5>
                                        <div class="input-group">
                                          <select name="cookie_restriction" class="form-control form-control-lg">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                          </select>
                                            <div class="input-group-append"><span class="input-group-text">This option will allow a user to vote once per poll and mark the user by placing a cookie on their computer. A user will be able to vote multiple times if they clear their own cookies. This option should be used if IP Restriction is too strict.</span></div>
                                        </div>
                                        @if ($errors->has('cookie_restriction'))
                                            <div class="error">{{ $errors->first('cookie_restriction') }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <h4>Show Results</h4>
                                <div class="input-group">
                                  <select name="show_results" class="form-control form-control-lg">
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                  </select>
                                    <div class="input-group-append"><span class="input-group-text">When a user has voted, show the poll results after.</span></div>
                                </div>
                                @if ($errors->has('cookie_restriction'))
                                    <div class="error">{{ $errors->first('cookie_restriction') }}</div>
                                @endif
                            </div>


                        </div>

                        <div class="row">
                          <div class="form-group col-md-12">
                            <h4>Poll Vote Type</h4>
                              <div class="input-group">

                                        <select name="vote_type" class="form-control">
                                      	      <option value="0">Radio (single)</option>
                                      	      <option value="1">Checkbox (multiple)</option>
                                	      </select>
                                          <div class="input-group-append"><span class="input-group-text">You can allow a user to vote on more than one answer by selecting the checkbox option.</span></div>
                            </div>
                            @if ($errors->has('vote_type'))
                                <div class="error">{{ $errors->first('vote_type') }}</div>
                            @endif
                        </div>

                        </div>




                        <div class="row">
                          <div class="form-group col-md-12 ">
                            <h4>Poll Theme</h4>
                              <div class="input-group">

                                        <select name="themeid" class="form-control">
                                              <option value="0">Default Theme</option>
                                              <option value="1">Blue Theme</option>
                                        </select>
                                          <div class="input-group-append"><span class="input-group-text">Select a theme to alter the appearance of your poll.</span></div>
                            </div>
                            @if ($errors->has('themeid'))
                                <div class="error">{{ $errors->first('themeid') }}</div>
                            @endif
                        </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Poll</button>
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
