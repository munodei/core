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


    <!-- faq area start -->
    <section class="faq-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title extra">
                        <h2 class="title"></h2>
                        <p>
                            {{ $service->service_description }}

                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-wrapper"><!-- left content wrapper -->
                        <div id="accordion">

                            @foreach($service->faqs as $k =>$data)
                                @if($k % 2 == 0)
                                    <div class="card">
                                        <a  class="collapsed" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="collapse{{$data->id}}">
                                            <div class="card-header" id="heading{{$data->id}}">
                                                    {{$data->title}}
                                            </div>
                                        </a>
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
                            @foreach($service->faqs as $k=> $data)
                                @if($k % 2 == 1)
                                <div class="card">
                                    <a  class="collapsed" data-toggle="collapse" data-target="#collapse{{$data->id}}" aria-expanded="false" aria-controls="collapse{{$data->id}}">
                                        <div class="card-header" id="heading{{$data->id}}">
                                                {{$data->title}}
                                        </div>
                                    </a>
                                    <div id="collapse{{$data->id}}" class="collapse" aria-labelledby="heading{{$data->id}}" data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $data->description !!}
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                        </div>
                    </div><!-- //.right content wrappper -->
                </div>
                <br>
                @include('partials.share')

                <div class="col-lg-12 text-center">
                    <div class="btn-wrapper">
                        <a href="{{ route('contact-us') }}" class="boxed-btn btn-rounded">Any question?</a>
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
