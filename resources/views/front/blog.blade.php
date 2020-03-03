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

                @foreach($blogs as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog-post"><!-- single blog page -->
                            <div class="thumb">
                                <img src="{{asset('assets/images/post/'.$data->image)}}" alt="blog images">
                            </div>
                            <div class="content">
                                <a href="{{route('blog.details',[$data->id,str_slug($data->title)])}}"><h4 class="title">{{$data->title}}</h4></a>
                                <div class="post-meta">
                                    <span class="time"><i
                                            class="far fa-clock"></i> {{date('d M Y',strtotime($data->created_at))}}</span>
                                </div>
                                <p>{{str_limit(strip_tags($data->details),180)}} </p>
                                <a href="{{route('blog.details',[$data->id,str_slug($data->title)])}}" class="readmore">Read More</a>
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
