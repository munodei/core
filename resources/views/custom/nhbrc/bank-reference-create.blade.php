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
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-bank-reference.index') }}">Company Bank References</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-bank-reference.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Bank Reference</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('nhbrc-bank-reference.store')}}" name="editForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">



                            <div class="form-group col-md-3">
                                <h5>Bank</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('bank')  }}" class="form-control form-control-lg" placeholder="Bank e.g FNB" name="bank" required>
                                </div>
                                @if ($errors->has('bank'))
                                    <div class="error">{{ $errors->first('bank') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Branch Code</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('branch') }}" class="form-control form-control-lg" placeholder="Branch Code" name="branch" required>
                                </div>
                                @if ($errors->has('branch'))
                                    <div class="error">{{ $errors->first('branch') }}</div>
                                @endif
                            </div>
                     
                            <div class="form-group col-md-3">
                                <h5>Clearing Number</h5>
                                <div class="input-group">
                                    <input type="text" name="clearing_number" value="{{ old('clearing_number') }}" class="form-control form-control-lg" placeholder="Clearing Number" >
                                </div>
                                @if ($errors->has('clearing_number'))
                                    <div class="error">{{ $errors->first('clearing_number') }} </div>
                                @endif                           
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Swift Code</h5>
                                <div class="input-group">
                                    <input type="text" name="swift_code" value="{{ old('swift_code') }}" class="form-control form-control-lg" placeholder="Swift Code" required >
                                </div>
                                @if ($errors->has('swift_code'))
                                    <div class="error">{{ $errors->first('swift_code') }} </div>
                                @endif                           
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Account Number 1</h5>
                                <div class="input-group">
                                    <input type="text" name="account_number1" value="{{ old('account_number1') }}" class="form-control form-control-lg" placeholder="Company Account Number 1" required >
                                </div>
                                @if ($errors->has('vat_reg_number'))
                                    <div class="error">{{ $errors->first('vat_reg_number') }}</div> 
                                @endif
                            </div>

                
                            <div class="form-group col-md-6">
                                <h5>Account Type 1</h5>
                                <div class="input-group">
                                    <select name="account_type1" id="account_type1" class="form-control form-control-lg" required>
                                            <option @if(old('account_type1')=="")             selected @endif value="" >Select Account Type</option>
                                            <option @if(old('account_type1')=="Cheque")       selected @endif value="Cheque">Cheque</option>
                                            <option @if(old('account_type1')=="Saving")       selected @endif value="Saving">Saving</option>
                                            <option @if(old('account_type1')=="Transmission") selected @endif value="Transmission">Transmission</option>
                                            <option @if(old('account_type1')=="Business")     selected @endif value="Business">Business</option>
                                            <option @if(old('account_type1')=="Merchant")     selected @endif value="Merchant">Merchant</option>
                                    </select>
                                </div>
                                @if ($errors->has('account_type1'))
                                    <div class="error">{{ $errors->first('account_type1') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Account Number 2</h5>
                                <div class="input-group">
                                    <input type="text" name="account_number2" value="{{ old('account_number2') }}" class="form-control form-control-lg" placeholder="Account Number 2" >
                                </div>
                                @if ($errors->has('account_number2'))
                                    <div class="error">{{ $errors->first('account_number2') }}</div> 
                                @endif
                            </div>

                
                            <div class="form-group col-md-6">
                                <h5>Account Type 2</h5>
                                <div class="input-group">
                                     <select name="account_type2" id="account_type2" class="form-control form-control-lg">
                                            <option @if(old('account_type2')=="")             selected @endif value=""            >Select Account Type</option>
                                            <option @if(old('account_type2')=="Cheque")       selected @endif value="Cheque"      >Cheque             </option>
                                            <option @if(old('account_type2')=="Saving")       selected @endif value="Saving"      >Saving             </option>
                                            <option @if(old('account_type2')=="Transmission") selected @endif value="Transmission">Transmission       </option>
                                            <option @if(old('account_type2')=="Business")     selected @endif value="Business"    >Business           </option>
                                            <option @if(old('account_type2')=="Merchant")     selected @endif value="Merchant"    >Merchant           </option>
                                    </select>
                                </div>
                                @if ($errors->has('account_type2'))
                                    <div class="error">{{ $errors->first('account_type2') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-6">
                                <h5>Name of Manager</h5>
                                <div class="input-group">
                                    <input type="text" name="account_manager" value="{{old('account_manager')}}" class="form-control form-control-lg" placeholder="Name of Manager" required>
                                </div>
                                @if ($errors->has('account_manager'))
                                    <div class="error">{{ $errors->first('account_manager') }}</div>
                                @endif
                            </div>


                            <div class="form-group col-md-6">
                                <h5>Telephone Number</h5>
                                <div class="input-group">
                                    <input type="text" name="tel_number" value="{{old('tel_number')}}" class="form-control form-control-lg" placeholder="Telephone Number" required>
                                </div>
                                @if ($errors->has('tel_number'))
                                    <div class="error">{{ $errors->first('tel_number') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h4>Fax Number</h4>
                                <div class="input-group">
                                    <input type="text" name="fax_number" value="{{old('fax_number')}}" class="form-control form-control-lg" placeholder="Fax Number" required>
                                </div>
                                @if ($errors->has('fax_number'))
                                    <div class="error">{{ $errors->first('fax_number') }}</div>
                                @endif
                            </div>

                             <div class="form-group col-md-6">
                                <h4>Email</h4>
                                <div class="input-group">
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control form-control-lg" placeholder="Email" required>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Company Bank Reference</button>
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
