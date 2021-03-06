
<!-- footer area start -->
<section class="footer-area blue-bg" style="margin:10px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 offset-lg-1">
                <div class="footer-widget about"><!-- footer widget -->
                    <div class="widget-body">
                        <a href="{{url('/')}}" class="footer-logo">
                            <img src="{{asset('assets/images/logo/logo.png')}}" width="60" width="60" alt="footer logo" class="max-logo-height">
                        </a>
                        <p>{{$basic->copyright}}</p>
                    </div>
                </div><!-- //.footer widget -->
            </div>
            <div class="col-lg-2">
                <div class="footer-widget"><!-- footer widget -->
                    <div class="widget-title">
                        <h4 class="title">Links</h4>

                    </div>
                    <div class="widget-body">
                        <ul>
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{route('blog')}}">Blog</a></li>
                            @foreach($menus as $data)
                                <li>
                                    <a  href="{{route('menu',[$data->id, str_slug($data->name)])}}">{{$data->name}}</a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                </div><!-- //.footer widget -->
            </div>
            <div class="col-lg-2">
                <div class="footer-widget"><!-- footer widget -->
                    <div class="widget-title">
                        <h4 class="title">About Us</h4>
                    </div>
                    <div class="widget-body">
                        <ul>
                            <li><a href="{{route('about')}}" style="color:#bbc4cc;">About Us</a></li>
                            <li><a href="{{route('faqs')}}">Faqs</a></li>
                            <li><a href="{{route('contact-us')}}">Contact Us</a></li>
                            @guest
                            <li><a href="{{route('login')}}">Sign In</a></li>
                            <li><a href="{{route('register')}}">Sign Up</a></li>
                            @else

                            @endguest
                        </ul>
                    </div>
                </div><!-- //.footer widget -->
            </div>
            <div class="col-lg-2">
                <div class="footer-widget contact"><!-- footer widget -->
                    <div class="widget-title">
                        <h4 class="title">Contact Us</h4>
                    </div>
                    <div class="widget-body">
                        <span class="details">{{$basic->address}}</span><br>
                        <span class="details">{{$basic->email}}</span><br>
                        <span class="details">{{$basic->phone}}</span><br>
                    </div>
                </div><!-- //.footer widget -->
            </div>
        </div>
    </div>
</section>
  <hr>
<div class="copyright-area dark-blug-lg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <span class="copytext">{{$basic->sitename}} &copy; {{Date('Y')}}. All Rights Reserved.</span>
            </div>
        </div>
    </div>
</div>
<!-- footer area end -->
