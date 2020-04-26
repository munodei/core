@extends('merchant-1')

@section('body')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-home"></i> {{isset($page_title)? $page_title : ''}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{isset($page_title)? $page_title : ''}}</a></li>
        </ul>
    </div>


    <div class="tile mb-4">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="tile-title"><i class="fa fa-history"></i>  Statistics</h3>
            </div>
        </div>
        <div class="row card-body">

  @if(count($cats) >0)
    @foreach($cats as $k=>$data)
            <div class="col-lg-4">
                <a href="#" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-dark  text-center">

                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                  <a href="{{route('outlet.products',['outlet'=>$outlet->slug,'department'=>$data->slug, 'type'=>$type])}}">   <h3>{{ $data->pro_category_name }}</h3></a>
                                    @if($data->sub_categories->count() > 0)
                                        @foreach($data->sub_categories as $sub_cat)
                                         <h5>{{ $sub_cat->pro_category_name }}</h5>
                                        @endforeach
                                    @endif
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
      @endforeach
  @endif
        </div>
    </div>

@stop
