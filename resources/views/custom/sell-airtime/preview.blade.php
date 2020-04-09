@extends('merchant-1')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-history"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            @include('errors.alert')
        </div>

        <div class="col-lg-12">



            <form method="POST" action="{{route('sell-airtime-confirm')}}">
                @csrf
                <div class="tile text-center">
                    <h3 class="tile-title">{{$page_title}} </h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3" >
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="{{asset('assets/images/')}}/{{ $network->logo }}"
                                             style="max-width:100px; max-height:100px; margin:0 auto;"/>
                                    </li>
                                    <li class="list-group-item"> Amount : {{ $data['amount'] }}
                                        <strong>{{$basic->currency}}</strong>
                                    </li>
                                    <input type="hidden" name='network_id' value="{{ $network->id }}"/>
                                    <input type="hidden" name='network' value="{{ $network->name }}"/>
                                    <input type="hidden" name='amount' value="{{ $data['amount'] }}"/>
                                    <input type="hidden" name='charge' value="{{ $data['amount'] * (intval($network->percent_charge)/100) + $network->fixed_charge  }}"/>
                                    <input type="hidden" name='amount_to_be_deposited' value="{{ $data['amount'] - ($data['amount'] * (intval($network->percent_charge)/100) + $network->fixed_charge) }}"/>

                                    <li class="list-group-item"> Charge :
                                        <strong>{{ $data['amount'] * (intval($network->percent_charge)/100) + $network->fixed_charge  }} </strong>{{ $basic->currency }}</li>
                                    <li class="list-group-item "> Money Deposited:
                                        <strong>{{ $data['amount'] - ($data['amount'] * (intval($network->percent_charge)/100) + $network->fixed_charge) }} </strong>{{ $basic->currency }}
                                    </li>

                                    <li class="list-group-item "> Airtime Type:
                                      <div class="btn-wrapper">
                                          <select class="form-control" name ='airtime_type' onchange="AirTime(this.value);">
                                            <option value="" >Select Airtime For Sell</option>
                                            <option value="1">Airtime Token</option>
                                            <option value="2">Airtime Transfer</option>
                                          </select>
                                      </div>
                                    </li>

                                    <li class="list-group-item " style="display:none;" id='token'>
                                      <div class="btn-wrapper">
                                        <div class="btn-wrapper">
                                          <div class="row">
                                          <div class="col-sm-12 form-group">
                                            <label class="col-form-label">Enter Token<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control"  name="token" placeholder="Enter Token Number!" value="" />
                                          </div>
                                            </div>
                                        </div>
                                      </div>
                                    </li>

                                    <li class="list-group-item " style="display:none;"  id='transfer'> Transfer:
                                      <div class="btn-wrapper">
                                        <div class="btn-wrapper">
                                          <div class="row">
                                          <div class="col-sm-6 form-group">
                                            <label class="col-form-label">Dial *136*3# to Transfer AirTime to {{ $network->number }} </label>
                                          </div>
                                            </div>
                                        </div>
                                      </div>
                                    </li>

                                    <li class="list-group-item ">
                                      <div class="btn-wrapper">
                                        <div class="row">
                                        <div class="col-sm-6 form-group">
                                          <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                                          <input type="number" class="form-control"  name="phone" id="phone" placeholder="Contact Number" value="{{ auth()->user()->phone }}" />
                                        </div>

                                        <div class="col-sm-6 form-group">
                                          <label class="col-form-label">Is phone number on WhatsApp?<span class="text-danger">*</span></label>
                                            <div class="checkbox">
                                              <input type="checkbox" name="is_whatsapp" id="chekcbox2" checked value="1">
                                              <label for="chekcbox2"><span class="checkbox-icon"></span> </label>
                                            </div>
                                        </div>
                                      </div>
                                      </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="btn-wrapper">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" id="btn-confirm" value="Redeem">
                                        </div>
                                    </li>

                                </ul>
                                <br><br>
                            </div>
                        </div>


                    </div>
                </div>

            </form>


        </div>
    </div>

@stop
@section('script')
<script>
 function AirTime(id){
   if(id==1)
   {

     $('#transfer').css("display", "none");
     $('#token').css("display", "block");

   }
   if(id==2)
   {

     $('#transfer').css("display", "block");
     $('#token').css("display", "none");

   }
 }
</script>

@endsection
