@extends('merchant-1')
@section('content')



    <div class="app-title">
        <div>
            <h1><i class="fa fa-donate"></i> My Support Tickets</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Support Tickets</a></li>
        </ul>
    </div>


    <div class="row staff-grid-row">

    @if(count($supports) >0)
        @foreach($supports as $key => $support)
            <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
              <div class="profile-widget">

                <div class="dropdown profile-action">
                  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                  </div>
                </div>
                <h4 class="user-name m-t-10 mb-0 text-ellipsis"><strong>SL</strong> : {{ ++$key }}</h4>
                <div class="small text-muted"><strong>Date</strong> : {{ $support->created_at->format('d F, Y h:i A') }}</div>
                <div class="small text-muted"><strong>Ticket Number</strong> : #{{ $support->ticket }}</div>
                <div class="small text-muted"><strong>Subject</strong> : {{ $support->subject }}</div>
                <div class="small text-muted"><strong>Status</strong> :   @if($support->status == 0)
                      <span class="badge badge-primary">Open</span>
                  @elseif($support->status == 1)
                      <span class="badge badge-success "> Answered</span>
                  @elseif($support->status == 2)
                      <span class="badge badge-info "> Customer Replied</span>
                  @elseif($support->status == 3)
                      <span class="badge badge-danger ">Closed</span>
                  @endif</div>
                <div class="small text-muted"><strong>Action</strong> :  <a href="{{ route('user.message', $support->ticket) }}" class="edit ">
                    <i class="fa fa-eye"></i>
                </a></div>

              </div>
            </div>
        @endforeach
        @else
          <div class="col-md-12 col-sm-12 col-12">
            <center> You Don't Have Any Support Tickets !!</center>
          </div>

        @endif

      {{$supports->links()}}

    </div>


    @stop
