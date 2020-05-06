@extends('merchant-1')
@section('css')
<meta property="og:image" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:secure_url" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | Mall Runners Application Form" />
<meta property="og:description" content="{{ $basic->sitename }},   Mall Runners Application Form" />
@endsection
@section('body')

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
    <a href="#app" id="apply_button" class="button">
      Apply Now
    </a>

  <h1 class="app-title">Become a Mall/Shop Runner : TrivieCash </h1>

  <span class="company-name">
    at triviecash.com
  </span>

    <div class="location">
      Cape Town, Johannesburg, Pretoria, Durban, East London,  Port Elizabeth,  Free State, Harare, Bulawayo, Mutare, Masvingo, Chitungwiza
    </div>
</div>
  <div id="content" class="">
<p><strong>Become a Mall/Shop Runner&nbsp;</strong></p>
<p><strong>SIGN UP TODAY AND OUR FRIENDLY RECRUITMENT TEAM WILL BE IN TOUCH TO SCHEDULE YOUR INTERVIEW!&nbsp;</strong></p>
<p><strong>Requirements:</strong></p>
<ul>
<li>An android smartphone for the runner app &amp; GPS.</li>
<li>ID</li>
<li>Proof of Address</li>
<li>Proof of bank details</li>
<li>Clear criminal record&nbsp;</li>
</ul>
<p>Please bring :</p>
<ul>
<li>National/International drivers license</li>
<li>Valid passport</li>
<li>Work permit/ Asylum</li>
<li>CV</li>
</ul>
<p><strong>Applicants that does not meet the following requirements will result in an unsuccessful application:</strong></p>
<ul>
<li><strong>&nbsp;</strong>Criminal record</li>
</ul>
<p><strong>Working conditions and Benefits:</strong></p>
<ul>
<li>Work part-time <strong>Friday-Sunday</strong>, or full-time.</li>
<li>Choose shifts that suit you and your branch manager.</li>
<li>We deliver 7 days a week with shifts in the morning, afternoon and evening.</li>
</ul>
<p><strong>Please note</strong>: Training will be provided to successful applicants.&nbsp; All our interviews are free, do not pay a scammer.</p>
</div>

  <div id="application" class="">
    <a name="app"></a>
    <form id="application_form" enctype="multipart/form-data" action="{{ route('mall-runner.application') }}" accept-charset="UTF-8" method="post">
    @csrf

      <div id="main_fields">
          <h2 class="heading">Apply for this Job</h2>

          <div class="required-fields">
            <span style="color:red;" style="color:red;">*</span> Required
          </div>

        <div class="clear"></div>
        <div class="row">
          <div class="field form-group col-md-6">
            <label for="first_name">First Name <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="fname" name="fname" aria-required="true" maxlength="255" autocomplete="off">
          </div>
          <div class="field form-group col-md-6">
            <label for="last_name">Last Name <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="lname" name="lname" aria-required="true" maxlength="255" autocomplete="off">
          </div>
          <div class="field form-group col-md-6">
            <label for="email">Email <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="email" name="email" aria-required="true" maxlength="255" autocomplete="off">
          </div>
          <div class="field form-group col-md-6">
            <label for="phone">Phone <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" maxlength="255" autocomplete="off" required="required" aria-required="true">
          </div>

          <div class="field form-group col-md-12">
            <label for="phone">Name of Mall Closet To You <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="mall_closet_to_you" name="mall_closet_to_you" maxlength="255" autocomplete="off" required="required" aria-required="true">
          </div>
        </div>




<div class="field form-group">
  <label aria-label="" id="resume">Resume/CV</label>

<input type="file" name="resume_doc" id="resume_doc" class="form-control" autocomplete="off" required/>

</div>

  <div class="field form-group">
    <label id="cover_letter" aria-label="">Cover Letter</label>

<input type="file" name="cover_letter_doc" id="cover_letter_doc" class="form-control" autocomplete="off" required/>

  </div>

<div class="row">

        <div class="form-group col-md-6">
          <label>In which city do you want to work in?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>

             <select class="form-control" name="city_id" id="city_id" required>
               @foreach($cities as $city)
                  <option value="{{ $city->id }}">{{ $city->city }}</option>
               @endforeach
            </select>
        </div>

        <div class="field form-group col-md-6">
          <label>Which City Neighbourhood are you applying for<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
          <select  class="select2-offscreen form-control" name="neighbourhood_id" id="neighbourhood_id" required>
            @foreach($neighbourhoods as $neighbourhood)
            <option value="{{ $neighbourhood->id }}">{{ $neighbourhood->neighbourhood }}</option>
            @endforeach

          </select>

        </div>

        <div class="field form-group col-md-6">
          <label>Suburb of Preference<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
          <select  class="select2-offscreen form-control" name="suburb_id" id="suburb_id" required>
            @foreach($suburbs as $suburb)
            <option value="{{ $suburb->id }}">{{ $suburb->suburb }}</option>
            @endforeach

          </select>

        </div>

        <div class="field form-group col-md-6">
                <label>Race <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
                <select class="form-control" name="race" id="race" required>
                    <option value="African">African</option>
                    <option value="White">White</option>
                    <option value="Indian">Indian</option>
                    <option value="Coloured">Coloured</option>
                </select>
        </div>

        <div class="field form-group col-md-6">
          <label>Country of Residence <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
            <select class="form-control" name="country_id" id="country_id" required>
            <option value="">Please select</option>
            @foreach($countries as $country)
              <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
            </select>
        </div>
        <br>

        <div class="field form-group col-md-6">
          <label>Gender<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
            <select class="form-control" name="gender" id="gender" required>
                <option value="">Please select</option>
                <option value="Female">Female</option>
                <option value="Male">Male</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="field form-group col-md-6">
          <label>ID / Passport Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="text" name="id_number" id="id_number" class="form-control" aria-required="true" maxlength="255" autocomplete="off">
        </div>

</div>

<div class="field form-group">
  <label>Please attached a photo of your ID / Passport</label>
    <br>
<input type="file"  name="Id_doc" id="Id_doc" class="form-control" required/>
</div>


<div class="row">



<div class="field form-group col-md-6">
  <label>Runner Availability <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="checkbox"  name="anytime" id="anytime" value="anytime" set="anytime" aria-required="true">&nbsp;&nbsp;Anytime
        </label>
        <br>
        <label>
          <input type="checkbox"  name="weekends" id="weekends"  value="weekends" set="weekends" aria-required="true">&nbsp;&nbsp;Weekends
        </label>
        <br>
        <label>
          <input type="checkbox"  name="weekdays" id="" value="weekdays" set="weekdays" aria-required="true">&nbsp;&nbsp;Weekdays
        </label>
        <br>
        <label>
          <input type="checkbox" name="nights" id="nights" value="nights" set="nights" aria-required="true">&nbsp;&nbsp;Nights
        </label>
        <br>
</div>


<div class="field form-group col-md-6">
  <label>Do you have a criminal record?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
  <select class="form-control" name="criminal_record" id="criminal_record" required>
      <option value="1">Yes</option>
      <option value="0">No</option>
  </select>
</div>

<div class="field form-group col-md-6">
  <label>Do you own an Android Mobile Phone? <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
        <br>
    <select class="form-control" name="mobile_phone" id="mobile_phone" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

</div>
</div>
<div id="error_message"></div>

  <div id="submit_buttons">
    <input type="submit" value="Submit Application" id="submit_app" class="btn btn-primary">
  </div>

</div>





    </div>
  </div>
</form>
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
