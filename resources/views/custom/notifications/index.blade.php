@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">{{$page_title}}</li>
      </ul>
    </div>
  </div>
</div>
<!-- /Page Header -->

<div class="row">
  <div class="col-md-12">
    <div class="activity">
      <div class="activity-box">
        <ul class="activity-list">
          @foreach($notifications1 as $notification)

                <li>
                  <div class="activity-user">
      										{!! $notification->icon !!}
                  </div>
                  <div class="activity-content">
                    <div class="timeline-content">
                      <a href="{{ route('read-notification',['id'=>$notification->id]) }}" class="name">	{{ $notification->message }} </a>
                    </div>
                  </div>
                </li>

            @endforeach


        </ul>
      </div>
    </div>
  </div>
</div>



@endsection
