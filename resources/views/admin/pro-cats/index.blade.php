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
                    Product Categories
                    <a href="{{route('product-category.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Add Product Category
                    </a>
                    <br>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>ID</th>
                                <th>Parent</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($pro_cat as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="ID"><strong>{{ $data->id ?? '' }}</strong></td>
                                    <td data-label="Parent"><strong>{{ $data->pro_category_name ?? '' }}</strong></td>
                                    <td data-label="Category"><strong></strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data->status ==0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('product-category.edit',$data->id)}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>
                                    </td>
                                </tr>
                                @foreach($data->sub_categories as $w=>$data1)
                                <tr>
                                    <td data-label="SL"></td>
                                    <td data-label="ID"><strong>{{ $data1->id ?? '' }}</strong></td>
                                    <td data-label="Parent"><strong>{{++$w}}</strong></td>
                                    <td data-label="Category"><strong>{{ $data1->pro_category_name ?? '' }}</strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data1->status ==0 ? 'warning' : 'success' }}">{{ $data1->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('product-category.edit',$data1->id)}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $pro_cat->render() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

@endsection
