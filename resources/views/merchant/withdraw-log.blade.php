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
                                <th scope="col">Transaction Number</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Receive Amount</th>

                                <th scope="col">Date Send</th>
                                <th scope="col">Date Received</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($invests) >0)
                                @foreach($invests as $k=>$data)
                                    <tr>
                                        <td data-label="Transaction Number">{{isset($data->trx ) ? $data->trx  : '-'}}</td>
                                        <td data-label="Recipient">{{isset($data->name) ? $data->name : '-'}} </td>
                                        <td data-label="Receive Amount"><strong>{!! isset($data->to_currency_amo) ? $data->to_currency_amo : '-' !!} {!! $data->toCurrency->code !!}</strong></td>
                                        <td data-label="Date Send">
                                            {!! date('d  M, Y  h:i A', strtotime($data->created_at)) !!}
                                        </td>
                                        <td data-label="Date Received">
                                            @if($data->received_at != null)
                                                {!!  date('d  M, Y  h:i A', strtotime($data->received_at)) !!}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td data-label="Status">
                                            @if($data->status == 2)
                                                <span  class="badge  badge-pill  badge-success "> completed </span>
                                            @elseif($data->status == 1)
                                                <span class="badge  badge-pill  badge-danger ">Pending </span>
                                            @endif
                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6">No Data FOund !!</td>
                                </tr>

                            @endif
                            <tbody>
                        </table>

                        {{$invests->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
