@extends('user')


@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/calculation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front')}}/flags/flags.css">
    <link rel="stylesheet" href="{{asset('assets/front')}}/flags/dd.css">
@endsection
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


    <!-- service area start -->
    <section class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title">{{$user->country->name}} Balance </h4>
                            <p>
                                {{number_format($user->balance* $user->country->rate, $basic->decimal)}}  {{$user->country->code}}
                            </p>
                        </div>
                    </div><!-- //. single service item -->
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{route('send.money')}}" class="text-decoration">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title"> Send Money   </h4>
                            <p>Now</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{route('sendingLog')}}" class="text-decoration">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title"> Send Money History  </h4>
                            <p>{{$sendMoney}}</p>
                        </div>
                    </div>
                    </a>
                </div>

                <div class="col-lg-4 col-md-4">
                    <a href="{{route('deposit')}}" class="text-decoration">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title">Payment Gateway</h4>
                            <p>{{$gateway}}</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{route('user.trx')}}" class="text-decoration">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title">Total Transactions</h4>
                            <p>{{$trx}}</p>
                        </div>
                    </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-4">
                    <a href="{{route('user.depositLog')}}" class="text-decoration">
                    <div class="single-service-item">
                        <div class="content">
                            <h4 class="title">Total Deposit </h4>
                            <p>{{$depositLog}} </p>
                        </div>
                    </div>
                    </a>
                </div>


            </div>
        </div>
    </section>
    <!-- service area end -->




@endsection
@section('js')

@endsection
