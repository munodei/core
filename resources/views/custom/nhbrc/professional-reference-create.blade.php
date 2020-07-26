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
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-professional-references.index') }}">Company Professional References</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-professional-references.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Company Professional Reference</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('nhbrc-professional-references.store')}}" name="createClientReference" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">

                           <div class="form-group col-md-3">
                                <h5>Title</h5>
                                <div class="input-group">
                                    <select name="title" class="form-control form-control-lg">
                                        <option @if(old('title')==='' ) selected @endif value="">Select Title</option>
                                        <option @if(old('title')==='Mr.' ) selected @endif value="Mr.">Mr.</option>
                                        <option @if(old('title')==='Dr.') selected @endif value="Dr.">Dr.</option>
                                        <option @if(old('title')==='Miss.') selected @endif value="Miss.">Miss.</option>
                                        <option @if(old('title')==='Mrs.') selected @endif value="Mrs.">Mrs.</option>
                                        <option @if(old('title')==='Prof.') selected @endif value="Prof.">Prof.</option>
                                        <option @if(old('title')==='Lit.') selected @endif value="Lit.">Lit.</option>
                                        <option @if(old('title')==='Gen.' ) selected @endif value="Gen.">Gen.</option>
                                        <option @if(old('title')==='Cde.') selected @endif value="Cde.">Cde.</option>
                                        <option @if(old('title')==='Sir.') selected @endif value="Sir.">Sir.</option>
                                        <option @if(old('title')==='Eng.') selected @endif value="Eng.">Eng.</option>
                                    </select>
                                </div>
                                @if ($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">

                            <div class="form-group col-md-3">
                                <h5>Intials</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('initials') }}" class="form-control form-control-lg" placeholder="Director initials" name="initials">
                                </div>
                                @if ($errors->has('initials'))
                                    <div class="error">{{ $errors->first('initials') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Surname</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('surname') ?? $directors->surname ?? '' }}" class="form-control form-control-lg" placeholder="Surname" name="surname">
                                </div>
                                @if ($errors->has('surname'))
                                    <div class="error">{{ $errors->first('surname') }}</div>
                                @endif
                            </div>
                     


                            <div class="form-group col-md-3">
                                <h5> Company</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('company')  }}" class="form-control form-control-lg" placeholder="Company" name="company">
                                </div>
                                @if ($errors->has('company'))
                                    <div class="error">{{ $errors->first('company') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Trading Name</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('trading_name') }}" class="form-control form-control-lg" placeholder="Trading Name" name="trading_name">
                                </div>
                                @if ($errors->has('trading_name'))
                                    <div class="error">{{ $errors->first('trading_name') }}</div>
                                @endif
                            </div>
                     
                            <div class="form-group col-md-3">
                                <h5>Company Reg. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="company_reg_number" value="{{ old('company_reg_number') }}" class="form-control form-control-lg" placeholder="Company Reg. Number" >
                                </div>
                                @if ($errors->has('company_reg_number'))
                                    <div class="error">{{ $errors->first('company_reg_number') }}
                                @endif       
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Company Vat. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="vat_reg_number" value="{{ old('vat_reg_number') }}" class="form-control form-control-lg" placeholder="Company Vat. Number" >
                                </div>
                                @if ($errors->has('vat_reg_number'))
                                    <div class="error">{{ $errors->first('vat_reg_number') }}</div> 
                                @endif
                            </div>     

                            <div class="form-group col-md-4">
                                <h5>Mobile Number </h5>
                                <div class="input-group">
                                    <input type="text" name="mobile_number" value="{{old('mobile_number')}}" class="form-control form-control-lg" placeholder="Mobile Number" >
                                </div>
                                @if ($errors->has('mobile_number'))
                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <h5>Work Number </h5>
                                <div class="input-group">
                                    <input type="text" name="work_number" value="{{old('work_number')}}" class="form-control form-control-lg" placeholder="Work Number" >
                                </div>
                                @if ($errors->has('work_number'))
                                    <div class="error">{{ $errors->first('work_number') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-4">
                                <h4>Email</h4>
                                <div class="input-group">
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-lg" placeholder="Contact Email" >
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-8">
                                <h4>Physical Address</h4>
                                <div class="input-group">
                                    <input type="text" name="physical_address" value="{{old('physical_address')}}" class="form-control form-control-lg" placeholder="Physical Address" >
                                </div>
                                @if ($errors->has('physical_address'))
                                    <div class="error">{{ $errors->first('physical_address') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <h4>Physical Town</h4>
                                <div class="input-group">
                                    <input type="text" name="physical_town" value="{{old('physical_town')}}" class="form-control form-control-lg" placeholder="Physical Town" >
                                </div>
                                @if ($errors->has('physical_town'))
                                    <div class="error">{{ $errors->first('physical_town') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-7">
                                <h4>Postal Address</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_address" value="{{old('postal_address')}}" class="form-control form-control-lg" placeholder="Postal Address" >
                                </div>
                                @if ($errors->has('postal_address'))
                                    <div class="error">{{ $errors->first('postal_address') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h4>Postal Town</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_town" value="{{old('postal_town')}}" class="form-control form-control-lg" placeholder="Postal Town" >
                                </div>
                                @if ($errors->has('postal_town'))
                                    <div class="error">{{ $errors->first('postal_town') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-2">
                                <h4>Postal Code</h4>
                                <div class="input-group">
                                    <input type="text" name="postal_code" value="{{old('postal_code')}}" class="form-control form-control-lg" placeholder="Postal Code" >
                                </div>
                                @if ($errors->has('postal_code'))
                                    <div class="error">{{ $errors->first('postal_code') }}</div>
                                @endif
                            </div>

                            <div class="field form-group col-md-3">
                                <label for="highest_education_qualification">Highest Education Qualification <span style="color:red;" aria-hidden="true">*</span></label>
                                  <select class="form-control" name="highest_education_qualification" id="highest_education_qualification" required>
                                   @foreach($highest_education_qualifications as $highest_education_qualification)
                                      <option @if(old('highest_education_qualification')===$highest_education_qualification->id )selected @endif value="{{ $highest_education_qualification->id }}">{{ $highest_education_qualification->education_qualification }}</option>
                                   @endforeach
                                </select>
                              </div>

                             <div class="form-group col-md-9">
                                <h4>Qualification</h4>
                                <div class="input-group">
                                    <input type="text" name="qualification" value="{{old('qualification')}}" class="form-control form-control-lg" placeholder="Qualification. Eg. Bsc. Hons. in Computer Science" >
                                </div>
                                @if ($errors->has('qualification'))
                                    <div class="error">{{ $errors->first('qualification') }}</div>
                                @endif
                            </div>


                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Professional Reference</button>
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
