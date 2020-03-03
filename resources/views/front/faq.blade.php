@extends('layout')

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


    <!-- faq area start -->
    <section class="faq-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title extra">
                        <h2 class="title">Frequently Asking Question</h2>
                        <p>
                            Hopefully we can answer your questions.

                            If you have any additional questions about <strong>{{$basic->sitename}}</strong>, Please send us a
                            <a href="{{route('contact-us')}}"><strong>message</strong></a>  any time .

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-wrapper"><!-- left content wrapper -->
                        <div id="accordion">
                            @foreach($faqs as $k =>$data)
                                @if($k % 2 == 0)
                            <div class="card">
                                <div class="card-header" id="heading{{$data->id}}">
                                    <a  data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="collapse{{$data->id}}">
                                        {{$data->title}}
                                    </a>
                                </div>

                                <div id="collapse{{$data->id}}" class="collapse" aria-labelledby="heading{{$data->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                        {!! $data->description !!}
                                    </div>
                                </div>
                            </div>
                                @endif
                                @endforeach
                        </div>
                    </div><!-- //.left content wrapper -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-wrapper"><!-- right content wrapper -->
                        <div id="accordion_2">
                            @foreach($faqs as $k=> $data)
                                @if($k % 2 == 1)
                            <div class="card">
                                <div class="card-header" id="headingOne_{{$data->id}}">
                                    <a  data-toggle="collapse" data-target="#collapseOne_{{$data->id}}" aria-expanded="false" aria-controls="collapseOne_{{$data->id}}">
                                        {{$data->title}}
                                    </a>
                                </div>

                                <div id="collapseOne_{{$data->id}}" class="collapse" aria-labelledby="headingOne_{{$data->id}}" data-parent="#accordion_{{$data->id}}">
                                    <div class="card-body">
                                        {{$data->description}}
                                    </div>
                                </div>
                            </div>
                                @endif
                                @endforeach
                        </div>
                    </div><!-- //.right content wrappper -->
                </div>
                <div class="col-lg-12 text-center">
                    <div class="btn-wrapper">
                        <a href="{{route('contact-us')}}" class="boxed-btn btn-rounded">Any question?</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- faq area end -->


@include('partials.subscribe')

@endsection
@section('js')
@endsection
