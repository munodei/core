@extends('bills')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-history"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{ route('bills.index') }}">Saved Bills</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            @include('errors.alert')
        </div>

        <div class="col-lg-12">


            <form method="POST" action="{{route('bill.payment.confirm')}}">
                @csrf
                <div class="tile text-center">
                    <h3 class="tile-title">{{$page_title}} </h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3" >
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="{{ $data->biller->biller_image }}"
                                             style="max-width:100px; max-height:100px; margin:0 auto;"/>
                                    </li>
                                    <li class="list-group-item"> Amount : {{ $amount }}
                                        <strong>{{$basic->currency}}</strong>
                                    </li>



                                    <li class="list-group-item"> Charge :
                                        <strong>{{ $charge }} </strong>{{ $basic->currency }}</li>
                                    <li class="list-group-item "> Payable :
                                        <strong>{{$charge + $amount}} </strong>{{ $basic->currency }}</li>


                                    <li class="list-group-item">
                                        <div class="btn-wrapper">
                                            <input type="submit" class="btn btn-primary btn-lg btn-block" id="btn-confirm" value="Pay Now">
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



@endsection
