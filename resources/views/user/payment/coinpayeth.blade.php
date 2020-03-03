@extends('user')
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
    <div class="testimonial-page-conent">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">

                        <div class="card-body text-center">
                            <h6 class="text-color"> PLEASE SEND EXACTLY <span style="color: green"> {{ $bcoin }}</span> ETH</h6>
                            <h5>TO <span style="color: green"> {{ $wallet}}</span></h5>
                            {!! $qrurl !!}
                            <h4 class="text-color">SCAN TO SEND</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
