@extends('merchant-1')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
        </div>

        <div class="col-lg-12">



            <form method="POST" action="{{route('withdrawal-requests.store')}}">
                @csrf
                <div class="tile text-center">
                    <h3 class="tile-title">{{$page_title}} </h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3" >
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="{{asset('assets/images/')}}/{{ $method->image }}"
                                             style="max-width:100px; max-height:100px; margin:0 auto;"/>
                                    </li>
                                    <li class="list-group-item "  id='transfer'> Balance:
                                      <strong>
                                        {{ auth()->user()->balance }}{{ $basic->currency }}
                                      </strong>
                                    </li>
                                    <li class="list-group-item "  id='transfer'> Charges:
                                      <strong>
                                        {{ $method->percent }} % + {{ $basic->currency }}{{ $method->charge }}
                                      </strong>
                                    </li>
                                    <li class="list-group-item "  id='transfer'> Min Withdrawal:
                                      <strong>
                                        {{ $method->withdraw_min }}{{ $basic->currency }}</strong> &nbsp;  Max Withdrawal: <strong>{{ $method->withdraw_max }}{{ $basic->currency }}</strong>

                                    </li>
                                    <input type="hidden" name="method" value="{{ $method->id }}"/>
                                    <li class="list-group-item">
                                      <div class="btn-wrapper">
                                        <div class="btn-wrapper">
                                          <div class="row">
                                          <div class="col-sm-12 form-group">
                                            <label class="col-form-label">Enter Amount<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control"  name="amount" placeholder="Amount in {{ $basic->currency }}!" value="" autocomplete="off" required/>
                                          </div>
                                            </div>
                                        </div>
                                      </div>
                                    </li>

                                    <li class="list-group-item ">
                                      <div class="btn-wrapper">
                                        <div class="row">
                                        <div class="col-sm-6 form-group">
                                          <label class="col-form-label">Phone Number To E-Wallet <span class="text-danger">*</span></label>
                                          <select class="form-control" name="phone">
                                            @foreach($contacts as $contact)
                                            <option @if($contact->mobilephone === auth()->user()->phone) selected @endif value="{{ $contact->mobilephone }}">{{ $contact->firstname }} ({{ $contact->mobilephone }})</option>
                                            @endforeach()
                                          </select>
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
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" id="btn-confirm" value="Request Withdraw">
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


@endsection
