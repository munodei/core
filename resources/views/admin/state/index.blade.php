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
                    State List
                    <a href="{{route('state.create')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Add State
                    </a>
                    <br>
                </div>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($country as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="Country">
                                        <img style="width: 35px; height: 25px; margin-right: 10px" src="{{ asset('assets/images/country') }}/{{ $data->country->image }}" alt="$data->name">
                                        {{$data->country->name }}
                                    </td>
                                    <td data-label="State"><strong>{{ isset($data->state) ? $data->state : ' ' }}</strong></td>
                                    <td data-label="Description">{{$data->state_description}}</td>

                                    <td data-label="Status">
                                        <span class="badge  badge-pill  badge-{{ $data->status ==0 ? 'warning' : 'success' }}">{{ $data->status == 0 ? 'Deactive' : 'Active' }}</span>
                                    </td>
                                    <td data-label="Action">
                                        <a href="{{route('state.edit',$data->id)}}" class="btn btn-outline-primary btn-sm ">
                                            <i class="fa fa-edit"></i> EDIT
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {!! $country->render() !!}

                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')

@endsection
