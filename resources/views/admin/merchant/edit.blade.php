@extends('admin')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-key"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Password Settings</a></li>
        </ul>
    </div>



@endsection
