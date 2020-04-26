@extends('admin')

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
                <div class="tile-title ">
                    Product List
                    <a href="{{route('product.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Add Product
                    </a>
                    <br>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>

                                <th>Category</th>
                                <th>Product</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($product as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="Category"><strong>{{ $data->pro_cat->pro_category_name ?? '' }}</strong></td>
                                    <td data-label="Product"><strong>{{ $data->product_name ?? '' }}</strong></td>
                                    <td data-label="Image"><img src={{ $data->photo ?? '' }} width="50px" height="50px"/></td>
                                    <td data-label="Price"><strong>{{ $data->product_price ?? '' }}</strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data->status ==0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('product.edit',$data->id)}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>
                                        <a href="{{route('product.assign.outlet',['id'=>$data->id])}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> ASSIGN
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $product->render() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

@endsection
