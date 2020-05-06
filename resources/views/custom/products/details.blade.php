@extends('merchant-1')

@section('css')
<meta property="og:image" content="{{$product->photo }}" />
<meta property="og:image:secure_url" content="{{$product->photo}}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="250" />
<meta property="og:image:height" content="250" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | {{$franchise->franchise}} | {{ $page_title }}" />
<meta property="og:description" content="{{ $basic->sitename }} | {{$franchise->franchise}} | {{ $page_title }}" />
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
          <li class="breadcrumb-item active"><a href="{{ route('franchise.info',['franchise'=>$franchise->slug])}}">{{$franchise->franchise}}</a></li>
            <li class="breadcrumb-item active"><a href="#">{{ $page_title }}</a></li>
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
                            <img src="{{$product->photo}}"   width="50%" height="50%"
                          alt="{{$product->franchise}}">
                        </div>
                      </center>
                      <br>
                        <div class="content">
                            <h4 class="title"><a href="#">{{$franchise->franchise}} | {{ $product->product_name }}</a> </h4>
                            <br>
                            <p>
                                <div class="small text-muted"><strong>Name :</strong> {{ $product->product_name }}</div>
                                <div class="small text-muted"><strong>Brand :</strong> {{ $product->product_brand }}</div>
                                <div class="small text-muted"><strong>Price :</strong> {{ $product->product_price }}</div>
                                <div class="small text-muted"><strong>Quantity :</strong> {{ $product->product_quantity }}</div>
                                <div class="small text-muted"><strong>Supplier :</strong> {{ $product->product_outlets }}</div>
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
