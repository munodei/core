@extends('admin')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Manage Outlet Categories</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">{{$page_title}}</h3>
                    <a class="btn btn-primary icon-btn" href="{{ route('outlet-cat.create') }}"><i class="fa fa-plus"></i>Add Outlet Cat	</a>
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th scope="col">Slug </th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($outlet_cat) >0)
                                @foreach($outlet_cat as $k=>$data)
                                    <tr>
                                        <td data-label="Slug">
                                            <a href="{{route('user.single', $data->id)}}">
                                                {{$data->outlet_cat}}
                                            </a>
                                        </td>
                                        <td data-label="Category">{{$data->outlet_cat_des}}</td>
                                        <td data-label="Action">
                                            <a href="{{route('outlet-cat.edit', $data->id)}}" class="btn btn-outline-primary btn-sm ">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> You don't have any transaction history !!</td>
                                </tr>

                            @endif
                            <tbody>
                        </table>

                        {{$outlet_cat->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
