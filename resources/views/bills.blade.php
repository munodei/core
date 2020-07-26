<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
      <meta name="description" content="{{ $page_title ?? ''}} | {{ $basic->sitename }}">
      <meta name="keywords" content=" {{$basic->sitename}}">
      <meta name="author" content=" {{$basic->sitename}}">
      <meta name="robots" content="noindex, nofollow">
      <title>{{  $page_title ?? '' }} | {{ $basic->sitename }}</title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{asset('assets/images/logo/favicon.png')}}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/font-awesome.min.css">
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/line-awesome.min.css">
        <!-- Select2 CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/select2.min.css">
        <!-- Datetimepicker CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/bootstrap-datetimepicker.min.css">
        <!-- Summernote CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/style.css">
        @yield('import-css')
        @yield('css')

    </head>
    <!-- oncontextmenu="return false;" -->
    <body >
		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left">
                    <a href="{{ url('/') }}" class="logo">
          						<img src="{{asset('assets/images/logo/logo.png')}}" width="60" height="60" alt="">
          					</a>
                </div>
				<!-- /Logo -->

				<!-- Header Title -->
        <a href="{{ route('home') }}">
                <div class="page-title-box">
					<h3>{{ $basic->sitename }}</h3>
                </div>
        </a>
				<!-- /Header Title -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

				<!-- Header Menu -->
				<ul class="nav user-menu">
					<!-- Notifications -->
					<li class="nav-item dropdown">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{ sizeof($notifications) }}</span>
						</a>
						<div class="dropdown-menu notifications">
							<div class="topnav-dropdown-header">
								<span class="notification-title">Notifications</span>
								<a href="javascript:void(0)" class="clear-noti"> Clear All </a>
							</div>
							<div class="noti-content">
								<ul class="notification-list">

                  @foreach($notifications as $notification)
									<li class="notification-message">
										<a href="{{ route('read-notification',['id'=>$notification->id]) }}">
											<div class="media">

                        {!! $notification->icon !!}

												<div class="media-body">
													<p class="noti-details"><span class="noti-title">{!! $notification->message !!}</p>

												</div>
											</div>
										</a>
									</li>
                  @endforeach
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="activities.html">View all Notifications</a>
							</div>
						</div>
					</li>
					<!-- /Notifications -->

          <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <span class="user-img">
                @if(Auth::user()->image != null)
                    <img src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->username }}">
                @else
                    <img src="{{asset('assets/images/user/user-default.png')}}" alt="{{ Auth::user()->username }}">
                @endif
              <span class="status online"></span></span>
              <span>{{ Auth::user()->username }}</span>
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('edit-profile') }}">My Profile</a>
              <a class="dropdown-item" href="{{ route('user.change-password') }}">Password</a>
              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST"style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="{{ route('edit-profile') }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('user.change-password') }}">Password</a>
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->

			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div class="sidebar-menu">
						<ul>
							<li>
								<a href="{{ route('home') }}"><i class="la la-home"></i> <span>Back to Home</span></a>
							</li>

                  <li><a class="@if(Route::currentRouteName() == 'bills.index')  active @endif"         href="{{ route('bills.index') }}">Saved Bills</a></li>
                  <li><a class="@if(Route::currentRouteName() == 'bills.create')  active @endif"         href="{{ route('bills.create') }}">Add Bills</a></li>



						</ul>
					</div>
                </div>
            </div>
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
            <div class="page-wrapper">
                    @include('errors.alert')
                    @include('errors.error')
              @yield('body')
              @yield('content')

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

<!-- jQuery -->
<script src="{{ url('/') }}/assets/smarthr/js/jquery-3.2.1.min.js"></script>
<!-- Bootstrap Core JS -->
<script src="{{ url('/') }}/assets/smarthr/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/smarthr/js/bootstrap.min.js"></script>
<!-- Slimscroll JS -->
<script src="{{ url('/') }}/assets/smarthr/js/jquery.slimscroll.min.js"></script>
<!-- Select2 JS -->
<script src="{{ url('/') }}/assets/smarthr/js/select2.min.js"></script>
<!-- Datetimepicker JS -->
<script src="{{ url('/') }}/assets/smarthr/js/moment.min.js"></script>
<script src="{{ url('/') }}/assets/smarthr/js/bootstrap-datetimepicker.min.js"></script>
<!-- Summernote JS -->
<script src="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.min.js"></script>
<!-- Task JS -->
<script src="{{ url('/') }}/assets/smarthr/js/task.js"></script>
<!-- Custom JS -->
<script src="{{ url('/') }}/assets/smarthr/js/app.js"></script>
@yield('import-script')
<!-- jQuery -->
@yield('script')
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
<script type="text/javascript">
    @if(Session::has('message'))
var type = "{{Session::get('alert-type','info')}}";
switch (type) {
    case 'info':
        toastr.info("{{Session::get('message')}}");
        break;
    case 'warning':
        toastr.warning("{{Session::get('message')}}");
        break;
    case 'success':
        toastr.success("{{Session::get('message')}}");
        break;
    case 'error':
        toastr.error("{{Session::get('message')}}");
        break;
}
@endif
// document.onkeydown = function(e) {
//   if(event.keyCode == 123) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
//      return false;
//   }
//   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
//      return false;
//   }
// }
</script>

    </body>
</html>
