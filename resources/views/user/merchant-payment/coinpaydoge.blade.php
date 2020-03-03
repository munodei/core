@extends('merchant')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> {{$page_title}} </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}} </a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="tile">
                <h3 class="tile-title">{{$page_title}} </h3>
                <div class="title-body text-center">
                    <h3 class="text-color"> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> DOGE</h3>
                    <h5>TO <span style="color: green"> {{ $wallet}}</span></h5>
                    <span>{!! $qrurl !!}</span>
                    <h4 class="text-color" style="font-weight:bold;">SCAN TO SEND </h4>

                    <br><br>
                </div>
            </div>
        </div>
    </div>


@endsection
