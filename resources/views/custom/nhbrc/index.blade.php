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
    <form id="application_form" enctype="multipart/form-data" action="{{ route('nhbrc-company-details.store') }}" accept-charset="UTF-8" method="post">
    @csrf
    <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
      <div id="main_fields">

          <div class="required-fields">
            <span style="color:red;" style="color:red;">*</span> Required
          </div>

        <div class="clear"></div>
        <div class="row">

          <div class="field form-group col-md-6">
            <label for="company_name">Company Name<span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="company_name" name="company_name" aria-required="true" maxlength="255" value="{{ old('company_name') ?? $company->company_name ?? '' }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-6">
            <label for="trading_name">Trading Name <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="trading_name" name="trading_name" aria-required="true" maxlength="255" value="{{ old('trading_name') ?? $company->trading_name ?? ''  }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-12">
            <label for="postal_address">Postal Address <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="postal_address" name="postal_address" aria-required="true" maxlength="255" value="{{ old('postal_address') ?? $company->postal_address ?? ''  }}" autocomplete="off">
          </div>

          <div class="field form-group col-md-12">
            <label for="physical_address">Physical Address <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="physical_address" name="physical_address" maxlength="255" autocomplete="off" value="{{ old('physical_address') ?? $company->physical_address ?? ''  }}" required="required" aria-required="true">
          </div>

          <div class="field form-group col-md-3">
            <label for="postal_code">Postal Code<span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" maxlength="255" autocomplete="off" value="{{ old('postal_code') ?? $company->postal_code ?? ''  }}" required="required" aria-required="true">
          </div>

           <div class="field form-group col-md-3">
            <label for="town">Town <span style="color:red;" aria-hidden="true">*</span></label>
            <input type="text" class="form-control" id="town" name="town" maxlength="255" autocomplete="off" value="{{ old('town') ?? $company->town ?? ''  }}" required="required" aria-required="true">
          </div>



          <div class="field form-group col-md-6">
          <label>Region<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <select class="form-control" name="region" id="region" required>
                  <option @if(old('region')==="" || $company->region ==="" )selected @endif value="">Please Region</option>
                  <option @if(old('region')==="Eastern Cape" || $company->region ==="Eastern Cape" )selected @endif value="Eastern Cape">Eastern Cape</option>
                  <option @if(old('region')==="Free State" || $company->region ==="Free State" )selected @endif value="Free State">Free State</option>
                  <option @if(old('region')==="Gauteng" || $company->region ==="Gauteng" )selected @endif value="Gauteng">Gauteng</option>
                  <option @if(old('region')==="KwaZulu-Natal" || $company->region ==="KwaZulu-Natal" )selected @endif value="KwaZulu-Natal">KwaZulu-Natal</option>
                  <option @if(old('region')==="Limpopo" || $company->region ==="Limpopo" )selected @endif value="Limpopo">Limpopo</option>
                  <option @if(old('region')==="Mpumalanga" || $company->region ==="Mpumalanga" )selected @endif value="Mpumalanga">Mpumalanga</option>
                  <option @if(old('region')==="North West" || $company->region ==="North West" )selected @endif value="North West">North West</option>
                  <option @if(old('region')==="Northern Cape" || $company->region ==="Northern Cape" )selected @endif value="Northern Cape">Northern Cape</option>
                  <option @if(old('region')==="Western Cape" || $company->region ==="Western Cape" )selected @endif value="Western Cape">Western Cape</option>
              </select>
           
        </div>


        </div>


<div class="row">

        <div class="form-group col-md-6">
          <label>Telephone <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
             <input type="text" class="form-control" id="telephone" name="telephone" maxlength="255" autocomplete="off" value="{{ old('telephone') ?? $company->telephone ?? ''  }}" required="required" aria-required="true">
        </div>

        <div class="field form-group col-md-6">
          <label>Fax Number<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
          <input type="text" class="form-control" id="fax_number" name="fax_number" maxlength="255" autocomplete="off" value="{{ old('fax_number') ?? $company->fax_number ?? ''  }}" required="required" aria-required="true">
        </div>



        <div class="field form-group col-md-6">
          <label>Cell Number<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <input type="text" class="form-control" id="cell_number" name="cell_number" maxlength="255" autocomplete="off" value="{{ old('cell_number') ?? $company->cell_number ?? ''  }}" required="required" aria-required="true">

        </div>


        <div class="field form-group col-md-6">
          <label>Email Address<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <input type="text" class="form-control" id="email_address" name="email_address" maxlength="255" autocomplete="off" value="{{ old('email_address') ?? $company->email_address ?? ''  }}" required="required" aria-required="true">
        </div>



        <div class="field form-group col-md-6">
          <label>Year Started Trading <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="year_started_trading" id="year_started_trading" class="form-control" aria-required="true" value="{{ old('year_started_trading') ?? $company->year_started_trading ?? ''  }}" maxlength="255" required autocomplete="off">
        </div>

        <div class="field form-group col-md-6">
          <label>Number of employees <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="number_of_employees" id="number_of_employees" class="form-control" aria-required="true" value="{{ old('number_of_employees') ?? $company->number_of_employees ?? ''  }}" maxlength="255" required autocomplete="off">
        </div>


           <hr>
        <div class="field form-group col-md-12">
          <label>Number of Houses built during the last three years<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              
        </div>

         <div class="field form-group col-md-2">
          <label>Year  <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="year1" id="year1" class="form-control" aria-required="true" value="{{ old('year1') ?? $company->year1 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>
         <div class="field form-group col-md-2">
          <label>Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="number1" id="number1" class="form-control" aria-required="true" value="{{ old('number1') ?? $company->number1 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>

         <div class="field form-group col-md-2">
          <label>Year<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="year2" id="year2" class="form-control" aria-required="true" value="{{ old('year2') ?? $company->year2 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>

         <div class="field form-group col-md-2">
          <label>Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="number2" id="number2" class="form-control" aria-required="true" value="{{ old('number2') ?? $company->number2 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>


         <div class="field form-group col-md-2">
          <label>Year <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="year3" id="year3" class="form-control" aria-required="true" value="{{ old('year3') ?? $company->year3 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>

         <div class="field form-group col-md-2">
          <label>Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="number" name="number3" id="number3" class="form-control" aria-required="true" value="{{ old('number3') ?? $company->number3 ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>
               <div class="field form-group col-md-12">
        
            <br>
              
        </div>



</div>
<div class="row">
         <div class="field form-group col-md-4">
          <label>Company Reg. Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="text" name="company_reg_number" id="company_reg_number" class="form-control" aria-required="true" value="{{ old('company_reg_number') ?? $company->company_reg_number ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>

         <div class="field form-group col-md-4">
          <label>Vat Reg.Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="text" name="vat_reg_number" id="vat_reg_number" class="form-control" aria-required="true" value="{{ old('vat_reg_number') ?? $company->vat_reg_number ?? ''  }}" maxlength="255" autocomplete="off" required>
        </div>

         <div class="field form-group col-md-4">
          <label>Bargain Council Reg. Number <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
            <br>
              <input type="text" name="bargain_council_registration_number" id="bargain_council_registration_number" class="form-control" aria-required="true" value="{{ old('bargain_council_registration_number') ?? $company->bargain_council_registration_number ?? ''  }}" required  maxlength="255" autocomplete="off"> 
        </div>

 </div>
<div class="row">
<div class="field form-group col-md-2">
  <label>Type of Legal Personal/nstitution? <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
            <label>
          <input type="radio"  name="type_of_Legal_Institution" id="type_of_Legal_Institution"  value="Closed Corporation" set="Closed Corporation" aria-required="true" @if(old('type_of_Legal_Institution')=="Closed Corporation" || $company->type_of_Legal_Institution=="Closed Corporation" )checked @endif>&nbsp;&nbsp;Closed Corporation
        </label>
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_of_Legal_Institution" value="Partnership" set="Partnership" aria-required="true" @if(old('type_of_Legal_Institution')=="Partnership" || $company->type_of_Legal_Institution=="Partnership"  )checked @endif>&nbsp;&nbsp;Partnership
        </label>
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="Sole Trader" set="Sole Trader" aria-required="true" @if(old('type_of_Legal_Institution')=="Sole Trader" ||  $company->type_of_Legal_Institution=="Sole Trader"  )checked @endif>&nbsp;&nbsp;Sole Trader
        </label>
          <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="Trust" set="Trust" aria-required="true" @if(old('type_of_Legal_Institution')=="Trust" ||  $company->type_of_Legal_Institution=="Trust"  )checked @endif>&nbsp;&nbsp;Trust
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="PTY (Ltd)" set="PTY (Ltd)" aria-required="true" @if(old('type_of_Legal_Institution')=="PTY (Ltd)" ||  $company->type_of_Legal_Institution=="PTY (Ltd)"  )checked @endif>&nbsp;&nbsp;PTY (Ltd)
        </label>
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="Ltd" set="Ltd" aria-required="true" @if(old('type_of_Legal_Institution')=="Ltd" || $company->type_of_Legal_Institution=="Ltd" )checked @endif>&nbsp;&nbsp;Ltd
        </label>
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="PLC" set="PLC" aria-required="true" @if(old('type_of_Legal_Institution')=="PLC" ||  $company->type_of_Legal_Institution=="PLC"  )checked @endif>&nbsp;&nbsp;PLC
        </label>
        <br>
        <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="PHD" set="PHD" aria-required="true" @if(old('type_of_Legal_Institution')=="PHD" ||  $company->type_of_Legal_Institution=="PHD"  )checked @endif>&nbsp;&nbsp;PHD
        </label>
        <br>
         <label>
          <input type="radio"   name="type_of_Legal_Institution" id="type_ofL_egal_Institution" value="Municipality" set="Municipality" aria-required="true" @if(old('type_of_Legal_Institution')=="Municipality" ||  $company->type_of_Legal_Institution=="Municipality"  )checked @endif>&nbsp;&nbsp;Municipality
        </label>
        <br>

</label>
</div>


<div class="field form-group col-md-2">
  <label>Main Business Area  <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="radio"  name="main_business_area" id="main_business_area" value="anytime" set="anytime" aria-required="true" @if(old('main_business_area')=="anytime" ||  $company->main_business_area =="Home Building Developer" )checked @endif>&nbsp;&nbsp;Home Building Developer
        </label>
        <br>
        <label>
          <input type="radio"  name="main_business_area" id="main_business_area"  value="weekends" set="weekends" aria-required="true" @if(old('main_business_area')=="weekends" || $company->main_business_area =="Home Building Contractor" )checked @endif>&nbsp;&nbsp;Home Building Contractor
        </label>
        <br>
        <label>
          <input type="radio"  name="main_business_area" id="main_business_area" value="weekdays" set="weekdays" aria-required="true" @if(old('main_business_area')=="weekdays" ||  $company->main_business_area =="Altercations And Additions" )checked @endif>&nbsp;&nbsp;Altercations And Additions
        </label>
        <br>
        <label>
          <input type="radio" name="main_business_area" id="main_business_area" value="Easte Agent" set="Easte Agent" aria-required="true" @if(old('main_business_area')=="nights" || $company->main_business_area =="Easte Agent")checked @endif>&nbsp;&nbsp;Easte Agent
        </label>
        <br>
        <label>
          <input type="radio" name="main_business_area" id="main_business_area" value="General Contractor" set="General Contractor" aria-required="true" @if(old('main_business_area')=="nights" ||  $company->main_business_area =="General Contractor" )checked @endif>&nbsp;&nbsp;General Contractor
        </label>
        <br>
        <label>
          <input type="radio" name="main_business_area" id="main_business_area" value="Subsidy Housing" set="Subsidy Housing" aria-required="true" @if(old('main_business_area')=="Subsidy Housing" || $company->main_business_area =="Subsidy Housing" )checked @endif>&nbsp;&nbsp;Subsidy Housing
        </label>
        <br>
        <label>
          <input type="radio" name="main_business_area" id="main_business_area" value="Other" set="Other" aria-required="true" @if(old('main_business_area')=="Other"  || $company->main_business_area =="Other" )checked @endif>&nbsp;&nbsp;Other
        <br>
</div>

<div class="field form-group col-md-2">
  <label>How many units do you intend to build this year?  <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="radio"  name="units_intended_this_year" id="units_intended_this_year" value="0-5" set="0-5" aria-required="true" @if(old('units_intended_this_year')=="0-5" || $company->units_intended_this_year=="0-5" )checked @endif>&nbsp;&nbsp;0-5
        </label>
        <br>
        <label>
          <input type="radio"  name="units_intended_this_year" id="units_intended_this_year"  value="6-10" set="6-10" aria-required="true" @if(old('units_intended_this_year')=="6-10" || $company->units_intended_this_year=="6-10" )checked @endif>&nbsp;&nbsp;6-10
        <br>
        <label>
          <input type="radio"  name="units_intended_this_year" id="units_intended_this_year" value="11-15" set="11-15" aria-required="true" @if(old('units_intended_this_year')=="11-15" || $company->units_intended_this_year=="11-15" )checked @endif>&nbsp;&nbsp;11-15
        </label>
        <br>
        <label>
          <input type="radio" name="units_intended_this_year" id="units_intended_this_year" value="16-20" set="16-20" aria-required="true" @if(old('units_intended_this_year')=="16-20" || $company->units_intended_this_year=="16-20" )checked @endif>&nbsp;&nbsp;16-20
        </label>
        <br>
        <label>
          <input type="radio" name="units_intended_this_year" id="units_intended_this_year" value="21-30" set="21-30" aria-required="true" @if(old('units_intended_this_year')=="21-30" || $company->units_intended_this_year=="21-30" )checked @endif>&nbsp;&nbsp;21-30
        </label>
        <br>
        <label>
          <input type="radio" name="units_intended_this_year" id="units_intended_this_year" value="Subsidy Housing" set="Subsidy Housing" aria-required="true" @if(old('units_intended_this_year')=="Subsidy Housing" || $company->units_intended_this_year=="Subsidy Housing" )checked @endif>&nbsp;&nbsp;31-50
        </label>
        <br>
</div>

<div class="field form-group col-md-2">
  <label>Type of building to erected <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="radio"  name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Single Storey" set="Single Storey" aria-required="true" @if(old('type_of_building_to_be_erected')=="Single Storey" || $company->type_of_building_to_be_erected =="Single Storey" )checked @endif>&nbsp;&nbsp;Single Storey
        </label>
        <br>
        <label>
          <input type="radio"  name="type_of_building_to_be_erected" id="type_of_building_to_be_erected"  value="Double Storey" set="Double Storey" aria-required="true" @if(old('type_of_building_to_be_erected')=="Double Storey" || $company->type_of_building_to_be_erected =="Double Storey" )checked @endif>&nbsp;&nbsp;Double Storey
        </label>
        <br>
        <label>
          <input type="radio"  name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="More than two Storeys" set="More than two Storeys" aria-required="true" @if(old('type_of_building_to_be_erected')=="weekdays" || $company->type_of_building_to_be_erected =="More than two Storeys" )checked @endif>&nbsp;&nbsp;More than two Storeys
        </label>
        <br>
        <label>
          <input type="radio" name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Apartment Blocks
        </label>" set="Apartment Blocks
        </label>" aria-required="true" @if(old('type_of_building_to_be_erected')=="Apartment Blocks"|| $company->type_of_building_to_be_erected =="Apartment Blocks" )checked @endif>&nbsp;&nbsp;Apartment Blocks
        </label>
        <br>
         <label>
          <input type="radio" name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Convectional Masonry" set="Convectional Masonry" aria-required="true" @if(old('type_of_building_to_be_erected')=="Convectional Masonry" || $company->type_of_building_to_be_erected =="Convectional Masonry" )checked @endif>&nbsp;&nbsp;Convectional Masonry
        </label>
        <br>
        <label>
          <input type="radio" name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Timber Framed (SABS 082)" set="Timber Framed (SABS 082)" aria-required="true" @if(old('type_of_building_to_be_erected')=="Timber Framed (SABS 082)" || $company->type_of_building_to_be_erected =="Timber Framed (SABS 082)" )checked @endif>&nbsp;&nbsp;Timber Framed (SABS 082)
        </label>
        <br>
       <label>
          <input type="radio" name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Rational Design" set="Rational Design" aria-required="true" @if(old('type_of_building_to_be_erected')=="Rational Design" || $company->type_of_building_to_be_erected =="Rational Design" )checked @endif>&nbsp;&nbsp;Rational Design
        </label>
        <br>
               <label>
          <input type="radio" name="type_of_building_to_be_erected" id="type_of_building_to_be_erected" value="Agrement Certified" set="Agrement Certified" aria-required="true" @if(old('type_of_building_to_be_erected')=="Agrement Certified" || $company->type_of_building_to_be_erected =="Agrement Certified" )checked @endif>&nbsp;&nbsp;Agrement Certified
        </label>
        <br>
</div>

<div class="field form-group col-md-2">
  <label>HDI status  <span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
    <br>
        <label>
          <input type="radio"  name="HDI_status" id="HDI_status" value="Yes" set="Yes" aria-required="true" @if(old('HDI_status')=="Yes" || $company->HDI_status=="Yes" )checked @endif>&nbsp;&nbsp;Yes
        </label>
        <br>
        <label>
          <input type="radio"  name="HDI_status" id="HDI_status"  value="No" set="No" aria-required="true" @if(old('HDI_status') =="No" || $company->HDI_status=="No" ) checked @endif>&nbsp;&nbsp;No
        </label>
        <br>
        <label>
          <input type="radio"  name="HDI_status" id="HDI_status" value="HDI%" set="HDI%" aria-required="true" @if(old('HDI_status') =="HDI%" || $company->HDI_status=="HDI%") checked @endif>&nbsp;&nbsp;HDI%
        </label>
        <br>
        <label>
          <input type="radio" name="HDI_status" id="HDI_status" value="Women%" set="Women%" aria-required="true" @if(old('HDI_status') =="Women%" || $company->HDI_status=="Women%") checked @endif>&nbsp;&nbsp;Women%
        </label>
        <br>
        <label>
          <input type="radio" name="HDI_status" id="HDI_status" value="Disabled%" set="Disabled%" aria-required="true" @if(old('HDI_status') =="Disabled%" || $company->HDI_status=="Disabled%")checked @endif>&nbsp;&nbsp;Disabled%
        </label>
        <br>
        <label>
          <input type="radio" name="HDI_status" id="HDI_status" value="Black%" set="Black%" aria-required="true" @if(old('HDI_status')=="Black%" || $company->HDI_status=="Black%")checked @endif>&nbsp;&nbsp;Black%
        </label>
        <br>
        <label>
          <input type="radio" name="HDI_status" id="HDI_status" value="Women%" set="Women%" aria-required="true" @if(old('HDI_status')=="Women%" || $company->HDI_status=="Women%")checked @endif>&nbsp;&nbsp;Women%
        </label>
        <br>
        <label>
          <input type="radio" name="HDI_status" id="HDI_status" value="HDI Management" set="HDI Management" aria-required="true" @if(old('HDI_status')=="HDI Management" || $company->HDI_status=="HDI Management" )checked @endif>&nbsp;&nbsp;HDI Management
        </label>
        <br>
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
