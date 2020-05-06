@extends('merchant-1')

@section('css')
<meta property="og:image" content="{{$post->photo }}" />
<meta property="og:image:secure_url" content="{{$post->photo }}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | Supported Franchise {{$post->franchise}}" />
<meta property="og:description" content="{{ $basic->sitename }},  Supported Franchise, {{$post->franchise}} " />
@endsection
@section('content')
    {!! $basic->fb_comment !!}

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('franchise.all') }}">Supported Franchises</a></li>
          <li class="breadcrumb-item active"><a href="{{ url()->current() }}">{{ $page_title }}</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('franchise.products',['country'=>strtolower($post->country->name),'franchise'=>$post->slug]) }}">Products</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- /Page Header -->


    <!-- blog page content area start-->
    <div class="blog-details-page-conent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 single-blog-details-inner-wrapper">
                    <div class="single-blog-details-post"><!-- single blog page -->
                      <center>
                        <div class="thumb">
                            <img src="{{$post->photo}}"   width="50%" height="50%"
                          alt="{{$post->franchise}}">
                        </div>
                      </center>
                        <div class="content">
                            <h4 class="title"><a href="{{ route('franchise.products',['country'=>strtolower($post->country->name),'franchise'=>$post->slug]) }}">{{$post->franchise}} | {{$post->country->name}}</a> </h4>
                            <div class="post-meta">
                                <span class="time"><i class="far fa-clock"></i> {{date('d M Y',strtotime($post->created_at))}}</span>
                            </div>
                            <p>
                                {!! $post->franchise_description !!}
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
