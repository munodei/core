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
                    Neighbourhood List
                    <a href="{{route('neighbourhood.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Add Neighbourhood
                    </a>
                    <br>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>

                                <th>City</th>
                                <th>Neighbourhood</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($neighbourhood as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="State"><strong>{{ $data->city->city ?? '' }}</strong></td>
                                    <td data-label="City"><strong>{{ $data->neighbourhood ?? '' }}</strong></td>
                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data->status ==0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('neighbourhood.edit',$data->id)}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $neighbourhood->render() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

@endsection
