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
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><strong>Transaction Number</strong> : {{isset($data->trx ) ? $data->trx  : '-'}}</h4>
                <div class="small text-muted"><strong>Recipient</strong> : {{isset($data->name) ? $data->name : '-'}}</div>
                <div class="small text-muted"><strong>Receive Amount</strong> : {!! isset($data->to_currency_amo) ? $data->to_currency_amo : '-' !!} {!! $data->toCurrency->code !!}</div>
                <div class="small text-muted"><strong>Date Send</strong> : {!! date('d  M, Y  h:i A', strtotime($data->created_at)) !!}</div>
                <div class="small text-muted"><strong>Date Received</strong> : @if($data->received_at != null) {!!  date('d  M, Y  h:i A', strtotime($data->received_at)) !!} @else  - @endif</div>
                <div class="small text-muted"><strong>Status</strong> :   @if($data->status == 2)  <span  class="badge  badge-pill  badge-success "> completed </span> @elseif($data->status == 1) <span class="badge  badge-pill  badge-danger ">Pending </span> @endif</div>

              </div>
            </div>
        @endforeach
        @else
          <div class="col-md-12 col-sm-12 col-12">
            <center> No Data FOund !!</center>
          </div>

        @endif

    {{$invests->links()}}

    </div>

@stop
