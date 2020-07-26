@extends('merchant-1')

@section('css')
<meta property="og:image" content="{{asset('assets/images/post/'.$post->image)}}" />
<meta property="og:image:secure_url" content="{{asset('assets/images/post/'.$post->image)}}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | {{$post->title}}" />
<meta property="og:description" content="{{ $basic->sitename }}, {{$post->title}}" />
@endsection
@section('content')
    {!! $basic->fb_comment !!}

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg white-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <h1 class="title">{{$post->title}}</h1>
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
                        <center>
                            <div class="thumb">
                                <img src="{{asset('assets/images/post/'.$post->image)}}"   width="50%" height="50%" alt="{{$post->title}}">
                            </div>
                        </center>
                        <div class="content">
                            
                            <div class="post-meta">
                                <span class="time"><i class="far fa-clock"></i> {{date('d M Y',strtotime($post->created_at))}}</span>
                            </div>
                            <p>
                                {!! $post->details !!}
                            </p>

                        </div>
                    </div><!-- //. single blog page content -->
                    @include('partials.share')
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
