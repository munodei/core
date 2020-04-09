@extends('merchant-1')
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


    <div class="row staff-grid-row">

    @if(count($invests) >0)
        @foreach($invests as $k=>$data)
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
              <div class="profile-widget">

                <div class="dropdown profile-action">
                  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                  </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><strong>Transaction ID</strong> : {{ isset($data->trx) ? $data->trx : 'N/A' }}</h4>
                <div class="small text-muted"><strong>Type</strong> : @if($data->type == '+') Deposit @elseif($data->type == '-') Withdrawal @endif</div>
                <div class="small text-muted"><strong>SL</strong> : {{++$k}}</div>
                <div class="small text-muted"><strong>Transaction ID</strong> : {{ isset($data->trx) ? $data->trx : 'N/A' }}</div>
                <div class="small text-muted"><strong>Details</strong> : {{  isset($data->title) ? $data->title : 'N/A' }}</div>
                <div class="small text-muted"><strong>Amount</strong> : {{isset($data->amount) ? $data->amount  : 'N/A'}}   {{ $basic->currency }}</div>
                <div class="small text-muted"><strong>Remaining Balance</strong> : {{isset($data->main_amo) ? $data->main_amo : ''}}  {{$basic->currency}}</div>
                <div class="small text-muted"><strong>Time</strong> : {!! date(' d M, Y h:i A', strtotime($data->created_at)) !!}</div>
              </div>
            </div>
        @endforeach
        @else
          <div class="col-md-12 col-sm-12 col-12">
            <center> You don't have any Transactions made  !!</center>
          </div>

        @endif

    {{$invests->links()}}

    </div>
@stop
