@extends('user')
@section('css')
@stop
@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg white-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <h1 class="title">{{$page_title}}</h1>
                    </div><!-- //.breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <section class="faq-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-wrapper"><!-- left content wrapper -->
                            <div class="card">
                                    <div class="card-body">
                                        <h5 class="body-heading">Sending From: </h5>

                                        <address><h4>{{$sendMoney->fromCurrency->name}}</h4>
                                            <h6>Amount: <span class="padding-left-10 red">{{number_format($sendMoney->from_currency_amo, $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span></h6>
                                            <h6>Charge: <span class="padding-left-10 red">{{number_format(($sendMoney->usd_charge*$sendMoney->fromCurrency->rate), $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span></h6>
                                            <br>
                                            <h5>Total Payable : <span class="padding-left-10 red"> {{number_format($totalPayable, $basic->decimal)}} {{$sendMoney->fromCurrency->code}}</span> </h5></address>
                                    </div>
                            </div>

                    </div><!-- //.left content wrapper -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-wrapper"><!-- right content wrapper -->
                        <div class="card">
                            <div class="card-body">
                                <h5 class="body-heading">Receive From:</h5>

                                <address><h4>{{$sendMoney->toCurrency->name}}</h4>
                                    <div class="margin-bottom-60"></div>
                                    <br>
                                    <h5>Receiver Gets In: <strong class="padding-left-10 red"> {{number_format($sendMoney->to_currency_amo, $basic->decimal)}} {{$sendMoney->toCurrency->code}}</strong> </h5></address>
                            </div>
                        </div>
                    </div><!-- //.right content wrappper -->
                </div>
            </div>

        </div>



        <div class="container contact-page-container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 class="title">Recipient Contact Information</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-page-inner"><!-- contact page inner -->
                        <form action="{{route('send.confirm')}}" method="post" id="get_in_touch" class="contact-form">.
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-element margin-bottom-30">
                                        <input type="hidden" value="{{$sendMoney->id}}" name="id">
                                        <label for="name" class="label">Sender Name *</label>
                                        <input type="text" name="sender_name" id="sender_name" class="input-field" placeholder="Sender  name">

                                        @if ($errors->has('sender_name'))
                                            <strong class="error">{{ $errors->first('sender_name') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-element margin-bottom-30">
                                        <label for="email" class="label">Sender Phone *</label>
                                        <input type="text" name="sender_phone"  id="sender_phone" class="input-field" placeholder="Sender Contact Number">

                                        @if ($errors->has('sender_phone'))
                                            <strong class="error">{{ $errors->first('sender_phone') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-element textarea margin-bottom-30">
                                        <label for="address" class="label">Sender Address </label>
                                        <textarea name="sender_address" id="sender_address"   placeholder="Sender address" class="input-field textarea"  rows="10"></textarea>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="form-element margin-bottom-30">
                                        <label for="name" class="label">Recipient  Name *</label>
                                        <input type="text" name="name" id="name" class="input-field" placeholder=" Recipient  Name">

                                        @if ($errors->has('name'))
                                            <strong class="error">{{ $errors->first('name') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-element margin-bottom-30">
                                        <label for="email" class="label">Recipient  Phone *</label>
                                        <input type="text" name="phone"  id="phone" class="input-field" placeholder=" Recipient  Contact Number">

                                        @if ($errors->has('phone'))
                                            <strong class="error">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>

                                    <div class="form-element textarea margin-bottom-30">
                                        <label for="address" class="label">Recipient  Address </label>
                                        <textarea name="address" id="address"   placeholder="Recipient  address" class="input-field textarea"  rows="10"></textarea>
                                    </div>

                                </div>


                                <div class="col-lg-12">
                                    @if($sendMoney->status == 0)
                                        <input type="submit" class="submit-btn" value="Confirm">
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div><!-- //.contact page inner -->
                </div>
            </div>
        </div>
    </section>





@endsection

@section('script')
