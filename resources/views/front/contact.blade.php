@extends('merchant-1')

@section('css')
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


    <section class="contact-page-area">
        <div class="container contact-page-container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="section-title">
                        <h2 class="title">Contact With Us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact-page-inner"><!-- contact page inner -->
                        <form action="" method="post" id="get_in_touch" class="contact-form">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-element form-group margin-bottom-30">
                                        <label for="name" class="label">Name *</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                               placeholder="Enter your name">

                                        @if ($errors->has('name'))
                                            <span class="error">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-element form-group margin-bottom-30">
                                        <label for="phone" class="label">Phone *</label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                               placeholder="Enter phone number">
                                        @if ($errors->has('phone'))
                                            <span class="error">{{ $errors->first('phone') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-element form-group margin-bottom-30">
                                        <label for="email" class="label">Email *</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                               placeholder="Enter your email">
                                        @if ($errors->has('email'))
                                            <span class="error">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-element form-group margin-bottom-30">
                                        <label for="subject" class="label">Subject *</label>
                                        <input type="text" name="subject" id="subject" class="form-control"
                                               placeholder="Enter your subject">
                                        @if ($errors->has('subject'))
                                            <span class="error">{{ $errors->first('subject') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-element form-group textarea margin-bottom-30">
                                        <label for="message" class="label">Message *</label>
                                        <textarea name="message" id="message" placeholder="Enter message"
                                                  class="form-control textarea" cols="30" rows="10"></textarea>

                                        @if ($errors->has('message'))
                                            <span class="error">{{ $errors->first('message') }}</span>
                                        @endif
                                    </div>
                                    <input type="submit" class="submit-btn" value="Send Message">
                                </div>
                            </div>
                        </form>
                    </div><!-- //.contact page inner -->
                </div>
            </div>
        </div>
    </section>


    @if($basic->location == 1)
    <!-- map area start -->
    <div class="map-area" id="map"  data-lag="{{$basic->latitude}}" data-loge="{{$basic->longitude}}"></div>
    <!-- map area end -->
        @else
        @include('partials.subscribe')
    @endif




@endsection

@section('js')

    <script src="https://maps.googleapis.com/maps/api/js?key={{$basic->map_api}}&callback=initMap"
            async defer></script>
    <!-- google map activate js -->
    <script src="{{asset('assets/front/js/google-map-activate.js')}}"></script>

@endsection
