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
                <h3 class="tile-title ">
                    Edit Neighbourhood
                    <a href="{{route('neighbourhood.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Neighbourhoods
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('neighbourhood.update',$neighbourhood)}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        {{method_field('put')}}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Neighbourhood Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="neighbourhood" value="{{$neighbourhood->neighbourhood}}"
                                           name="name">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('neighbourhood'))
                                    <div class="error">{{ $errors->first('neighbourhood') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>City:</h5>
                                <select name="city_id" id="city_id" class="form-control form-control-lg">
                                    <option value="">Select City</option>
                                    @foreach($city as $data)
                                        <option value="{{ $data->id }}" @if($data->id == $neighbourhood->city_id) selected @endif>{{$data->city}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                    <div class="error">{{ $errors->first('city_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5> Neighbourhood Description:</h5>
                                <textarea type="text" class="form-control form-control-lg" value="" rows="3" name="neighbourhood_description">{{ $neighbourhood->neighbourhood_description }}</textarea>
                                @if ($errors->has('neighbourhood_description'))
                                    <div class="error">{{ $errors->first('neighbourhood_description') }}</div>
                                @endif

                            </div>


                                <div class="form-group col-md-6">
                                    <h5>Status:</h5>
                                    <input data-toggle="toggle" data-size="large" data-onstyle="success" @if($neighbourhood->status == 1) checked @endif
                                           data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                                </div>


                        </div>



                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update Neighbourhood</button>
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
