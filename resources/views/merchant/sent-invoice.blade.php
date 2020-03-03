@extends('merchant')
@section('css')
@stop
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Send Invoice</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Send Invoice</a></li>
        </ul>
    </div>







                        <div class="col-md-6 offset-md-3">
                            <div class="tile">
                                <h3 class="tile-title green">Your Transaction is confirmed</h3>
<div class="tile-body">



                    <div class="row">
                        <div class="col-6">
                            <h2 class="page-header">
                                <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" style="width: 100%;">
                            </h2>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Date: {{date('d/m/Y')}}</h5>
                        </div>
                    </div>


                                <table class="table">
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
                                               You have just sent
                                               <span
                                                   class="padding-left-10 red">{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</span>
                                           </strong>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>

                                <h5 class="green">Sender Information</h5>
                                <table class="table">
                                    <tbody>
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

                                <h5 class="green">Recipient Information</h5>
                                <table class="table">
                                    <tbody>
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




                    </div>

                    <div class="row d-print-none mt-2">
                        <div class="col-12 ">
                            <a href="{{route('home')}}" class="btn btn-primary text-left"><i class="fa fa-home"></i>
                                Home</a>

                            <a class="btn btn-primary text-right" href="javascript:window.print();" target="_blank"><i
                                    class="fa fa-print"></i> Print</a>
                        </div>
                    </div>




@endsection

@section('script')

@endsection
