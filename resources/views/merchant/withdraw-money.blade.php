@extends('merchant')
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
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">Payout Form</h3>
                </div>
                <div class="tile-body">

                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            @include('errors.error')

                            <form action="{{route('withdraw.trxCheck')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <h4>Transaction Number :</h4>
                                    <input type="text" name="trx" class="form-control form-control-lg"
                                           placeholder="Enter Transaction / Slip Number " autocomplete="off">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-lg btn-block btn-primary" type="submit">Submit</button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
