@extends('merchant')
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-history"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            @include('errors.alert')
        </div>

        <div class="col-lg-12">



            <form method="POST" action="{{route('deposit.confirm')}}">
                @csrf
                <div class="tile text-center">
                    <h3 class="tile-title">{{$page_title}} </h3>
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-md-6 offset-md-3" >
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <img src="{{asset('assets/images/gateway')}}/{{$data->gateway_id}}.jpg"
                                             style="max-width:100px; max-height:100px; margin:0 auto;"/>
                                    </li>
                                    <li class="list-group-item"> Amount : {{$data->amount}}
                                        <strong>{{$basic->currency}}</strong>
                                    </li>


                                    <li class="list-group-item"> Charge :
                                        <strong>{{$data->charge}} </strong>{{ $basic->currency }}</li>
                                    <li class="list-group-item "> Payable :
                                        <strong>{{$data->charge + $data->amount}} </strong>{{ $basic->currency }}</li>


                                    <li class="list-group-item"> In USD :
                                        <strong>${{$data->usd}}</strong>
                                    </li>

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

@stop
@section('script')
    @if($data->gateway_id == 107)
        <form action="{{ route('ipn.paystack') }}" method="POST">
            @csrf
            <script
                src="//js.paystack.co/v1/inline.js"
                data-key="{{ $data->gateway->val1 }}"
                data-email="{{ $data->user->email }}"
                data-amount="{{ round($data->usd/$data->gateway->val7, 2)*100 }}"
                data-currency="NGN"
                data-ref="{{ $data->trx }}"
                data-custom-button="btn-confirm"
            >
            </script>
        </form>
    @elseif($data->gateway_id == 108)
        <script src="//voguepay.com/js/voguepay.js"></script>
        <script>
            closedFunction = function () {

            }
            successFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/success';
            }
            failedFunction = function (transaction_id) {
                window.location.href = '{{ url('user/vogue') }}/' + transaction_id + '/error';
            }

            function pay(item, price) {
                //Initiate voguepay inline payment
                Voguepay.init({
                    v_merchant_id: "{{ $data->gateway->val1 }}",
                    total: price,
                    notify_url: "{{ route('ipn.voguepay') }}",
                    cur: 'USD',
                    merchant_ref: "{{ $data->trx }}",
                    memo: 'Buy ICO',
                    recurrent: true,
                    frequency: 10,
                    developer_code: '5af93ca2913fd',
                    store_id: "{{ $data->user_id }}",
                    custom: "{{ $data->trx }}",

                    closed: closedFunction,
                    success: successFunction,
                    failed: failedFunction
                });
            }

            $(document).ready(function () {
                $(document).on('click', '#btn-confirm', function (e) {
                    e.preventDefault();
                    pay('Buy', {{ $data->usd }});
                });
            })
        </script>

    @endif
@endsection
