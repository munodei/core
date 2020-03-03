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
                <h3 class="tile-title "> Add Country
                    <a href="{{route('country.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All country
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('country.store')}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Country Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" placeholder="USA" value="{{old('name')}}"
                                           name="name">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('name'))
                                    <div class="error">{{ $errors->first('name') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Continent:</h5>
                                <select name="continent_id" id="continent_id" class="form-control form-control-lg">
                                    <option value="">Select Continent</option>
                                    @foreach($continent as $data)
                                        <option value="{{$data->id}}">{{$data->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('continent_id'))
                                    <div class="error">{{ $errors->first('continent_id') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Currency Code:</h5>
                                <input type="text" class="form-control form-control-lg" placeholder="USD" value="{{old('code')}}"
                                       name="code">
                                @if ($errors->has('code'))
                                    <div class="error">{{ $errors->first('code') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Rate:</h5>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><strong> 1 = {{$basic->currency}}</strong></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" value="{{old('rate')}}"
                                           name="rate">
                                </div>
                                @if ($errors->has('rate'))
                                    <div class="error">{{ $errors->first('rate') }}</div>
                                @endif
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Charge:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{old('charge')}}"
                                           name="charge">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><strong>%</strong></span>
                                    </div>
                                </div>
                                @if ($errors->has('charge'))
                                    <div class="error">{{ $errors->first('charge') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Status:</h5>
                                <input data-toggle="toggle" data-size="large" data-onstyle="success"
                                       data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5>Flag</h5>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;"
                                         data-trigger="fileinput">
                                        <img style="width: 200px"
                                             src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Flag Image"
                                             alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail"
                                         style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i
                                                            class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i
                                                            class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase"
                                           data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Country</button>
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
