@extends('user')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/print.css')}}">
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

            <div class="row ">
                <div class="col-lg-11">
                    <div class="section-title extra">
                        <div  class="text-left"><img src="{{asset('assets/images/logo/logo.png')}}" alt="logo"></div>
                        <div class="text-right">
                            <p>Date: {{date('d/m/Y')}} </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 offset-md-2">
                    <div class="left-content-wrapper"><!-- left content wrapper -->
                        <div class="card">
                            <div class="card-body text-center">
                                <address><h3 class="green">Your Transaction is confirmed</h3><br>
                                </address>


                                <table class="table table-default table-responsive">
                                    <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                Your {{$basic->sitename}} Transaction No is : <span
                                                    class="red">{{$invoice->trx}}</span>
                                            </strong>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <strong>
                                                You have just sent amount
                                                <span
                                                    class="padding-left-10 red">{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</span>
                                            </strong>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-default table-responsive">
                                    <tbody>
                                    <tr>
                                        <td><h3 class="green">Sender Information</h3></td>
                                    </tr>
                                    <tr>
                                        <td>Name: <strong> {{$invoice->sender_name}}</strong></td>
                                    </tr>

                                    <tr>
                                        <td>Contact No.: <strong>{{$invoice->sender_phone}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Address: <strong>{{$invoice->sender_address}}</strong> </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-default table-responsive">
                                    <tbody>
                                    <tr>
                                        <td><h3 class="green">Recipient Information</h3></td>
                                    </tr>
                                    <tr>
                                        <td>Name: <strong> {{$invoice->name}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Contact No.: <strong>{{$invoice->phone}}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Address: <strong>{{$invoice->address}}</strong> </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h5>Thank you for using {{$basic->sitename}}</h5><br>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div><!-- //.left content wrapper -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 offset-lg-3">
                    <div class="btn-wrapper">
                        <a href="{{route('home')}}" class="boxed-btn btn-rounded"> <i class="fa fa-home"></i> Home</a>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div class="btn-wrapper">
                        <a href="javascript:window.print();" target="_blank" class="boxed-btn btn-rounded"> <i class="fa fa-print"></i> Print</a>
                    </div>
                </div>

            </div>

        </div>

    </section>




@endsection

@section('script')
