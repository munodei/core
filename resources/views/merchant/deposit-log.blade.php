@extends('merchant-1')
@section('content')

    <!-- Page Header -->
  <div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Deposit Logs</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('deposit') }}" class="btn add-btn"><i class="fa fa-plus"></i> New Deposit</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
  </div>
  <!-- /Page Header -->



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
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><strong>Transaction ID</strong> : {{isset($data->trx ) ? $data->trx  : 'N/A'}}</h4>
              <div class="small text-muted"><strong>SL</strong> : {{++$k}}</div>
              <div class="small text-muted"><strong>Transaction ID</strong> : {{isset($data->trx ) ? $data->trx  : 'N/A'}}</div>
              <div class="small text-muted"><strong>Details</strong> : {{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}}</div>
              <div class="small text-muted"><strong>Amount</strong> : {!! isset($data->amount) ? $data->amount : 'N/A' !!} {!! $basic->currency !!}</div>
              <div class="small text-muted"><strong>Time</strong> : {!! date(' d M, Y h:i A', strtotime($data->created_at)) !!}</div>
            </div>
          </div>
      @endforeach
      @else
          <center> You don't have any Deposits!!</center>

      @endif

  {{$invests->links()}}

  </div>





@stop
