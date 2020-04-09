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
      <a href="#" data-toggle='modal' data-target="#AddDeliveryLocation" class="btn add-btn"><i class="fa fa-plus"></i> Add {{$page_title}}</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->



<div class="row staff-grid-row">

  @if(count($delivery_locations) >0)
      @foreach($delivery_locations as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" data-toggle='modal' data-target="#ShareDeliveryLocation" onclick="shareDeliveryLocation1({{$data->id}});" href="#"><i class="fa fa-share-alt m-r-5"></i> Share</a>
                  <a class="dropdown-item" data-toggle='modal' data-target="#EditDeliveryLocation" onclick="delivery_option1({{$data->id}});" href="#"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a class="dropdown-item" data-toggle='modal' data-target="#DeleteDeliveryLocation" onclick="deleteDeliveryLocationClient({{$data->id}});"  href="#"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <div class="small text-muted"><strong> Name :</strong> {{$data->name}}</div>
              <div class="small text-muted"><strong> Address :</strong> {{$data->address}}</div>
              <div class="small text-muted"><strong> Suburb :</strong> {{$data->suburb}}</div>
              <div class="small text-muted"><strong> Neighbourhood :</strong> {{$data->neighbourhood}}</div>
              <div class="small text-muted"><strong> City :</strong> {{$data->city}}</div>
              <div class="small text-muted"><strong> State :</strong> {{$data->state}}</div>
              <div class="small text-muted"><strong> Country :</strong>   @foreach($countries as $country)

                @if($country->id == intval($data->country)) {{ $country->name }} @endif
                @endforeach</div>
              <div class="small text-muted"><strong> Zip Code :</strong> {{$data->zip_code}}</div>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <center> You don't have any Delivery Locations Saved!!</center>
      </div>

      @endif



</div>

<!-- Add Delivery Location -->

<div id="AddDeliveryLocation" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Delivery Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('delivery-locations.store') }}" id="send-pm1">
          {!! csrf_field() !!}
          <div class="col-sm-12 form-group">
            <label class="col-form-label">Name of Delivery Point <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" placeholder="Name of Delivery Location eg. Home" value="" />
          </div>

          <div class="col-sm-12 form-group">
              <label class="col-form-label">Delivery Address<span class="text-danger">*</span></label>
            <i class="icon-material-outline-location-on"></i>
            <input type="text" class="form-control" name="address" placeholder="Address" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Suburb <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="suburb" placeholder="suburb" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Neighbourhood <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="neighbourhood" placeholder="Neighbourhood" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">City <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="city" placeholder="City" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">State<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="state" placeholder="State" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Country <span class="text-danger">*</span></label>
            <select class="select form-control" name='country''>
                @foreach($countries as $country)
                <option @if(auth()->user()->country_id == $country->id) selected @endif value='{{ $country->id }}'>{{ $country->name }}</option>
                @endforeach
             </select>
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Zip Code/ Postal Code <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="zip_code" placeholder="Zip Code" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Special Instructions <span class="text-danger">*</span></label>
              <textarea name="textarea" name="message"   cols="10" placeholder="Message" class="form-control"></textarea>
          </div>


        <div>
        </div>

        <div class="submit-section">
          <button onclick="event.preventDefault();document.getElementById('send-pm1').submit();" class="btn btn-primary submit-btn">Create A Shopping List </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Delivery Location -->

<!-- Edit Delivery Location -->

<div id="EditDeliveryLocation" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Delivery Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('update-delivery-option')}}" id="send-pm12">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id="edit_delivery_location_id" value=""/>
          <div class="col-sm-12 form-group">
            <label class="col-form-label">Name of Delivery Point <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Name of Delivery Location eg. Home" value="" />
          </div>

          <div class="col-sm-12 form-group">
              <label class="col-form-label">Delivery Address<span class="text-danger">*</span></label>
            <i class="icon-material-outline-location-on"></i>
            <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Suburb <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="suburb" id="suburb" placeholder="suburb" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Neighbourhood <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="neighbourhood" id="neighbourhood" placeholder="Neighbourhood" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">City <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">State<span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="state" id="state" placeholder="State" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Country <span class="text-danger">*</span></label>
            <select class="select form-control" name='country'  id='country'>
                @foreach($countries as $country)
                <option value='{{ $country->id }}'>{{ $country->name }}</option>
                @endforeach
             </select>
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Zip Code/ Postal Code <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Zip Code" value="" />
          </div>

          <div class="col-sm-12 form-group">
            <label class="col-form-label">Special Instructions <span class="text-danger">*</span></label>
              <textarea name="textarea" name="message" id="message"  cols="10" placeholder="Message" class="form-control"></textarea>
          </div>


        <div>
        </div>

        <div class="submit-section">
          <button onclick="event.preventDefault();document.getElementById('send-pm12').submit();" class="btn btn-primary submit-btn">Create A Shopping List </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Delivery Location -->

<!-- Delete Delivery Location -->

<div id="DeleteDeliveryLocation" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Delivery Location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('delete-delivery-option') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='delete_delivery_location_id' value=""/>
          Are you sure you want delete this Delivery Location?
        <div>
        </div>
<br>
  <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete Delivery Location -->

<!-- Share Shopping List -->

<div id="ShareDeliveryLocation" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Share Delivery Location </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Share Delivery Location <br><br>
        <form method="post" action="{{ route('share-delivery-location') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id="share_delivery_location_id" value="">
        <div class="input-group m-b-30">
          <select class="form-control search-input" data-live-search="true" required name="email" id="email">

           @foreach($contacts as $contact)
               @if($contact->email!='' || $contact->email!=null)
                  <option value="{{ $contact->email }}">({{ $contact->firstname }} {{ $contact->lastname }}) {{ $contact->email }}</option>
               @endif
            @endforeach
          </select>
          <span class="input-group-append">
            <button class="btn btn-primary">Share</button>
          </span>
        </div>
        <div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Share Shopping List -->



@endsection
@section('import-script')
<!-- Summernote JS -->
<script src="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.min.js"></script>

<!-- Task JS -->
<script src="{{ url('/') }}/assets/smarthr/js/task.js"></script>
<script>
function delivery_option1(id){
  editDeliveryLocationClient(id);
  $.ajax({
            url: '{{ url('/') }}/user/get-delivery-option/'+id,
            cache   : false,
            type    : "GET",
            dataType : 'json',
            error   : function(data)
            {
                console.log('error occured when trying to find the from city');
            },
            success : function(data)
            {
              $('#name').val(data.name);
              $('#address').val(data.address);
              $('#suburb').val(data.suburb);
              $('#neighbourhood').val(data.neighbourhood);
              $('#city').val(data.city);
              $('#state').val(data.state);
              $('#country').val(data.country);
              $('#zip_code').val(data.zip_code);
              $('#message').val(data.instruction);
            }
                });

}
  function  editDeliveryLocationClient(id){
      $('#edit_delivery_location_id').val(id);
    }

    function  shareDeliveryLocation1(id){
        $('#share_delivery_location_id').val(id);
      }


  function  deleteDeliveryLocationClient(id){
      $('#delete_delivery_location_id').val(id);
    }

</script>

@stop
