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
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('shopping-list') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add {{$page_title}}</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->

<div class="row staff-grid-row">

  @if(count($shopping_requests) >0)
      @foreach($shopping_requests as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" onclick="CancelShoppingRequest({{ $data->id }})" data-toggle="modal" data-target="#CancelShoppingRequest"><i class="fa fa-stop m-r-5"></i> Cancel Request</a>
                  <a class="dropdown-item" href="#" onclick="DeleteShoppingRequest({{ $data->id }})" data-toggle="modal" data-target="#DeleteShoppingRequest"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <div class="small text-muted"><strong> List :</strong> {{ $data->shopping_lists_name }}</div><br><br>
              <div class="small text-muted"><strong> Status :</strong> {{ $data->status }}</div>
              <div class="small text-muted"><strong> Reason :</strong> {{ $data->reason }}</div>

            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <center> You don't have any Shopping Requests!!</center>
      </div>

      @endif


</div>

<!-- Delete Shopping Request -->

<div id="DeleteShoppingRequest" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Shopping Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('delete-shopping-requests') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='delete_shopping_request_id' value=""/>
          Are you sure you want delete this Shopping Request?
        <div>
        </div>
<br>
  <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Shopping Request -->

<!-- Cancel Shopping Request -->

<div id="CancelShoppingRequest" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Cancel Shopping Request</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('cancel-shopping-requests') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='cancel_shopping_request_id' value=""/>
          Are you sure you want cancel this Shopping Request?
        <div>
        </div>
<br>
  <button class="btn btn-danger">Cancel</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Cancel Shopping Request -->

@endsection
@section('import-script')

    <!-- Summernote JS -->
<script src="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.min.js"></script>

<!-- Task JS -->
<script src="{{ url('/') }}/assets/smarthr/js/task.js"></script>
<script>

function  CancelShoppingRequest(id){

    $('#cancel_shopping_request_id').val(id);

  }

  function  DeleteShoppingRequest(id){

      $('#delete_shopping_request_id').val(id);

    }

</script>

@stop
