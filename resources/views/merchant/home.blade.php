@extends('merchant')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-home"></i> {{isset($page_title)? $page_title : ''}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{isset($page_title)? $page_title : ''}}</a></li>
        </ul>
    </div>


    <div class="tile mb-4">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="tile-title"><i class="fa fa-history"></i>  Statistics</h3>
            </div>
        </div>
        <div class="row card-body">

            <div class="col-lg-4">

                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-info  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>{{$user->country->name}} Balance</h3>
                                    <h5>
                                        {{number_format($user->balance, $basic->decimal)}} {{$basic->currency}} =
                                        {{number_format($user->balance* $user->country->rate, $basic->decimal)}}  {{$user->country->code}}</h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="col-lg-4">
                <a href="{{route('sendingLog')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-dark  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Total Send Money</h3>
                                    <h5>{{$sendMoney}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-4">
                <a href="{{route('withdrawLog')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-success  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Total Payout</h3>
                                    <h5>{{$payout}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-lg-4">
                <a href="{{route('deposit')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-dark  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Payment Gateway</h3>
                                    <h5>{{$gateway}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-4">
                <a href="{{route('user.trx')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-info  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Total Transactions</h3>
                                    <h5>{{$trx}}</h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4">
                <a href="{{route('user.depositLog')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-danger  text-center">

                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Total Deposit </h3>
                                    <h5>{{$depositLog}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@stop
