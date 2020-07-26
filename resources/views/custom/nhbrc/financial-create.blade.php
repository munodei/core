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
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-financial.index') }}">Company Financial Records</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-financial.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Company Financial Records</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('nhbrc-financial.store')}}" name="editForm" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5>Year </h5>
                                <div class="input-group">
                                    <select name="year" class="form-control form-control-lg">
                                        <option>Select Year</option>
                                        @for($year=intval(date("Y"))-3;$year<=intval(date("Y"));$year++)
                                        <option @if(old('year')===$year ) selected @endif value="{{ $year }}">{{ $year }}</option>
                                        @endfor 
                                    </select>
                                </div>
                                @if ($errors->has('year'))
                                    <div class="error">{{ $errors->first('year') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Expected Turn Over </h5>
                                <div class="input-group">
                                    <input type ="number" name="expected_turn_over" class="form-control form-control-lg" value="{{ old('expected_turn_over') }}" required>
                                       
                                </div>
                                @if ($errors->has('expected_turn_over'))
                                    <div class="error">{{ $errors->first('expected_turn_over') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Expected Profit / Loss </h5>
                                <div class="input-group">
                                    <input type ="number" name="expected_profit" class="form-control form-control-lg" value="{{ old('expected_profit') }}" required>                                  
                                </div>
                                @if ($errors->has('expected_profit'))
                                    <div class="error">{{ $errors->first('expected_profit') }}</div>
                                @endif
                            </div>

                            <div class="field form-group col-md-12">
                              <label>Was the Expected Profit or Loss?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
                                <br>
                                    <label>
                                      <input type="radio"  name="expected_profit_or_loss" id="expected_profit_or_loss" value="1" set="1" aria-required="true" @if(old('expected_profit_or_loss')=="1"  )checked @endif @if(old('expected_profit_or_loss')==null) checked @endif>&nbsp;&nbsp;Yes
                                    </label>
                                    <br>
                                    <label>
                                      <input type="radio"  name="expected_profit_or_loss" id="expected_profit_or_loss"  value="0" set="0" aria-required="true" @if(old('expected_profit_or_loss')=="0"  )checked @endif>&nbsp;&nbsp;No
                                    </label>
                                    <br>
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Turn Over </h5>
                                <div class="input-group">
                                    <input type ="number" name="turn_over" class="form-control form-control-lg" value="{{ old('turn_over') }}">
                                       
                                </div>
                                @if ($errors->has('turn_over'))
                                    <div class="error">{{ $errors->first('turn_over') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Profit / Loss </h5>
                                <div class="input-group">
                                    <input type ="number" name="profit" class="form-control form-control-lg" value="{{ old('profit') }}">                                  
                                </div>
                                @if ($errors->has('profit'))
                                    <div class="error">{{ $errors->first('profit') }}</div>
                                @endif
                            </div>

                            <div class="field form-group col-md-12">
                              <label>Was it Profit or Loss?<span style="color:red;" aria-hidden="true">&nbsp;*</span></label>
                                <br>
                                    <label>
                                      <input type="radio"  name="profit_or_loss" id="profit_or_loss" value="1" set="1" aria-required="true" @if(old('profit_or_loss')=="1"  )checked @endif @if(old('profit_or_loss')==null) checked @endif>&nbsp;&nbsp;Yes
                                    </label>
                                    <br>
                                    <label>
                                      <input type="radio"  name="profit_or_loss" id="profit_or_loss"  value="0" set="0" aria-required="true" @if(old('profit_or_loss')=="0"  )checked @endif>&nbsp;&nbsp;No
                                    </label>
                                    <br>
                            </div>





                     



                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save Financial Records</button>
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
