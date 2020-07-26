@extends('nhbrc')


@section('body')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Company Financies</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-financial.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Company Financies</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->



<div class="row staff-grid-row">

  @if(count($financies) >0)
      @foreach($financies as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="profile-img">
                <a href="{{ route('nhbrc-financial.edit',$data) }}" class="avatar"><img src="{{ url('/') }}/assets/images/financial-records.png" alt="{{$data->firstname}} {{$data->lastname}}" width="80px" height="80px"></a>
              </div>
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis">Year: {{$data->year}} </a></h4>
              <div class="small text-muted">Expected Turn Over : R{{ $data->expected_turn_over }}</div>
              <div class="small text-muted">Expected Profit/Loss: <span class="badge badge-@if($data->expected_profit_or_loss==1)success @elseif($data->expected_profit_or_loss==0)danger @endif">RSS{{$data->expected_profit }}</span></div>

              <div class="small text-muted">Turn Over : RS{{ $data->turn_over }}</div>
              <div class="small text-muted">Profit/Loss: <span class="badge badge-@if($data->profit_or_loss==1)success @elseif($data->profit_or_loss==0)danger @endif">R{{$data->profit }}</span></div>
              <br>
              <br>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <center> You don't have any Company Financial Records!!</center>
      </div>

      @endif



</div>


      <script>
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>
              </div>
      </div>

@endsection
