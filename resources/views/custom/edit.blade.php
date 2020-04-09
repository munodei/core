@extends('frame')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
<div class="content container-fluid">
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('shopping-items') }}">Shopping Items</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('add-shopping-item') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Shopping Items</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{ route('update-shopping-item',['id'=>$shopping_item->id]) }}" name="editForm" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="form-group col-md-6">
                                <h5> Shopping Item Name</h5>
                                <div class="input-group">
                                    <input type="text" name="shopping_item_name" value="{{ old('shopping_item_name') ?? $shopping_item->shopping_item_name ?? '' }}" class="form-control form-control-lg" placeholder="e.g. Tastic Rice 10kg" >
                                </div>
                                @if ($errors->has('shopping_item_name'))
                                    <div class="error">{{ $errors->first('shopping_item_name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Describe Your Shopping Item Name</h5>
                                <div class="input-group">
                                    <textarea rows="2" name="shopping_item_description" id="shopping_item_description" placeholder="e.g. Product Info : 10kg of long grain parboiled rice Tastic Rice" class="form-control form-control-lg">{{ old('shopping_item_description') ?? $shopping_item->shopping_item_description ?? '' }}</textarea>
                                </div>
                                @if ($errors->has('shopping_item_description'))
                                    <div class="error">{{ $errors->first('shopping_item_description') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5>Supplier Outlets</h5>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg"  name="shopping_item_outlets" placeholder="e.g.Shoprite,PnP" name="shopping_item_outlets" value="{{ old('shopping_item_outlets') ?? $shopping_item->shopping_item_outlets ?? '' }}" required>

                                </div>
                                @if ($errors->has('shopping_item_outlets'))
                                    <div class="error">{{ $errors->first('shopping_item_outlets') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5> Quantity </h5>
                                <div class="input-group">
                                  <input type="text" class="form-control form-control-lg"  name="shopping_item_quantity" placeholder="e.g. 1" name="shopping_item_quantity" value="{{ old('shopping_item_quantity') ?? $shopping_item->shopping_item_quantity ?? '' }}" required>

                                </div>
                                @if ($errors->has('shopping_item_quantity'))
                                    <div class="error">{{ $errors->first('shopping_item_quantity') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                                    <div class="form-group col-md-6">
                                        <h5>Brand</h5>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg" placeholder="e.g. Tastic" name="shopping_item_brand" value="{{ old('shopping_item_brand') ?? $shopping_item->shopping_item_brand ?? '' }}" required>
                                        </div>
                                        @if ($errors->has('shopping_item_brand'))
                                            <div class="error">{{ $errors->first('shopping_item_brand') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h5> Price </h5>
                                        <div class="input-group">
                                            <input type="text" class="form-control form-control-lg"  name="shopping_item_price" placeholder="e.g. R114.99" id="shopping_item_price" value="{{ old('shopping_item_price') ?? $shopping_item->shopping_item_price ?? '' }}" required>

                                        </div>
                                        @if ($errors->has('shopping_item_price'))
                                            <div class="error">{{ $errors->first('shopping_item_price') }}</div>
                                        @endif
                                    </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Image</h4>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px">
                                      <a href="profile.html" class="avatar">
                                        <img alt="{{ $shopping_item->shopping_item_name }}" width="40px" height="40px" src="{{ url('/') }}/core/{{ $shopping_item->photo }}">
                                      </a>
                                    </div>
                                    <br>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>

                                                    <input type="file" accept="image/*" name="upload"  id="upload" accept="image/*" >
                                                </span>

                                    </div>
                                </div>
                                @if ($errors->has('upload'))
                                    <div class="error">{{ $errors->first('upload') }}</div>
                                @endif

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <button class="btn btn-primary">Update Shopping Item</button>
                                <a href="#" class="btn btn-success">Share Shopping Item</a>
                                <a href="#" class="btn btn-danger">Delete Shopping Item</a>
                            </div>
                        </div>
                    </form>
                </div>
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
