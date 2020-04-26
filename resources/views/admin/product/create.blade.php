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
                    Add Product
                    <a href="{{route('product.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-eye"></i> All Products
                    </a>
                </h3><br>

                <div class="tile-body">
                    <form role="form" method="POST" action="{{ route('product.store') }}" name="editForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5> Product Name:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="product_name" value="{{ old('product_name') }}">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('product_name'))
                                    <div class="error">{{ $errors->first('product_name') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-12">
                                <h5> Product Name:</h5>
                                <div class="input-group">
                                    <textarea class="form-control form-control-lg" name="product_description">{{ old('product_description')}}</textarea>
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('product_description'))
                                    <div class="error">{{ $errors->first('product_description') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-6">
                                <h5>Product Categories:</h5>
                                <select name="pro_cat_id" id="pro_cat_id" class="form-control form-control-lg">
                                    <option value="">Select Product Categories</option>
                                    @foreach($pro_cat as $data)
                                        <option value="{{ $data->id }}" @if( old('pro_cat_id') == $data->id) selected @endif>{{$data->pro_category_name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state_id'))
                                    <div class="error">{{ $errors->first('state_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <h5> Product Quantity:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="product_quantity" value="{{ old('product_quantity') }}">
                                    <div class="input-group-append"><span class="input-group-text">
                                            <i class="fa fa-globe"></i>
                                            </span>
                                    </div>
                                </div>
                                @if ($errors->has('product_quantity'))
                                    <div class="error">{{ $errors->first('product_quantity') }}</div>
                                @endif

                            </div>

                            <div class="form-group col-md-3">
                                <h5> Product Price:</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" name="product_price" value="{{ old('product_price')  }}">
                                </div>
                                @if ($errors->has('product_price'))
                                    <div class="error">{{ $errors->first('product_price') }}</div>
                                @endif

                            </div>
                        </div>

                        <div class="row">



                          <div class="form-group col-md-12">
                              <h5> Product Brand:</h5>
                              <div class="input-group">
                                  <input type="text" class="form-control form-control-lg" name="product_brand" value="{{ old('product_brand') }}">
                              </div>
                              @if ($errors->has('product_brand'))
                                  <div class="error">{{ $errors->first('product_brand') }}</div>
                              @endif

                          </div>

                          <div class="form-group col-md-12">
                              <h5> Product Url:</h5>
                              <div class="input-group">
                                  <textarea class="form-control form-control-lg" name="url">{{ old('url') }}</textarea>
                              </div>
                              @if ($errors->has('url'))
                                  <div class="error">{{ $errors->first('url') }}</div>
                              @endif

                          </div>

                          <div class="form-group col-md-12">
                              <h5> Product Photo Url:</h5>
                              <div class="input-group">
                                  <textarea class="form-control form-control-lg" name="photo">{{ old('photo') }}</textarea>
                              </div>
                              @if ($errors->has('photo'))
                                  <div class="error">{{ $errors->first('photo') }}</div>
                              @endif

                          </div>



                                <div class="form-group col-md-6">
                                    <h5>Status:</h5>
                                    <input data-toggle="toggle" data-size="large" data-onstyle="success" @if( old('status')==1) checked @endif
                                           data-offstyle="danger" data-width="100%" type="checkbox" name="status">

                                </div>


                        </div>



                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update Product</button>
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
