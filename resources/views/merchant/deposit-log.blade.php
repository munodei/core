@extends('merchant')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}</h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th scope="col">SL</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Details</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invests as $k=>$data)
                                <tr>
                                    <td data-label="SL">{{++$k}}</td>
                                    <td data-label="#Trx">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
                                    <td data-label="Details">{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}} </td>
                                    <td data-label="Amount">{!! isset($data->amount) ? $data->amount : 'N/A' !!} {!! $basic->currency !!}</td>
                                    <td data-label="Time">
                                        {!! date(' d M, Y h:i A', strtotime($data->created_at)) !!}
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                        </table>

                        {{$invests->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>






@stop
