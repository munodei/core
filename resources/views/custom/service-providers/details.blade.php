@extends('merchant-1')

@section('css')
<meta property="og:image" content="{{$photo->meta_value ?? 'images/user/user-default.png' }}" />
<meta property="og:image:secure_url" content="{{$photo->meta_value ?? 'images/user/user-default.png' }}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | Service Provider | {$post->post_title}}" />
<meta property="og:description" content="{{ $basic->sitename }},  Supported Frnachise, {$post->post_title}} " />
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
          <li class="breadcrumb-item"><a href="{{ route('essential_service_providers.all') }}">Service Providers</a></li>
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
                            <img src="{{ url('/')}}/assets/{{$photo->meta_value ?? 'images/user/user-default.png' }}"   width="50%" height="400px"
                          alt="{{$post->post_title}} ">
                        </div>
                      </center>
                      <br>
                        <div class="content">
                            <h4 class="title"><a href="#">{{$post->post_title}} | {{ $location->meta_value ?? '' }}</a> </h4>
                            <div class="post-meta">
                                <span class="time"><i class="far fa-clock"></i> {{date('d M Y',strtotime($post->created_at))}}</span>
                            </div>

                                {!! $post->post_content !!}

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
