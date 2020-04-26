@extends('admin')
@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-globe"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title "> Add Outlet
                    <a href="{{route('suburb.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Outlets
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('outlet.store')}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Outlet Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{old('outlet')}}"
                                           name="outlet">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('outlet'))
                                    <div class="error">{{ $errors->first('outlet') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Category:</h5>
                                <select name="outlet_cat_id" id="outlet_cat_id" class="form-control form-control-lg">
                                    <option value="">Select Outlet Category</option>
                                    @foreach($outlet_cat as $data)
                                        <option @if(old('outlet_cat_id')===$data->id) selected @endif value="{{$data->id}}">{{$data->outlet_cat_des}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('outlet_cat_id'))
                                    <div class="error">{{ $errors->first('outlet_cat_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5>Outlet Description:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outlet_desc') }}" name="outlet_desc">
                                </div>
                                @if ($errors->has('outlet_desc'))
                                    <div class="error">{{ $errors->first('outlet_desc') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Picture:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outlet_photo') }}" name="outlet_photo">
                                </div>
                                @if ($errors->has('outlet_photo'))
                                    <div class="error">{{ $errors->first('outlet_photo') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Longitude:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outtlet_long') }}" name="outtlet_long">
                                </div>
                                @if ($errors->has('outtlet_long'))
                                    <div class="error">{{ $errors->first('outtlet_long') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Latitude:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outlet_lat') }}" name="outlet_lat">
                                </div>
                                @if ($errors->has('outtlet_long'))
                                    <div class="error">{{ $errors->first('outlet_lat') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Country:</h5>
                                <select name="country_id" id="country_id" class="form-control form-control-lg">
                                    <option value="">Select Country</option>
                                    @foreach($country as $data)
                                        <option @if(old('country_id')===$data->id) selected @endif value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <div class="error">{{ $errors->first('country_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <h5>Outlet State:</h5>
                                <select name="state_id" id="state_id" class="form-control form-control-lg">
                                    <option value="">Select State</option>
                                    @foreach($state as $data)
                                        <option @if(old('state_id')===$data->id) selected @endif  value="{{$data->id}}">{{$data->state}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state_id'))
                                    <div class="error">{{ $errors->first('state_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <h5>Outlet City:</h5>
                                <select name="city_id" id="city_id" class="form-control form-control-lg">
                                    <option value="">Select City</option>
                                    @foreach($city as $data)
                                        <option @if(old('city_id')===$data->id) selected @endif value="{{$data->id}}">{{$data->city}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <div class="error">{{ $errors->first('city_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <h5>Outlet Neighbourhood:</h5>
                                <select name="neighbourhood_id" id="neighbourhood_id" class="form-control form-control-lg">
                                    <option value="">Select Neighbourhood</option>
                                    @foreach($neighbourhood as $data)
                                        <option @if( old('neighbourhood_id')=== $data->id) selected @endif value="{{$data->id}}">{{$data->neighbourhood}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('neighbourhood_id'))
                                    <div class="error">{{ $errors->first('neighbourhood_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Suburb:</h5>
                                <select name="suburb_id" id="suburb_id" class="form-control form-control-lg">
                                    <option value="">Select Suburb</option>
                                    @foreach($suburb as $data)
                                        <option @if(old('suburb_id')===$data->id) selected @endif value="{{$data->id}}">{{$data->suburb}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('suburb_id'))
                                    <div class="error">{{ $errors->first('suburb_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet Address:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('address') }}" name="address">
                                </div>
                                @if ($errors->has('address'))
                                    <div class="error">{{ $errors->first('address') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet phone:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('phone') }}" name="phone">
                                </div>
                                @if ($errors->has('phone'))
                                    <div class="error">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet email:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('email') }}" name="email">
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Outlet website:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('website') }}" name="website">
                                </div>
                                @if ($errors->has('website'))
                                    <div class="error">{{ $errors->first('website') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Outlet Open Time:</h5>
                                <div class="input-group">
                                    <textarea type="text" class="form-control form-control-lg"  name="open_time">{{ old('open_time') }}</textarea>
                                </div>
                                @if ($errors->has('open_time'))
                                    <div class="error">{{ $errors->first('open_time') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Status:</h5>
                                <input data-toggle="toggle" data-size="large" data-onstyle="success" checked
                                       data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Outlet</button>
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
        bkLib.onDomLoaded(function () {
            new nicEditor({fullPanel: true}).panelInstance('area1');
        });
    </script>
@stop
