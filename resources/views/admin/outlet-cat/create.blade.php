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
                <h3 class="tile-title "> Add Outlet Category
                    <a href="{{route('outlet-cat.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Outlet Categories
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('outlet-cat.store')}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5> Outlet Category:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{old('outlet_cat')}}"
                                           name="outlet_cat">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('outlet_cat'))
                                    <div class="error">{{ $errors->first('outlet_cat') }}</div>
                                @endif

                            </div>

                        </div>

                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5>Outlet Category Description:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outlet_cat_des') }}" name="outlet_cat_des">
                                </div>
                                @if ($errors->has('outlet_cat_des'))
                                    <div class="error">{{ $errors->first('outlet_cat_des') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Status:</h5>
                                <input data-toggle="toggle" data-size="large" data-onstyle="success" value="1" checked
                                       data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Outlet Category</button>
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
