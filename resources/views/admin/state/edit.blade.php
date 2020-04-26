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
                    Edit State
                    <a href="{{route('state.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All States
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('state.update',$state)}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        {{method_field('put')}}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> State Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="Western Cape" name="state" value="{{$state->name}}"
                                           name="name">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('state'))
                                    <div class="error">{{ $errors->first('state') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Country:</h5>
                                <select name="country_id" id="country_id" class="form-control form-control-lg">
                                    <option value="">Select Country</option>
                                    @foreach($country as $data)
                                        <option value="{{ $data->id }}" @if($data->id == $state->country_id) selected @endif>{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country_id'))
                                    <div class="error">{{ $errors->first('country_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5> State Description:</h5>
                                <textarea type="text" class="form-control form-control-lg" placeholder="USD" value="" rows="3" name="state_description">{{ $state->state_description }}</textarea>
                                @if ($errors->has('state_description'))
                                    <div class="error">{{ $errors->first('state_description') }}</div>
                                @endif

                            </div>


                                <div class="form-group col-md-6">
                                    <h5>Status:</h5>
                                    <input data-toggle="toggle" data-size="large" data-onstyle="success" @if($state->status == 1) checked @endif
                                           data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                                </div>
                          

                        </div>



                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update State</button>
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
