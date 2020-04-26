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

    <!-- blog page content area start-->
    <div class="blog-page-conent" style="margin:10px;">
        <div class="container">
            <div class="row">

                @foreach($blogs as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post"><!-- single blog page -->
                          <a href="{{route('blog.details',['slud'=>$data->slug])}}">
                            <div class="thumb ">
                                <img src="{{asset('assets/images/post/'.$data->image)}}" alt="blog images" class="col-lg-4 col-md-6">
                            </div>
                          </a>
                            <div class="content" style="margin:10px;">
                                <a href="{{route('blog.details',['slud'=>$data->slug])}}"><h4 class="title">{{$data->title}}</h4></a>
                                <div class="post-meta">
                                    <span class="time"><i
                                            class="far fa-clock"></i> {{date('d M Y',strtotime($data->created_at))}}</span>
                                </div>
                                <p>{{str_limit(strip_tags($data->details),180)}} </p>
                                <a href="{{route('blog.details',['slud'=>$data->slug])}}"  class="readmore btn-sm btn-primary">Read More</a>
                                <br>
                            </div>
                        </div><!-- //. single blog page content -->
                    </div>
                @endforeach


                <div class="post-navigation ">
                    <ul class="pagination">
                        {{ $blogs->links('partials.pagination') }}
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <!-- blog page content area end-->




@include('partials.subscribe')

@endsection
@section('js')
@endsection
