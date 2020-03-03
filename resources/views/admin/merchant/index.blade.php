@extends('admin')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Manage Merchant</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">{{$page_title}}</h3>
                    <a class="btn btn-primary icon-btn" href="{{route('merchant.create')}}"><i class="fa fa-plus"></i>Add Merchant	</a>
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th scope="col">Username </th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col"> Balance</th>
                                <th scope="col">Joined</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($merchant) >0)
                                @foreach($merchant as $k=>$data)
                                    <tr>
                                        <td data-label="Username">
                                            <a href="{{route('user.single', $data->id)}}">
                                                {{$data->username}}
                                            </a>
                                        </td>
                                        <td data-label="Email">{{$data->email}}</td>
                                        <td data-label="Phone">{{$data->phone}}</td>
                                        <td data-label="Amount"><strong>{{ number_format($data->balance, $basic->decimal)}}   {{ $basic->currency }}</strong></td>

                                        <td data-label="Time">
                                            {!! date(' d M, Y h:i A', strtotime($data->created_at)) !!} </td>
                                        <td data-label="Action">
                                            <a href="{{route('user.single', $data->id)}}" class="btn btn-outline-primary btn-sm ">
                                                <i class="fa fa-eye"></i> Info
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

                        {{$merchant->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
