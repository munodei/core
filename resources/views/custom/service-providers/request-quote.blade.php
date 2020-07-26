@extends('nhbrc')
@section('css')
<meta property="og:image" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:secure_url" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | {{ $page_title }}" />
<meta property="og:description" content="{{ $basic->sitename }},   {{ $page_title }}" />
@endsection
@section('body')

      <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active">{{ $page_title }}</li>
      </ul>
    </div>
  </div>
</div>
<!-- /Page Header -->


<br>

<div id="wrapper">
<div id="main" class="accessible">

<div id="app_body">

    <div id="header">
  <div id="application" class="">
    <a name="app"></a>
    <form>
          @csrf
          <input type="hidden" name="serviceId" value="<?php echo isset($_POST['service_id'])?$_POST['service_id']:''; ?> <?php echo isset($user_request[0])?$user_request[0]->serviceid:''; ?>">
          <input type="hidden" name="id" value="<?php echo isset($id)?$id:0; ?><?php echo isset($user_request[0])?$user_request[0]->requestID:''; ?>">
          <input type="hidden" name="action" value="post-service">
          <div class="form-group">
              <label for="service_title">Category Service</label>
              <input type="text" name="service_cat" class="form-control required" id="service_cat" placeholder="Service Title" value="<?php echo isset($_POST['searchtxt'])?$_POST['searchtxt']:''; ?><?php echo isset($user_request[0])?$user_request[0]->fieldvalue:''; ?>" readonly>
          </div>
          <div class="form-group">
              <label for="service_title">Service Title</label>
              <input type="text" name="service_title" class="form-control required" id="service_title" placeholder="Service Title" value="<?php echo isset($user_request[0])?$user_request[0]->service_title:''; ?>">
          </div>
            <div class="form-group">
            <label for="service_description">Please add extra information of the service required</label>
            <textarea name="service_description" class="form-control required" style="height:100px;" id="service_description"><?php echo isset($user_request[0])?$user_request[0]->service_description:''; ?></textarea>
            </div>
            <div class="form-group">
            <div class="input-group">
            <label class="sr-only" for="budget"><font color="#FF0000">*</font>Budget</label>
            <div class="input-group-prepend">
              <div class="input-group-text">R</div>
            </div>
            <input type="text" name="budget" class="form-control budget required" min="1" digits="true" id="budget" placeholder="Enter Budget" value="<?php echo isset($user_request[0])?$user_request[0]->budget:''; ?>" data-error-container="#budget-error-class">
            </div>
            <div id="budget-error-class"></div>
            </div>
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Service Date</div>
              </div>
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
            <input type="date" name="service_date"  class="form-control" id="service_date"  placeholder="Service Date" value="<?php echo isset($user_request[0])?$user_request[0]->service_date:''; ?>">
            </div>
            <div id="datepicker-error-class"></div>
            </div>
            <div class="clearfix">
            <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Time</div>
              </div>
            <div class="input-group-addon"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></div>
            <input type="time" name="service_time" class="form-control" id="service_time" data-error-container="#timepicker-error-class" placeholder="12:30" value="<?php echo isset($user_request[0])?$user_request[0]->service_time:''; ?>">
            </div>
            <div id="timepicker-error-class"></div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Service Hours</div>
              </div>
            <input type="number" name="service_hour" class="form-control" id="service_hour" data-error-container="#service-hour-error-class" min="0" placeholder="1" value="<?php echo isset($user_request[0])?$user_request[0]->service_hour:''; ?>">

            </div>
            <div id="service-hour-error-class"></div>
            </div>
            </div>
            </div>
            </div>
               <div class="form-group">
            <div class="input-group">
              <label class="sr-only">Required At?</label>
              <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></div>
              <input type="text" name="searchPincode1" id="searchPincode1" class="form-control required" data-error-container="#address-hour-error-class" placeholder="Enter Address" value="<?php echo isset($_POST['searchPincode1'])?$_POST['searchPincode1']:''; ?><?php echo isset($user_request[0])?$user_request[0]->address:''; ?>" autocomplete="off">
            </div>
            <div id="address-error-class"></div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <label class="sr-only">Postal Code</label>
              <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></div>
              <input type="text" name="postal_code" id="postal_code" class="form-control required" value="<?php echo isset($_POST['postal_code'])?$_POST['postal_code']:''; ?><?php echo isset($user_request[0])?$user_request[0]->pincode:''; ?>" data-error-container="#pincode-hour-error-class" placeholder="Please enter your postal code">
            </div>
            <div id="pincode-error-class"></div>
          </div>
          <div class="clearfix margin-bottom-20"></div>
            <input type="hidden" name="latitude" id="latitude" value="<?php echo isset($_POST['latitude'])?$_POST['latitude']:''; ?><?php echo isset($user_request[0])?$user_request[0]->addressLat:''; ?>">
            <input type="hidden" name="longitude" id="longitude" value="<?php echo isset($_POST['longitude'])?$_POST['longitude']:''; ?><?php echo isset($user_request[0])?$user_request[0]->addressLng:''; ?>">
           <!--  <input type="hidden" name="pincode" id="pincode" value=""> -->

    <!-- <div class="map-panel" id="gMap"></div> -->
<?php echo isset($user_request[0])?'<button type="submit" class="btn btn-success">Update Request</button>':'<button type="submit" class="btn btn-default">Send Request</button>'; ?>

        {!! Form::close() !!}
                 </div>
        <!-- /Page Content -->
          </div>
      <!-- /Page Wrapper -->

      <script>
      function delivery_option1(id){

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
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>



@endsection
