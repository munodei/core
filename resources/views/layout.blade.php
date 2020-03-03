<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
@include('partials.front-css')
@yield('css')
<!-- responsive -->
    <link rel="stylesheet" href="{{asset('assets/front')}}/css/responsive.css">
</head>

<body>


<!-- navbar area start -->
<nav class="navbar navbar-area navbar-expand-lg navbar-light ">
    <div class="container nav-container">
        <div class="logo-wrapper navbar-brand">
            <a href="{{route('main')}}" class="logo main-logo">
                <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo" style="max-width: 200px;" class="max-logo-height">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="mirex">
            <!-- navbar collapse start -->
            <ul class="navbar-nav">
                <!-- navbar- nav -->
                <li class="nav-item active">
                    <a class="nav-link pl-0" href="{{route('main')}}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('blog')}}">Blog</a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{route('faqs')}}">Faqs</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact-us')}}">Contact</a>
                </li>

                @if(Auth::check() )
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href=""
                           data-toggle="dropdown"><strong>{{Auth::user()->fname}}</strong></a>
                        <div class="dropdown-menu">
                            <a href="{{route('login')}}" class="dropdown-item">Dashboard</a>
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">{{ csrf_field() }}</form>

                        </div>
                    </li>
                @endif
            </ul>
            <!-- /.navbar-nav -->
        </div>
        @if( !Auth::check() )
            <div class="right-btn-wrapper">
                <a href="{{route('login')}}" class="boxed-btn btn-rounded">Login</a>
                <a href="{{route('register')}}" class="boxed-btn btn-rounded">Register</a>
            </div>
    @endif

    <!-- /.navbar btn wrapper -->
        <div class="responsive-mobile-menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mirex"
                    aria-controls="mirex"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!-- navbar collapse end -->
    </div>
</nav>
<!-- navbar area end -->

@yield('content')

@include('partials.footer')
<!-- preloader area start -->
<div class="preloader" id="preloader">
    <div class="preloader-inner">
        <div class="preloader-container">
            <div class="item item-1"></div>
            <div class="item item-2"></div>
            <div class="item item-3"></div>
            <div class="item item-4"></div>
        </div>
    </div>
</div>
<!-- preloader area end -->


<!-- back to top start -->
<div class="back-to-top">
    <i class="fas fa-rocket"></i>
</div>
<!-- back to top end -->

<!-- jquery -->
<script src="{{asset('assets/front')}}/js/jquery.js"></script>
<!-- popper -->
<script src="{{asset('assets/front')}}/js/popper.min.js"></script>
<!-- bootstrap -->
<script src="{{asset('assets/front')}}/js/bootstrap.min.js"></script>

@yield('script')

@include('partials.front-js')
@yield('js')

@if (session('success'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Success!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if (session('alert'))
    <script type="text/javascript">
        $(document).ready(function () {
            swal("Sorry!", "{{ session('alert') }}", "error");
        });
    </script>
@endif

</body>

</html>
