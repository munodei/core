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
                                <th scope="col">Send Amount</th>
                                <th scope="col">Recipient</th>
                                <th scope="col">Receive Amount</th>
                                <th scope="col"> Send Date</th>
                                <th scope="col"> Received Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Invoice</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sendMoney as $k=>$data)
                                <tr>
                                    <td data-label="Transaction Number">{{isset($data->trx ) ? $data->trx  : '-'}}</td>

                                    <td data-label="Send Amount"><strong>{!! isset($data->from_currency_amo) ? $data->from_currency_amo : '-' !!} {!! $data->fromCurrency->code !!}</strong></td>
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
                                    <td data-label="Status">
                                        <a href="{{route('send.invoice',$data->trx)}}" class="btn btn-info btn-sm"><i class="fa fa-file-text" aria-hidden="true"></i>
                                         </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                        </table>

                        {{$sendMoney->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>






@stop
