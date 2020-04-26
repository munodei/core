@extends('merchant-1')
@section('css')
@stop
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Transfer Money</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Transfer Money</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title"> Transfer Money</h3>

                <section class="invoice tile-body">

                    <div class="row invoice-info">
                        <div class="col-4 offset-md-2"><strong>Transferring From:</strong>
                            <address><h4>{{$sendMoney->fromCurrency->name}}</h4><br>
                                <h6>Amount: <span class="padding-left-10 red">{{number_format($sendMoney->from_currency_amo, $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span></h6>
                                <h6>Charge: <span class="padding-left-10 red">{{number_format(($sendMoney->usd_charge*$sendMoney->fromCurrency->rate), $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span></h6>
                                <br>
                                <h5>Total Payable : <span class="padding-left-10 red"> {{number_format($totalPayable, $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span> </h5></address>
                        </div>
                        <div class="col-4"><strong>Receive From:</strong>
                            <address><h4>{{$sendMoney->toCurrency->name}}</h4><br>
                                <h5>Receiver Gets In: <strong class="padding-left-10 red"> {{number_format($sendMoney->to_currency_amo, $basic->decimal)}} {{$sendMoney->toCurrency->code}}</strong> </h5></address>
                        </div>
                    </div>

                    <br><br>

                    <form action="{{route('transfer.confirm')}}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-5 offset-md-1 ">
                                <h3 class="tile-title">Sender  Information</h3>
                                <div class="row">

                                    <div class="form-group col-md-12">
                                        <input type="hidden" value="{{$sendMoney->id}}" name="id">
                                        <label for="name" ><strong>Name</strong></label>
                                        <input class="form-control form-control-lg" name="sender_name"  type="text"  placeholder="Sender Name ..." value="{{ auth()->user()->email }}" disabled>
                                        <small class="form-text text-muted" >Name must be fill up.</small>

                                        @if ($errors->has('sender_name'))
                                            <strong class="error">{{ $errors->first('sender_name') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Username</strong></label>
                                        <input class="form-control form-control-lg" name="sender_username"  type="text"  placeholder="Enter  Sender Username ..." value="{{ auth()->user()->username }}" disabled>
                                        <small class="form-text text-muted" >Enter A Username</small>

                                        @if ($errors->has('sender_username'))
                                            <strong class="error">{{ $errors->first('sender_username') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Merchant Code</strong></label>
                                        <input type="number" name="sender_merchant_code" id="sender_merchant_code"  class="form-control form-control-lg" rows="5" placeholder="Merchant Code" value="{{ auth()->user()->merchant_identity }}" disabled>
                                        @if ($errors->has('sender_merchant_code'))
                                            <strong class="error">{{ $errors->first('sender_merchant_code') }}</strong>
                                        @endif
                                    </div>


                                </div>
                        </div>

                        <div class="col-md-5  ">
                            <h3 class="tile-title">Recipient Contact Information</h3>
                                <div class="row">

                                    <div class="form-group col-md-12">

                                        <label for="name" ><strong>Recipient Email</strong></label>
                                        <input class="form-control form-control-lg" name="recipient_email" id="recipient_email" type="text"  placeholder="Enter Recipient Email ..." required autocomplete="off" value="{{ old('recipient_email') }}">
                                        <small class="form-text text-muted" >If name does show in the drop down add it in your contacts!</small>

                                        @if ($errors->has('recipient_email'))
                                            <strong class="error">{{ $errors->first('recipient_email') }}</strong>
                                        @endif

                                    </div>

                                    <div class="form-group col-md-12">

                                        <label for="name" ><strong>Recipent Username</strong></label>
                                        <input class="form-control form-control-lg" name="recipient_username" id="recipient_username" type="text"  placeholder="Enter  Recipient Username ..."  value="{{ old('recipient_username') }}">
                                        <small class="form-text text-muted"> Username must be added.</small>

                                        @if ($errors->has('phone'))
                                            <strong class="error">{{ $errors->first('recipient_username') }}</strong>
                                        @endif

                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Recipent Merchant Code</strong></label>
                                        <input type="number" name="recipient_merchant_code"  class="form-control form-control-lg" rows="5" placeholder="Recipent Merchant Code" value="{{ old('receiver_merchant_code') }}">
                                    </div>


                                </div>
                        </div>


                        <div class="col-md-10 offset-md-1 ">
                        @if($sendMoney->status == 0)
                                <button type="submit" class="btn btn-block btn-lg btn-primary">Confirm</button>

                        @endif
                        <br><br>
                        </div>



                    </div>
                    </form>
                </section>
            </div>
        </div>
    </div>


@endsection

@section('script')
