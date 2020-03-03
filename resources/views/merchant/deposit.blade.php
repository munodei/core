@extends('merchant')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> Deposit Money</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Deposit Money</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            @include('errors.alert')
        </div>
        @foreach($gates as $gate)
            <div class="col-md-3">
                <div class="tile text-center">
                    <h3 class="tile-title">{{$gate->name}} </h3>
                    <div class="tile-body">
                        <img class="card-img-top"
                             src="{{asset('assets/images/gateway')}}/{{$gate->id.'.jpg'}}"
                             alt="image">
                    </div>
                    <div class="tile-footer">
                        <button data-toggle="modal"
                                data-target="#depositModal{{$gate->id}}"
                                class="btn btn-primary btn-block">Select
                        </button>
                    </div>
                </div>

                <div class="modal fade" id="depositModal{{$gate->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Deposit via <strong>{{$gate->name}}</strong></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="{{route('deposit.data-insert')}}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="gateway" value="{{$gate->id}}">
                                    <label><strong>DEPOSIT AMOUNT</strong>
                                        <span class="modal-msg">({{ $gate->minamo }} - {{$gate->maxamo }}
                                            ) {{$basic->currency}}
                                            <br>
                                               <code
                                                   class="font-weight-bold">Charged {{ $gate->fixed_charge }} {{$basic->currency}}
                                                   + {{ $gate->percent_charge }}%</code>
                                        </span>
                                    </label>
                                    <hr/>

                                    <div class="input-group input-group-lg mb-3">

                                        <input type="text" class="form-control " name="amount" placeholder="0.00"
                                               aria-label="amount"
                                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                               placeholder=" Enter Amount" required>
                                        <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                      id="basic-addon1">{{$basic->currency}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success ">Preview</button>
                                    <button type="button" class="btn btn-danger " data-dismiss="modal">Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    </div>
@stop
