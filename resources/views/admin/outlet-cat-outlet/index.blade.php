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
                    Outlet List
                    <a href="{{route('outlet-cat-outlet.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Add Outlet
                    </a>
                    <br>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Outlet</th>
                                <th>Suburb</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Options</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($outlet as $k=>$data1)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="Outlet"><strong>{{ $data1->outlet ?? '' }}</strong></td>
                                    <td data-label="Suburb"><strong>{{ $data1->suburb->suburb ?? '' }}</strong></td>
                                    <td data-label="Category"><strong></strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data1->status ==0 ? 'warning' : 'success' }}">{{ $data1->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                      <a href="{{route('outlet-cat-outlet-create',$data1->id)}}" class="btn btn-outline-primary btn-sm ">
                                          <i class="fa fa-edit"></i> Add
                                      </a>
                                    </td>
                                </tr>
                                @foreach($data1->outlet_cats as $w=>$data)
                                <tr>
                                    <td data-label="SL">{{++$w}}</td>
                                    <td data-label="Outlet"><strong></strong></td>
                                    <td data-label="Suburb"><strong></strong></td>
                                    <td data-label="Category"><strong>{{ $data->outlet_cat_des ?? '' }}</strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data->status ==0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('outlet-cat-outlet-delete',['outlet_id'=>$data1->id,'outlet_cat_id'=>$data->id])}}" class="btn btn-outline-danger btn-sm ">
                                            <i class="fa fa-trash"></i> DELETE
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $outlet->render() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

@endsection
