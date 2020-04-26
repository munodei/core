@extends('merchant-1')

@section('css')
@endsection
@section('content')


<center>
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg">
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




    <!-- about page content area start -->
    <section class="about-page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="about-page-content-inner"><!-- about page content inner -->
                        <h2 class="title">{{$basic->about_title}}</h2>
                        <p>{!! $basic->about !!}</p>

                        <div class="video-inner-wrapper">
                            <img src="{{asset('assets/images/about-video-image.jpg')}}"  class="col-lg-12" alt="about video image">

                        </div>
                    </div><!-- //.about page content inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- about page content area end -->
    <br>
    @include('partials.share')
</center>



@include('partials.subscribe')

@endsection
@section('js')
@endsection
