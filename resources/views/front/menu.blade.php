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

    <!-- blog page content area start-->
    <div class="blog-page-conent">
        <div class="container">
            <div class="row">


                    <div class="col-lg-12">
                        <div class="single-blog-post">
                            <div class="content">
                                {!! $menu->description !!}
                            </div>
                        </div><!-- //. single blog page content -->
                    </div>


            </div>
        </div>
    </div>
    <!-- blog page content area end-->




@include('partials.subscribe')

@endsection
@section('js')
@endsection
