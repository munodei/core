@extends('layout')

@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/calculation.css')}}">
    <link rel="stylesheet" href="{{asset('assets/front')}}/flags/flags.css">
    <link rel="stylesheet" href="{{asset('assets/front')}}/flags/dd.css">
@endsection
@section('content')
    <!-- header area start -->
    <div class="header-area header-bg">
        <div class="container">
            <div class="row  ">
                <div class="col-lg-7">
                    <div class="header-inner ">
                        <h1 class="title">{{$basic->section1_heading}}</h1>
                        <p class="wow fadeInDown">{{$basic->section1_para}}</p>
                        <div class="btn-wrapper">
                            <a href="{{route('contact-us')}}" class="boxed-btn btn-rounded">Talk to us</a>
                        </div>
                    </div><!-- //. header inner -->
                </div>
                <div class="col-lg-5">
                    @include('errors.alert')
                    @include('errors.error')

                    <div class="tgo-calculator" style="background-image: none;">
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
                                    <input type="hidden" name="receive_amount" class="input_receive_amount" value="">
                                    <input type="hidden" name="charge" class="input-send-amount-charge" value="">
                                    <input type="hidden" name="fromCountry" class="from-selected-country" value="">
                                    <input type="hidden" name="toCountry" class="to-selected-country" value="">
                                    <button type="submit" class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Continue </button>
                                </form>
                                    @else
                                    <form action="{{route('send.money.check')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="send_amount" class="input_send_amount" value="">
                                        <input type="hidden" name="receive_amount" class="input_receive_amount" value="">
                                        <input type="hidden" name="charge" class="input-send-amount-charge" value="">
                                        <input type="hidden" name="fromCountry" class="from-selected-country" value="">
                                        <input type="hidden" name="toCountry" class="to-selected-country" value="">
                                        <button type="submit" class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Continue </button>
                                    </form>

                                    @endif
                            @else
                            <a href="{{route('login')}}" class="btn btn-primary btn-lg btn-clr btn-block text-uppercase">Get Started</a>
                                @endif



                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- header area end -->






    <!-- faq area start -->
    <section class="faq-area2">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title extra">
                        <h2 class="title">The best way to send money online</h2>
                        <p>We are a full service Digital Marketing Agency all the foundational tools you need for
                            inbound success. With this module theres no need to go another day.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-content-wrapper"><!-- left content wrapper -->
                        <div id="accordion">
                            <div class="row">
                                @foreach($continent as $area)
                                    @if($area->countries->where('status',1)->count() > 0)

                                        <div class="col-lg-12">
                                            <h4>{{$area->name}}</h4>
                                            <hr>
                                        </div>

                                        @foreach($area->countries->where('status',1) as $data)
                                            <div class="col-lg-6">
                                                <div class="card">
                                                    <div class="card-header" id="heading{{$data->id}}">
                                                        <a data-toggle="collapse" data-target="#collapse{{$data->id}}"
                                                           aria-expanded="false" aria-controls="collapseOne">
                                                            <img src="{{asset('assets/images/country/'.$data->image)}}"
                                                                 alt="{{$data->name}}"> <span
                                                                class="padding-left-10">{{$data->name}}</span>
                                                        </a>
                                                    </div>

                                                    <div id="collapse{{$data->id}}" class="collapse"
                                                         aria-labelledby="heading{{$data->id}}"
                                                         data-parent="#accordion">
                                                        <div class="card-body">

                                                            <div class="text-center">
                                                                <h4><sup>{{$basic->currency_sym}}</sup>1 = {{round($data->rate,$basic->decimal)}} {{$data->code}}</h4>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                @endforeach

                            </div>

                        </div>
                    </div><!-- //.left content wrapper -->
                </div>
            </div>
        </div>
    </section>
    <!-- faq area end -->










    <!-- video area start -->
    <section class="video-area video-area-bg grd-overlay">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="video-area-content">
                        <div class="video-ply-wrapper">
                            <a href="{{$basic->about_video}}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                        </div>
                        <h2 class="title">{{$basic->about_title}}</h2>
                        <p>{!! $basic->about !!}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video area end -->

    <!-- testimonial area start -->
    <section class="testimonial-area " id="testimonial_carousel">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area"><!-- left content area -->
                        <h3 class="title">{{$basic->testimonial_h}}</h3>
                        <p>{{$basic->testimonial_p}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <div class="testimonial-carousel" id="testimonial-carousel">
                            @foreach($testimonial as $data)
                            <div class="single-testimonial-carousel"><!-- single testimonial carousel -->
                                <div class="author-details">
                                    <div class="pro-immage">
                                        <img src="{{asset('assets/images/testimonial/'.$data->image)}}" alt="testimonial image">
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{$data->name}}</h4>
                                        <span class="post">{{$data->designation}}</span>
                                    </div>
                                </div>

                                <div class="description">
                                    <p>{!! $data->details !!}</p>
                                </div>
                            </div>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial area end -->

  @include('partials.achievement')

 @include('partials.subscribe')






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

                var SendAmountCharge =  (((fromAmountEnter * fromAmountCharge) / 100).toFixed(2));
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
