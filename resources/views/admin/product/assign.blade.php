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
                    Add Product Outlet Assignment
                    <a href="{{route('product.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Products
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{ route('product.assign.outlet1') }}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5>Products:</h5>
                                <select name="product_id" id="product_id" class="form-control form-control-lg">
                                    <option value="">Select Product</option>
                                    @foreach($product as $data)
                                        <option value="{{ $data->id }}" @if($data->id == $product_id || old('product_id') == $data->id) selected @endif>{{$data->product_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('product_id'))
                                    <div class="error">{{ $errors->first('product_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Outlets:</h5>
                                <select name="outlet_id" id="outlet_id" class="form-control form-control-lg">
                                    <option value="">Select Outlet</option>
                                    @foreach($outlet as $data)
                                        <option value="{{ $data->id }}" @if( old('outlet_id') == $data->id) selected @endif>{{$data->outlet}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('outlet_id'))
                                    <div class="error">{{ $errors->first('outlet_id') }}</div>
                                @endif
                            </div>

                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Assign Product to Outlet</button>
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
