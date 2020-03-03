@extends('merchant')
@section('css')
@stop
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Send Money</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Send Money</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title"> Send Money</h3>

                <section class="invoice tile-body">
  
                    <div class="row invoice-info">
                        <div class="col-4 offset-md-2"><strong>Sending From:</strong>
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

                    <form action="{{route('send.confirm')}}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-5 offset-md-1 ">
                                <h3 class="tile-title">Sender  Information</h3>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <input type="hidden" value="{{$sendMoney->id}}" name="id">
                                        <label for="name" ><strong>Name</strong></label>
                                        <input class="form-control form-control-lg" name="sender_name"  type="text"  placeholder="Sender Name ...">
                                        <small class="form-text text-muted" >Name must be fill up.</small>

                                        @if ($errors->has('sender_name'))
                                            <strong class="error">{{ $errors->first('sender_name') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Phone</strong></label>
                                        <input class="form-control form-control-lg" name="sender_phone"  type="text"  placeholder="Enter  Sender Number ...">
                                        <small class="form-text text-muted" >Phone Number  must be fill up.</small>

                                        @if ($errors->has('sender_phone'))
                                            <strong class="error">{{ $errors->first('sender_phone') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Address</strong></label>
                                        <textarea name="sender_address"  class="form-control form-control-lg" rows="5" placeholder="Sender Address"></textarea>
                                    </div>


                                </div>
                        </div>

                        <div class="col-md-5  ">
                            <h3 class="tile-title">Recipient Contact Information</h3>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Name</strong></label>
                                        <input class="form-control form-control-lg" name="name" id="name" type="text"  placeholder="Enter  Recipient Name ...">
                                        <small class="form-text text-muted" >Name must be fill up.</small>

                                        @if ($errors->has('name'))
                                            <strong class="error">{{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Phone</strong></label>
                                        <input class="form-control form-control-lg" name="phone" id="phone" type="text"  placeholder="Enter  Recipient Number ...">
                                        <small class="form-text text-muted" >Phone Number  must be fill up.</small>

                                        @if ($errors->has('phone'))
                                            <strong class="error">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="name" ><strong>Address</strong></label>
                                        <textarea name="address" id="address" class="form-control form-control-lg" rows="5" placeholder="Recipient Address"></textarea>
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
