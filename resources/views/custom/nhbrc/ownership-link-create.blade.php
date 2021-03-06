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
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-ownership-links.index') }}">Company Directors Ownership Links</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-ownership-links.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Company Director Ownership Link</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('nhbrc-ownership-links.store')}}" name="editForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5>Director </h5>
                                <div class="input-group">
                                    <select name="director_id" class="form-control form-control-lg">
                                        <option>Select Director</option>
                                        @foreach($directors as $director)
                                        <option @if(old('director_id')==='' ) selected @endif value="{{ $director->id }}">{{ $director->title }} {{ $director->intials }} {{ $director->surname }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @if ($errors->has('director_id'))
                                    <div class="error">{{ $errors->first('director_id') }}</div>
                                @endif
                            </div>

                             <div class="form-group col-md-12">
                                <h5>Company Ownership Link</h5>
                                <div class="input-group">
                                    <select name="company_id" class="form-control form-control-lg">
                                        <option>Select Company</option>
                                        @foreach($companies as $co)
                                        <option @if(old('company_id')==='' ) selected @endif value="{{ $co->id }}">{{ $co->company_name }} ({{ $co->company_reg_number }}) ({{ $co->bargain_council_registration_number }})</option>
                                        @endforeach 
                                    </select>
                                </div>
                                @if ($errors->has('company_id'))
                                    <div class="error">{{ $errors->first('company_id') }}</div>
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
                     
                            <div class="form-group col-md-6">
                                <h5>Company Reg. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="company_reg_number" value="{{ old('company_reg_number') }}" class="form-control form-control-lg" placeholder="Company Reg. Number" >
                                </div>
                                @if ($errors->has('company_reg_number'))
                                    <div class="error">{{ $errors->first('company_reg_number') }}
                                @endif       
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Company Vat. Number</h5>
                                <div class="input-group">
                                    <input type="text" name="vat_reg_number" value="{{ old('vat_reg_number') }}" class="form-control form-control-lg" placeholder="Company Vat. Number" >
                                </div>
                                @if ($errors->has('vat_reg_number'))
                                    <div class="error">{{ $errors->first('vat_reg_number') }}</div> 
                                @endif
                            </div>

                
                            <div class="form-group col-md-6">
                                <h5>Bargain Council Registration Number</h5>
                                <div class="input-group">
                                    <input type="text" name="email" value="{{old('bargain_council_registration_number')}}" class="form-control form-control-lg" placeholder="Email">
                                </div>
                                @if ($errors->has('bargain_council_registration_number'))
                                    <div class="error">{{ $errors->first('bargain_council_registration_number') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Contact Number </h5>
                                <div class="input-group">
                                    <input type="text" name="contact_number" value="{{old('contact_number')}}" class="form-control form-control-lg" placeholder="Contact Number" >
                                </div>
                                @if ($errors->has('contact_number'))
                                    <div class="error">{{ $errors->first('contact_number') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h4>Email</h4>
                                <div class="input-group">
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control form-control-lg" placeholder="Contact Email" >
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Company Director Ownership Link</button>
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
