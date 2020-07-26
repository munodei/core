@extends('bills')

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
        <li class="breadcrumb-item active"><a href="{{ route('bills.index') }}">Save Bills</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('bills.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Bill</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('bills.update',$bill)}}" name="editForm" enctype="multipart/form-data">
                        @csrf

                           {{ method_field('put') }}
                        <div class="row">

                          <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}"/>

                            <div class="form-group col-md-6">
                                <h5>Biller /Merchant</h5>
                                <div class="input-group">
                                    <select name="biller_id" class="form-control form-control-lg">
                                        <option @if(old('biller_id') ==='' ) selected @endif value="">Select Biller/Merchant</option>
                                          @foreach($billers as $biller)
                                            <option @if($biller->id ===old('biller_id') || $biller->id === $bill->biller_id ) selected @endif value="{{ $biller->id }}"> {{ $biller->biller_name }} ({{ $biller->country->name }})</option>
                                          @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('biller_id'))
                                    <div class="error">{{ $errors->first('biller_id') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>Currency</h5>
                                <div class="input-group">
                                    <select name="currency" class="form-control form-control-lg">
                                        <option @if(old('currency')==='' ) selected @endif value="">Select Currency</option>
                                          @foreach($countries as $country)
                                            <option @if($country->code ===old('currency') || $bill->currency === $country->code ) selected @endif value="{{ $country->code }}"> {{ $country->name }} ({{ $country->code }})</option>
                                          @endforeach
                                    </select>
                                </div>
                                @if ($errors->has('currency'))
                                    <div class="error">{{ $errors->first('currency') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Name on Bill</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('bill_owner') ?? $bill->bill_owner ?? '' }}" class="form-control form-control-lg" placeholder="Name on Bill" name="bill_owner">
                                </div>
                                @if ($errors->has('bill_owner'))
                                    <div class="error">{{ $errors->first('bill_owner') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Bill Account Number</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('bill_account_number') ?? $bill->bill_account_number ?? '' }}" class="form-control form-control-lg" placeholder="Bill Account Number" name="bill_account_number">
                                </div>
                                @if ($errors->has('bill_account_number'))
                                    <div class="error">{{ $errors->first('bill_account_number') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Bill</button>
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
