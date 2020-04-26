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
                    Edit Suburb
                    <a href="{{route('suburb.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Suburbs
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('suburb.update',$suburb)}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        {{method_field('put')}}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Suburb Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="suburb" value="{{$suburb->suburb}}"
                                           name="suburb">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('suburb'))
                                    <div class="error">{{ $errors->first('suburb') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>City:</h5>
                                <select name="neighbourhood_id" id="neighbourhood_id" class="form-control form-control-lg">
                                    <option value="">Select Neighbourhood</option>
                                    @foreach($neighbourhood as $data)
                                        <option value="{{ $data->id }}" @if($data->id == $suburb->neighbourhood_id) selected @endif>{{$data->neighbourhood}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('neighbourhood_id'))
                                    <div class="error">{{ $errors->first('neighbourhood_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5> Suburb Description:</h5>
                                <textarea type="text" class="form-control form-control-lg" value="" rows="3" name="suburb_description">{{ $suburb->suburb_description }}</textarea>
                                @if ($errors->has('suburb_description'))
                                    <div class="error">{{ $errors->first('suburb_description') }}</div>
                                @endif

                            </div>


                                <div class="form-group col-md-6">
                                    <h5>Status:</h5>
                                    <input data-toggle="toggle" data-size="large" data-onstyle="success" @if($suburb->status == 1) checked @endif
                                           data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                                </div>


                        </div>



                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update Suburb</button>
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
