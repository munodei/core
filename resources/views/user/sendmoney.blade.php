@extends('merchant-1')


@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/user-calculation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/flags/flags.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front/flags/dd.css')}}">
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




    <!-- blog page content area start-->
    <div class="blog-page-conent">
        <div class="container">
            <div class="row">

                <div class="col-md-10 offset-md-1">
                    @include('errors.alert')
                    @include('errors.error')
                    <div class="tgo-calculator " style="background-image: none;">
                        <div class="tgc-calculator">
                            <div class="calculator-content">
                                <div class="tutorial-calculator-inputs">
                                    <div class="calculator-select-block">
                                        <div class="select-block-label">Sending from</div>
                                        <br>
                                        <div class="tgc-calculator-select">
                                            <div class="calculator-country-select-wrapper">
                                                <select name="countries" id="fromCountries"
                                                        class="calculator-select-country q-from-country">
                                                    @foreach($country as $data)
                                                        <option value="{{$data->id}}" data-code="{{$data->code}}"
                                                                data-rate="{{$data->rate}}"
                                                                data-charge="{{$data->charge}}"
                                                                data-image="{{asset('assets/images/country/'.$data->image)}}"
                                                                data-name="{{$data->name}}">{{$data->name}}
                                                        </option>
                                                    @endforeach
                                                </select>


                                            </div>
                                            <input type="tel"
                                                   class="tgc-calculator-select-amount from-amount-enter q-calculator-from-amount-select"
                                                   autocomplete="off" placeholder="0.00"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')">
                                            <span class="calculator-select-currency q-from-currency-selector"></span>
                                        </div>
                                    </div>
                                    <div class="calculator-select-block">
                                        <div class="select-block-label">Receiver gets in</div>
                                        <br>
                                        <div class="tgc-calculator-select">
                                            <div class="calculator-country-select-wrapper">
                                                <select name="countriesaa" id="toCountries"
                                                        class="calculator-select-country q-to-country">
                                                    @foreach($countryLatest as $data)
                                                        <option value="{{$data->id}}" data-code="{{$data->code}}"
                                                                data-rate="{{$data->rate}}"
                                                                data-charge="{{$data->charge}}"
                                                                data-image="{{asset('assets/images/country/'.$data->image)}}"
                                                                data-name="{{$data->name}}">{{$data->name}}
                                                        </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <input type="tel"
                                                   class="tgc-calculator-select-amount to-amount-enter  q-calculator-to-amount-select"
                                                   value=""
                                                   placeholder="0.00"
                                                   onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                                                   autocomplete="off">
                                            <span class="calculator-select-currency q-to-currency-selector"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="tgc-calculator-fees">
                                    <div class="rate-block"><span class="from-entering-amount"></span> <span
                                            class="fromCountryCode"></span> = <span class="to-getting-amount"></span>
                                        <span class="toCountryCode"></span></div>
                                    |
                                    <div class="fee-block">
                                        <div class="tgc-simple-tooltip">
                                            <div class="tooltip--container">
                                                <div class="tooltip--tip"></div>
                                            </div>
                                            <div class="tooltip--source"> FEE <span
                                                    class="text-medium fee-hover ">  </span> <span
                                                    class="fromCountryCode"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(Auth::user())
                                @if(Auth::user()->merchant == 1)

                                    <form action="{{route('send.money.check')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="send_amount" class="input_send_amount" value="">
                                        <input type="hidden" name="receive_amount" class="input_receive_amount"
                                               value="">
                                        <input type="hidden" name="charge" class="input-send-amount-charge" value="">
                                        <input type="hidden" name="fromCountry" class="from-selected-country" value="">
                                        <input type="hidden" name="toCountry" class="to-selected-country" value="">
                                        <button type="submit"
                                                class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Continue
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('send.money.check')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="send_amount" class="input_send_amount" value="">
                                        <input type="hidden" name="receive_amount" class="input_receive_amount"
                                               value="">
                                        <input type="hidden" name="charge" class="input-send-amount-charge" value="">
                                        <input type="hidden" name="fromCountry" class="from-selected-country" value="">
                                        <input type="hidden" name="toCountry" class="to-selected-country" value="">
                                        <button type="submit"
                                                class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Continue
                                        </button>
                                    </form>

                                @endif
                            @else
                                <a href="{{route('login')}}"
                                   class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Get Started</a>
                            @endif


                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- blog page content area end-->




@endsection
@section('js')
    <script src="{{asset('assets/front')}}/flags/jquery.dd.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#fromCountries").msDropdown();
            $("#toCountries").msDropdown();

            var giveAmount = $(".from-amount-enter").val();
            var toGateAmount = $(".to-amount-enter").val();

            if ((giveAmount.length == 0) || (toGateAmount.length == 0)) {
                $('.tgc-calculator-fees').hide();
            }

            var code = $("#fromCountries option:selected").data('code');
            var fromSelectedcountry = $("#fromCountries option:selected").val();
            $('.from-selected-country').val(fromSelectedcountry);

            $('.q-from-currency-selector,  .fromCountryCode').text(code);
            $('.q-from-currency-selector').text(code);

            var toCountriesCode = $("#toCountries option:selected").data('code');

            var toSelectedcountry = $("#toCountries option:selected").val();
            $('.to-selected-country').val(toSelectedcountry);

            $('.q-to-currency-selector').text(toCountriesCode);
            $('.toCountryCode').text(toCountriesCode);


            $(".from-amount-enter").keyup(function () {

                var fromAmountEnter = $(".from-amount-enter").val();
                $('.from-entering-amount').text(fromAmountEnter);
                $('.input_send_amount').val(fromAmountEnter);

                var fromAmountCharge = $("#fromCountries option:selected").data('charge');
                var fromAmountRate = $("#fromCountries option:selected").data('rate');
                var code = $("#fromCountries option:selected").data('code');

                var SendAmountCharge = (((fromAmountEnter * fromAmountCharge) / 100).toFixed(2));
                $('.fee-hover').text(SendAmountCharge);
                $('.fromCountryCode').text(code);
                $('.input-send-amount-charge').val(SendAmountCharge);

                var toGetAmount = $("#toCountries option:selected").data('rate');

                var showCalcAmount = ((toGetAmount / fromAmountRate) * fromAmountEnter).toFixed(2);
                $('.to-getting-amount').text(showCalcAmount);
                $('.to-amount-enter , .input_receive_amount').val(showCalcAmount);
                $('.tgc-calculator-fees').show();

            });


            $(".to-amount-enter").keyup(function () {
                var toAmountEnter = $(".to-amount-enter").val();
                $('.to-getting-amount').text(toAmountEnter);
                $('.input_receive_amount').val(toAmountEnter);

                var fromAmountEnter = $(".from-amount-enter").val();

                var fromAmountCharge = $("#fromCountries option:selected").data('charge');
                var fromAmountRate = $("#fromCountries option:selected").data('rate');
                var code = $("#fromCountries option:selected").data('code');

                var toAmountCharge = $("#toCountries option:selected").data('charge');
                var toAmountRate = $("#toCountries option:selected").data('rate');
                var toCode = $("#toCountries option:selected").data('code');

                var toGetAmount = $("#toCountries option:selected").data('rate');

                var showCalcAmount = ((fromAmountRate / toGetAmount) * toAmountEnter).toFixed(2);
                $('.from-entering-amount').text(showCalcAmount);
                $('.from-amount-enter,.input_send_amount').val(showCalcAmount);


                var feeHover = (((showCalcAmount * fromAmountCharge) / 100).toFixed(2));
                $('.fee-hover').text(feeHover);
                $('.toCountryCode').text(toCode);
                $('.input-send-amount-charge').val(feeHover);

                $('.tgc-calculator-fees').show();

            })


            $("#fromCountries").on('change', function () {

                var code = $("option:selected", this).data('code');
                $('.q-from-currency-selector, .fromCountryCode').text(code);

                /*no. 1 input on change Start input*/
                var fromAmountEnter = $(".from-amount-enter").val();
                $('.from-entering-amount').text(fromAmountEnter);
                $(".input_send_amount").val(fromAmountEnter);

                var fromAmountCharge = $("#fromCountries option:selected").data('charge');
                var fromAmountRate = $("#fromCountries option:selected").data('rate');
                var code = $("#fromCountries option:selected").data('code');

                var fromSelectedcountry = $("#fromCountries option:selected").val();
                $('.from-selected-country').val(fromSelectedcountry);

                var feeHover = (((fromAmountEnter * fromAmountCharge) / 100).toFixed(2));
                $('.fee-hover').text(feeHover);
                $('.input-send-amount-charge').val(feeHover);
                $('.fromCountryCode').text(code);

                var toGetAmount = $("#toCountries option:selected").data('rate');

                var toSelectedcountry = $("#toCountries option:selected").val();
                $('.to-selected-country').val(toSelectedcountry);

                var showCalcAmount = ((toGetAmount / fromAmountRate) * fromAmountEnter).toFixed(2);

                $('.to-getting-amount').text(showCalcAmount);
                $('.to-amount-enter, .input_receive_amount').val(showCalcAmount);
                /*no. 1 input on change Start input*/

            })


            $("#toCountries").on('change', function () {
                var toCode = $("option:selected", this).data('code');
                $('.q-to-currency-selector, .toCountryCode').text(toCode);

                /*no. 2 input on change Start input*/
                var toAmountEnter = $(".to-amount-enter").val();
                $('.to-getting-amount').text(toAmountEnter);

                var fromAmountEnter = $(".from-amount-enter").val();

                var fromAmountCharge = $("#fromCountries option:selected").data('charge');
                var fromAmountRate = $("#fromCountries option:selected").data('rate');
                var code = $("#fromCountries option:selected").data('code');

                var fromSelectedcountry = $("#fromCountries option:selected").val();
                $('.from-selected-country').val(fromSelectedcountry);

                var toAmountCharge = $("#toCountries option:selected").data('charge');
                var toAmountRate = $("#toCountries option:selected").data('rate');
                var toCode = $("#toCountries option:selected").data('code');

                var toGetAmount = $("#toCountries option:selected").data('rate');

                var toSelectedcountry = $("#toCountries option:selected").val();
                $('.to-selected-country').val(toSelectedcountry);

                var showCalcAmount = ((fromAmountRate / toGetAmount) * toAmountEnter).toFixed(2);
                $('.from-entering-amount').text(showCalcAmount);
                $('.from-amount-enter, .input_send_amount').val(showCalcAmount);

                var feeHover = (((showCalcAmount * fromAmountCharge) / 100).toFixed(2));
                $('.fee-hover').text(feeHover);
                $('.input-send-amount-charge').val(feeHover);
                $('.toCountryCode').text(toCode);

                /*no. 2 input on change End input*/
            })

        })
    </script>
@endsection
