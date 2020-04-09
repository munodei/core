@extends('merchant-1')

@section('css')
@endsection
@section('content')
    {!! $basic->fb_comment !!}

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
    <div class="blog-details-page-conent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 single-blog-details-inner-wrapper">
                    <div class="single-blog-details-post"><!-- single blog page -->
                        <div class="thumb">
                            <img src="{{asset('assets/images/post/'.$post->image)}}"  width="100%" alt="{{$post->title}}">
                        </div>
                        <div class="content">
                            <h4 class="title">{{$post->title}}</h4>
                            <div class="post-meta">
                                <span class="time"><i class="far fa-clock"></i> {{date('d M Y',strtotime($post->created_at))}}</span>
                            </div>
                            <p>
                                {!! $post->details !!}
                            </p>

                        </div>
                    </div><!-- //. single blog page content -->
                    <div class="post-meta-wrapper">
                        <div class="left-content-wrapper"><!-- left content wrapper -->
                            <ul>
                                <p class="title">Share: &nbsp;

                                <a href="https://www.facebook.com/sharer/sharer.php?u={{urlencode(url()->current()) }}"><i class="fa fa-facebook-square"></i></a>
                                <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{urlencode(url()->current()) }}"><i class="fa fa-twitter-square"></i></a>
                                <a href="https://plus.google.com/share?url={{urlencode(url()->current()) }}"><i class="fa fa-google-plus-square "></i></a>
                                <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{urlencode(url()->current()) }}&amp;title=my share text&amp;summary=dit is de linkedin summary"><i class="fa fa-linkedin"></i></a></p>


                            </ul>
                        </div><!-- //.left content wrapper -->
                    </div>
                    <div class="comments-list">
                        <div class="fb-comments" data-colorscheme="dark" data-width="100%"
                             data-href="{{url()->current()}}"
                             data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog page content area end-->


@include('partials.subscribe')
@endsection
@section('js')
@endsection
