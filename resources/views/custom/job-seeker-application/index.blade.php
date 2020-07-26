@extends('merchant-1')
@section('css')
<meta property="og:image" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:secure_url" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | Drivers Application Form" />
<meta property="og:description" content="{{ $basic->sitename }},   Drivers Application Form" />
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

  <h1 class="app-title">Job Seeker Application: {{ $basic->sitename }}  </h1>

  <span class="company-name">
    at {{ $basic->sitename }}.com
  </span>

</div>
  <div id="content" class="">
<p><strong>SIGN UP TODAY AND OUR FRIENDLY RECRUITMENT TEAM WILL BE IN TOUCH TO SCHEDULE YOUR INTERVIEW AT A BRANCH CLOSE TO YOU!&nbsp;</strong></p>
<p><strong>Please note</strong>:All our interviews are free, do not pay a scammer.</p>
</div>

  <div id="application" class="">
    <a name="app"></a>
    <form id="application_form" enctype="multipart/form-data" action="{{ route('job.seeker.application') }}" accept-charset="UTF-8" method="post">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
      <div id="main_fields">

          <div class="required-fields">
            <span style="color:red;" style="color:red;">*</span> Required
          </div>

        <div class="clear"></div>
        <div class="row">

          <div class="field form-group col-md-6">
            <label for="first_name">First Name <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="fname" name="fname" aria-required="true" maxlength="255" value="{{ old('fname') }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-6">
            <label for="last_name">Last Name <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="lname" name="lname" aria-required="true" maxlength="255" value="{{ old('lname') }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-6">
            <label for="email">Email <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="email" name="email" aria-required="true" maxlength="255" value="{{ old('email') }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-6">
            <label for="phone">Phone <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="phone" name="phone" maxlength="255" autocomplete="off" value="{{ old('phone') }}" required="required" aria-required="true">
          </div>

          <div class="field form-group col-md-6">
            <label for="highest_education_qualification">Highest Education Qualification <span style="color:red;" aria-hidden="true">*</span></label>
              <select class="form-control" name="highest_education_qualification" id="highest_education_qualification" required>
               @foreach($highest_education_qualifications as $highest_education_qualification)
                  <option @if(old('highest_education_qualification')===$highest_education_qualification->id )selected @endif value="{{ $highest_education_qualification->id }}">{{ $highest_education_qualification->education_qualification }}</option>
               @endforeach
            </select>
          </div>

           <div class="field form-group col-md-6">
            <label for="industry_sector">Industry Sector <span style="color:red;" aria-hidden="true">*</span></label>
              <select class="form-control" name="industry_sector" id="industry_sector" required>
               @foreach($industry_sectors as $industry_sector)
                  <option @if(old('industry_sector')===$industry_sector->id )selected @endif value="{{ $industry_sector->id }}">{{ $industry_sector->industry_sector }}</option>
               @endforeach
            </select>
          </div>

          <div class="field form-group col-md-6">
          <label>Employment Status<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <select class="form-control" name="employment_status" id="employment_status" required>
                  <option @if(old('employment_status')==="" )selected @endif value="">Please select Employment Status</option>
                  <option @if(old('employment_status')==="Unemployed" )selected @endif value="Unemployed">Unemployed</option>
                  <option @if(old('employment_status')==="Retrenched" )selected @endif value="Retrenched">Retrenched</option>
                  <option @if(old('employment_status')==="Contracted" )selected @endif value="Contracted">Contracted</option>
                  <option @if(old('employment_status')==="Part Time Employed" )selected @endif value="Part Time Employed">Part Time Employed</option>
                  <option @if(old('employment_status')==="Permanently Employed" )selected @endif value="Permanently Employeed">Permanently Employed</option>
                  <option @if(old('employment_status')==="Retired" )selected @endif value="Retired">Retired</option>
              </select>
            </select>
        </div>

          <div class="field form-group">
            <label id="clear_image_of_yourself" aria-label="">Clear Image of Yourself</label>
              <input type="file" name="clear_image_of_yourself" id="clear_image_of_yourself" class="form-control" autocomplete="off" required/>
          </div>



          <div class="field form-group col-md-12">
            <label for="skills">Skills (List your skills separated by a comma) <span style="color:red;" aria-hidden="true">*</span></label>
            <textarea  class="form-control" id="skills" name="skills" autocomplete="off" required="required" aria-required="true">{{ old('skills') }}</textarea> 
          </div>

          <div class="field form-group col-md-12">
            <label for="phone">About (Tell us about you!) <span style="color:red;" aria-hidden="true">*</span></label>
            <textarea class="form-control" id="skills" name="skills" autocomplete="off" required="required" aria-required="true">{{ old('skills') }}</textarea> 
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
          <label>City <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
             <input type="text" class="form-control" id="city_id" name="city_id" maxlength="255" autocomplete="off" value="{{ old('city_id') }}" required="required" aria-required="true">
        </div>

        <div class="field form-group col-md-6">
          <label>Neighbourhood<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
          <input type="text" class="form-control" id="neighbourhood_id" name="neighbourhood_id" maxlength="255" autocomplete="off" value="{{ old('neighbourhood_id') }}" required="required" aria-required="true">
        </div>



        <div class="field form-group col-md-6">
          <label>Suburb<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <input type="text" class="form-control" id="suburb_id" name="suburb_id" maxlength="255" autocomplete="off" value="{{ old('suburb_id') }}" required="required" aria-required="true">

        </div>

        <div class="field form-group col-md-6">
                <label>Race <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
                <select class="form-control" name="race" id="race" required>
                    <option @if(old('race')=="African" )selected @endif value="African">African</option>
                    <option @if(old('race')=="White" )selected @endif value="White">White</option>
                    <option @if(old('race')=="Indian" )selected @endif value="Indian">Indian</option>
                    <option @if(old('race')=="Coloured")selected @endif value="Coloured">Coloured</option>
                </select>
        </div>

        <div class="field form-group col-md-6">
          <label>Country of Residence <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
            <select class="form-control" name="country_id" id="country_id" required>
            <option value="">Please select</option>
            @foreach($countries as $country)
              <option @if(old('country_id')==$country->id)selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
            </select>
        </div>
        <br>

        <div class="field form-group col-md-6">
          <label>Gender<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
            <select class="form-control" name="gender" id="gender" required>
                <option @if(old('gender')==="" )selected @endif value="">Please select</option>
                <option @if(old('gender')==="African" )selected @endif value="Female">Female</option>
                <option @if(old('gender')==="African" )selected @endif value="Male">Male</option>
                <option @if(old('gender')==="African" )selected @endif value="Other">Other</option>
            </select>
        </div>

        <div class="field form-group col-md-6">
          <label>ID / Passport Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="text" name="id_number" id="id_number" class="form-control" aria-required="true" value="{{ old('id_number') }}" maxlength="255" autocomplete="off">
        </div>

</div>

<div class="field form-group">
  <label>Please attached a photo of your ID / Passport</label>
    <br>
<input type="file"  name="Id_doc" id="Id_doc" class="form-control" required/>
</div>

<div class="form-group col-md-12">
  <label>Do you have a valid Drivers Licence<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
    <select class="form-control" name="driver_license" id="driver_license" required>
      <option @if(old('gender')=="1" )selected @endif value="1">Yes</option>
      <option @if(old('gender')=="0" )selected @endif value="0">No</option>
    </select>
    </label>
</div>

<div class="field form-group">
  <label>Please attached a photo of your Drivers Licence</label>
    <br>
<input type="file"  name="driver_license_doc" id="driver_license_doc" class="form-control" required/>
</div>
 </div>
<div class="row">
<div class="field form-group col-md-6">
  <label>What type of Transport do you have? <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
            <label>
          <input type="checkbox"  name="car" id="car"  value="car" set="car" aria-required="true" @if(old('car')=="car" )checked @endif>&nbsp;&nbsp;Car
        </label>
        <br>
        <label>
          <input type="checkbox"   name="bike" id="bike" value="bike" set="bike" aria-required="true" @if(old('bike')=="bike" )checked @endif>&nbsp;&nbsp;Bike / Scooter
        </label>
        <br>
        <label>
          <input type="checkbox"   name="scooter" id="scooter" value="scooter" set="scooter" aria-required="true" @if(old('scooter')=="scooter" )checked @endif>&nbsp;&nbsp;No Transport
        </label>
        <br>
</label>
</div>


<div class="field form-group col-md-6">
  <label>Work Availability <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="checkbox"  name="anytime" id="anytime" value="anytime" set="anytime" aria-required="true" @if(old('anytime')=="anytime" )checked @endif>&nbsp;&nbsp;Anytime
        </label>
        <br>
        <label>
          <input type="checkbox"  name="weekends" id="weekends"  value="weekends" set="weekends" aria-required="true" @if(old('weekends')=="weekends" )checked @endif>&nbsp;&nbsp;Weekends
        </label>
        <br>
        <label>
          <input type="checkbox"  name="weekdays" id="" value="weekdays" set="weekdays" aria-required="true" @if(old('weekdays')=="weekdays" )checked @endif>&nbsp;&nbsp;Weekdays
        </label>
        <br>
        <label>
          <input type="checkbox" name="nights" id="nights" value="nights" set="nights" aria-required="true" @if(old('nights')=="nights" )checked @endif>&nbsp;&nbsp;Nights
        </label>
        <br>
</div>


<div class="field form-group col-md-6">
  <label>Do you have a criminal record?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
  <select class="form-control" name="criminal_record" id="criminal_record" required>
      <option @if(old('criminal_record')=="1" )selected @endif value="1">Yes</option>
      <option @if(old('criminal_record')=="0" )selected @endif value="0">No</option>
  </select>
</div>

<div class="field form-group col-md-6">
  <label>Do you own a Mobile Phone? <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
        <br>
    <select class="form-control" name="mobile_phone" id="mobile_phone" required>
        <option @if(old('mobile_phone')=="1" )selected @endif value="1">Yes</option>
        <option @if(old('mobile_phone')=="0" )selected @endif value="0">No</option>
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
