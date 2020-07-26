@extends('nhbrc')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
      <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-technical-management.index') }}">Company Technical Management</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-technical-management.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Edit Company Technical Management</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{ route('nhbrc-technical-management.update',$tech_man) }}" name="createClientReference" enctype="multipart/form-data">
                        @csrf
                         {{ method_field('put') }}
                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">

                        <div class="form-group col-md-3">
                                <h5>Quality Control Person</h5>
                                <div class="input-group">
                                    <select name="type" class="form-control form-control-lg">
                                        <option @if(old('type')==='' || $tech_man->type === "" ) selected @endif value="">Select Quality Control Person</option>
                                        <option @if(old('type')==='In House' || $tech_man->type === "In House") selected @endif value="In House">In House</option>
                                        <option @if(old('type')==='Engineering Firm' || $tech_man->type === "Engineering Firm'") selected @endif value="Engineering Firm">Engineering Firm</option>
                                        <option @if(old('type')==='Contrator' || $tech_man->type === "Contrator") selected @endif value="Contrator">Contrator</option>
                                    </select>
                                </div>
                                @if ($errors->has('type'))
                                    <div class="error">{{ $errors->first('type') }}</div>
                                @endif
                        </div>

                           <div class="form-group col-md-2">
                                <h5>Title</h5>
                                <div class="input-group">
                                    <select name="title" class="form-control form-control-lg">
                                        <option @if(old('title')===''      || $tech_man->title === "" ) selected @endif value="">Select Title</option>
                                        <option @if(old('title')==='Mr.'   || $tech_man->title === "Mr."  ) selected @endif value="Mr.">Mr.</option>
                                        <option @if(old('title')==='Dr.'   || $tech_man->title === "Dr."  ) selected @endif value="Dr.">Dr.</option>
                                        <option @if(old('title')==='Miss.' || $tech_man->title === "Miss." ) selected @endif value="Miss.">Miss.</option>
                                        <option @if(old('title')==='Mrs.'  || $tech_man->title === "Mrs." ) selected @endif value="Mrs.">Mrs.</option>
                                        <option @if(old('title')==='Prof.' || $tech_man->title === "Prof" ) selected @endif value="Prof.">Prof.</option>
                                        <option @if(old('title')==='Lit.'  || $tech_man->title === "Lit" ) selected @endif value="Lit.">Lit.</option>
                                        <option @if(old('title')==='Gen.'  || $tech_man->title === "Gen."  ) selected @endif value="Gen.">Gen.</option>
                                        <option @if(old('title')==='Cde.'  || $tech_man->title === "Cde." ) selected @endif value="Cde.">Cde.</option>
                                        <option @if(old('title')==='Sir.'  || $tech_man->title === "Sir." ) selected @endif value="Sir.">Sir.</option>
                                        <option @if(old('title')==='Eng.'  || $tech_man->title === "Eng." ) selected @endif value="Eng.">Eng.</option>
                                    </select>
                                </div>
                                @if ($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">

                            <div class="form-group col-md-2">
                                <h5>Intials</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('initials') ?? $tech_man->initials ?? '' }}" class="form-control form-control-lg" placeholder="Director initials" name="initials">
                                </div>
                                @if ($errors->has('initials'))
                                    <div class="error">{{ $errors->first('initials') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-5">
                                <h5>Surname</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('surname') ?? $tech_man->surname ?? '' }}" class="form-control form-control-lg" placeholder="Surname" name="surname">
                                </div>
                                @if ($errors->has('surname'))
                                    <div class="error">{{ $errors->first('surname') }}</div>
                                @endif
                            </div>
                     

                            <div class="form-group col-md-3">
                                <h5> Company</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('company') ?? $tech_man->company ?? ''  }}" class="form-control form-control-lg" placeholder="Company" name="company">
                                </div>
                                @if ($errors->has('company'))
                                    <div class="error">{{ $errors->first('company') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Trading Name</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('trading_name') ?? $tech_man->trading_name ?? '' }}" class="form-control form-control-lg" placeholder="Trading Name" name="trading_name">
                                </div>
                                @if ($errors->has('trading_name'))
                                    <div class="error">{{ $errors->first('trading_name') }}</div>
                                @endif
                            </div>
                     
                            <div class="form-group col-md-3">
                                <h5>Company Reg. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="company_reg_number" value="{{ old('company_reg_number') ?? $tech_man->company_reg_number ?? '' }}" class="form-control form-control-lg" placeholder="Company Reg. Number" >
                                </div>
                                @if ($errors->has('company_reg_number'))
                                    <div class="error">{{ $errors->first('company_reg_number') }}
                                @endif       
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Company Vat. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="vat_reg_number" value="{{ old('vat_reg_number') ?? $tech_man->vat_reg_number ?? '' }}" class="form-control form-control-lg" placeholder="Company Vat. Number" >
                                </div>
                                @if ($errors->has('vat_reg_number'))
                                    <div class="error">{{ $errors->first('vat_reg_number') }}</div> 
                                @endif
                            </div>     

                            <div class="form-group col-md-4">
                                <h5>Mobile Number </h5>
                                <div class="input-group">
                                    <input type="text" name="mobile_number" value="{{ old('mobile_number') ?? $tech_man->mobile_number ?? '' }}" class="form-control form-control-lg" placeholder="Mobile Number" >
                                </div>
                                @if ($errors->has('mobile_number'))
                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <h5>Work Number </h5>
                                <div class="input-group">
                                    <input type="text" name="work_number" value="{{ old('work_number') ?? $tech_man->work_number ?? '' }}" class="form-control form-control-lg" placeholder="Work Number" >
                                </div>
                                @if ($errors->has('work_number'))
                                    <div class="error">{{ $errors->first('work_number') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4">
                                <h4>Email</h4>
                                <div class="input-group">
                                    <input type="text" name="email" value="{{ old('email') ?? $tech_man->email ?? '' }}" class="form-control form-control-lg" placeholder="Contact Email" >
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-8">
                                <h4>Physical Address</h4>
                                <div class="input-group">
                                    <input type="text" name="physical_address" value="{{ old('physical_address') ?? $tech_man->physical_address ?? '' }}" class="form-control form-control-lg" placeholder="Physical Address" >
                                </div>
                                @if ($errors->has('physical_address'))
                                    <div class="error">{{ $errors->first('physical_address') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <h4>Physical Town</h4>
                                <div class="input-group">
                                    <input type="text" name="physical_town" value="{{ old('physical_town') ?? $tech_man->physical_town ?? '' }}" class="form-control form-control-lg" placeholder="Physical Town" >
                                </div>
                                @if ($errors->has('physical_town'))
                                    <div class="error">{{ $errors->first('physical_town') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-7">
                                <h4>Postal Address</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_address" value="{{ old('postal_address') ?? $tech_man->postal_address ?? '' }}" class="form-control form-control-lg" placeholder="Postal Address" >
                                </div>
                                @if ($errors->has('postal_address'))
                                    <div class="error">{{ $errors->first('postal_address') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h4>Postal Town</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_town" value="{{ old('postal_town') ?? $tech_man->postal_town ?? '' }}" class="form-control form-control-lg" placeholder="Postal Town" >
                                </div>
                                @if ($errors->has('postal_town'))
                                    <div class="error">{{ $errors->first('postal_town') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-2">
                                <h4>Postal Code</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_code" value="{{ old('postal_code') ?? $tech_man->postal_code ?? '' }}" class="form-control form-control-lg" placeholder="Postal Code" >
                                </div>
                                @if ($errors->has('postal_code'))
                                    <div class="error">{{ $errors->first('postal_code') }}</div>
                                @endif
                            </div>


                            <div class="field form-group col-md-3">
                                <label for="highest_education_qualification">Highest Education Qualification <span style="color:red;" aria-hidden="true">*</span></label>
                                  <select class="form-control" name="highest_education_qualification" id="highest_education_qualification" required>
                                   @foreach($highest_education_qualifications as $highest_education_qualification)
                                      <option @if(old('highest_education_qualification')===$highest_education_qualification->education_qualification || $highest_education_qualification->education_qualification === $tech_man->highest_education_qualification )selected @endif value="{{ $highest_education_qualification->education_qualification }}">{{ $highest_education_qualification->education_qualification }}</option>
                                   @endforeach
                                </select>
                              </div>

                             <div class="form-group col-md-9">
                                <h4>Qualification</h4>
                                <div class="input-group">
                                    <input type="text" name="qualification" value="{{ old('qualification') ?? $tech_man->qualification ?? '' }}" class="form-control form-control-lg" placeholder="Qualification Eg. Bsc. Hons. in Computer Science" >
                                </div>
                                @if ($errors->has('qualification'))
                                    <div class="error">{{ $errors->first('qualification') }}</div>
                                @endif
                            </div>

                             <div class="form-group col-md-12">
                                <h4>Experience</h4>
                                <div class="input-group">
                                    <textarea name="experience" rows="4" id="experience" class="form-control form-control-lg" required>{{ old('experience') ?? $tech_man->experience ?? '' }}</textarea>
                                </div>
                                @if ($errors->has('experience'))
                                    <div class="error">{{ $errors->first('experience') }}</div>
                                @endif
                            </div>

                            <div class="field form-group col-md-12">
                              <label>Has this Person received a copy of the Home Building Manual?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
                                <br>
                                    <label>
                                      <input type="radio"  name="received_copy" id="received_copy" value="No" set="No" aria-required="true" @if(old('received_copy')=="No" || $tech_man->received_copy == "No" || old('received_copy')==null  )checked @endif>&nbsp;&nbsp;No
                                    </label>
                                    <br>
                                    <label>
                                      <input type="radio"  name="received_copy" id="received_copy"  value="Yes" set="Yes" aria-required="true" @if(old('received_copy')=="Yes" || $tech_man->received_copy == "Yes" )checked @endif>&nbsp;&nbsp;Yes
                                    </label>
                                    <br>
                            </div>


                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update Technical Management</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>
@endsection


@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
    <script src="{{ asset('assets/admin/js/nicEdit-latest.js') }}"></script>

@stop
