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
                    <a href="{{route('outlet-cat-outlet.index')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Outlet Relationships
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('outlet-cat-outlet.store')}}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}


                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5> Outlet Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" value="{{ old('outlet') ?? $outlet->outlet ?? '' }}"
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
                        <input type="hidden" name="outlet_id" id="outlet_id" value="{{ $outlet->id }}"


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Relationship</button>
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
