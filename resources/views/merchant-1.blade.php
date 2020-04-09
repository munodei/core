<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="{{ $page_title ?? ''}} | {{ $basic->sitename }}">
		    <meta name="keywords" content=" {{$basic->sitename}}">
        <meta name="author" content=" {{$basic->sitename}}">
        <meta name="robots" content="noindex, nofollow">

        <title>{{isset($page_title) ? $page_title : ''}} | {{ $basic->sitename }} </title>
        @yield('import-css')
        @yield('css')
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{asset('assets/images/logo/favicon.png')}}" />
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/bootstrap.min.css">
        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/font-awesome.min.css">
        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/line-awesome.min.css">
        <!-- Chart CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/plugins/morris/morris.css">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/css/style.css">
        <style>
a:hover, a:visited, a:link, a:active
{
    text-decoration: none;
    color:#bbc4cc;
}</style>

    </head>

    <body>
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

				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<!-- Header Title -->
        <a href="{{ url('/') }}">
                <div class="page-title-box">
					<h3>{{ $basic->sitename }}</h3>
                </div>
        </a>
				<!-- /Header Title -->

				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

				<!-- Header Menu -->
				<ul class="nav user-menu">
          <!-- Flag -->
          <li class="nav-item">
              <a class="dropdown-item" href="{{route('blog')}}">Blog</a>
          </li>
          <li class="nav-item">
              <a class="dropdown-item" href="{{route('about')}}">About Us</a>
          </li>
          <li class="nav-item">
              <a class="dropdown-item" href="{{route('contact-us')}}">Contact Us</a>
          </li>
          <li class="nav-item">
              <a class="dropdown-item" href="{{route('faqs')}}">Faqs</a>
          </li>
<li class="nav-item dropdown has-arrow flag-nav">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="{{route('blog')}}" role="button">
<span>Pages</span>
  </a>
  <div class="dropdown-menu dropdown-menu-right">



    @foreach($menus as $data)
            <a  href="{{route('menu',[$data->id, str_slug($data->name)])}}" class="dropdown-item">{{$data->name}}</a>
    @endforeach
  </div>
</li>
<!-- /Flag -->

          @guest
          @else
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
                <a href="{{ route('notifications.index') }}">View all Notifications</a>
              </div>
            </div>
          </li>
          <!-- /Notifications -->
          @endguest


					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
							<span class="user-img">
                @guest
                    <img src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar">
                @else
                @if(Auth::user()->image != null)
                    <img src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->username }}">
                @else
                    <img src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar">
                @endif
                <span class="status online"></span>
                @endguest
							</span>
							<span>{{ Auth::user()->username ?? '' }}</span>
						</a>
						<div class="dropdown-menu">
              @guest
              <a class="dropdown-item" href="{{ route('login') }}">Login</a>
							<a class="dropdown-item" href="{{ route('register') }}">Register</a>
              @else
							<a class="dropdown-item" href="{{ route('edit-profile') }}">My Profile</a>
							<a class="dropdown-item" href="{{ route('user.change-password') }}">Password</a>
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

              @endguest
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
        <div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
            @guest
            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
            <a class="dropdown-item" href="{{ route('register') }}">Register</a>
            @else
						<a class="dropdown-item" href="{{ route('edit-profile') }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('user.change-password') }}">Password</a>
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            @endguest
					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST"style="display: none;">
        {{ csrf_field() }}
      </form>
			<!-- Sidebar -->
      @guest
      @else
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="menu-title">
								<span>Start here</span>
							</li>
              <li>
                <a href="{{ route('home') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
              </li>
							<li class="submenu">
								<a href="#" class="@if(Route::currentRouteName() == 'contacts.index')  active @endif" class="noti-dot"><i class="la la-users"></i> <span>Contacts</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="@if(Route::currentRouteName() == 'contacts.index')  active @endif" href="{{ route('contacts.index') }}">All Contacts</a></li>
									<li><a class="@if(Route::currentRouteName() == 'contacts.create')  active @endif" href="{{ route('contacts.create') }}">Add Contact</a></li>
									<li><a class="@if(Route::currentRouteName() == 'contacts-import')  active @endif" href="{{ route('contacts-import') }}">Import Contacts</a></li>
									<li><a class="@if(Route::currentRouteName() == 'contacts-export')  active @endif" href="{{ route('contacts-export') }}">Export Contacts</a></li>
                  <li><a class="@if(Route::currentRouteName() == 'delete-all-contacts')  active @endif" href="{{route('delete-all-contacts')}}">Delete All Contacts</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="la la-shopping-cart"></i> <span> Saved Shopping Lists</span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
                  <li><a class="@if(Route::currentRouteName() == 'add-shopping-item')  active @endif" href="{{ route('add-shopping-item') }}">Add Shopping Item</a></li>
									<li><a class="@if(Route::currentRouteName() == 'shopping-items')  active @endif" href="{{ route('shopping-items') }}">All Shopping Items</a></li>
									<li><a class="@if(Route::currentRouteName() == 'shopping-list')  active @endif" href="{{ route('shopping-list') }}">Shopping Lists</a></li>
                  <li><a class="@if(Route::currentRouteName() == 'shopping-requests.index')  active @endif" href="{{ route('shopping-requests.index') }}">Shopping Requests</a></li>
                  <li><a class="@if(Route::currentRouteName() == 'delivery-locations.index')  active @endif" href="{{ route('delivery-locations.index') }}">Delivery Locations</a></li>
								</ul>
							</li>



							<li class="menu-title">
								<span>Remittance</span>
							</li>
							<li class="submenu">
								<a href="#"><i class="la la-money"></i> <span> Cash Services </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="@if(request()->path() == 'user/send-money') active @endif" href="{{ route('send.money') }}">Send Money</a></li>
									<li><a class="@if(request()->path() == 'user/transfer-history') active @endif" href="{{ route('sendingLog') }}">Send History</a></li>
									<li><a class="@if(request()->path() == 'user/payout-money') active @endif" href="{{ route('merchant.withdraw') }}">Payout Money</a></li>
									<li><a class="@if(request()->path() == 'user/payout-log') active @endif" href="{{ route('withdrawLog') }}">Payout Log </a></li>
									<li><a class="@if(request()->path() == 'user/transaction-log') active @endif" href="{{ route('user.trx') }}">Transaction Log</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#"><i class="la la-money"></i> <span> Manage Deposits </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a class="@if(request()->path() == 'user/deposit') active @endif" href="{{ route('deposit') }}"> Deposit Money </a></li>
									<li><a class="@if(request()->path() == 'user/deposit-log') active @endif" href="{{ route('user.depositLog') }}"> Deposit History </a></li>
								</ul>
							</li>

							<li class="menu-title">
								<span>Airtime Services</span>
							</li>
							<li>
								<a class="@if(Route::currentRouteName() == 'sell-airtime.index')  active @endif"  href="{{ route('sell-airtime.index') }}"><i class="la la-object-ungroup"></i> <span>Sell Airtime</span></a>
                <a class="@if(Route::currentRouteName() == 'airtime-sells')  active @endif"  href="{{ route('airtime-sells') }}"><i class="la la-money"></i> <span>Airtime Sells</span></a>
							</li>
							<!-- <li>
								<a href="{{ route('buy-airtime.index') }}"><i class="la la-question"></i> <span>Buy Airtime</span></a>
							</li> -->

              <li class="menu-title">
                <span>Direct Withdrawal</span>
              </li>

              <li>
                <a class="@if(Route::currentRouteName() == 'withdrawal-via-e-wallet')  active @endif"  href="{{ route('withdrawal-via-e-wallet') }}"><i class="la la-phone"></i> <span>E-Wallet</span></a>
                <a class="@if(Route::currentRouteName() == 'withdrawal-via-e-bank-transfer')  active @endif"  href="{{ route('withdrawal-via-e-bank-transfer') }}"><i class="la la-bank"></i> <span>Bank Transfer</span></a>
                <a class="@if(Route::currentRouteName() == 'withdrawal-requests.index')  active @endif"  href="{{ route('withdrawal-requests.index') }}"><i class="la la-history"></i> <span>Withdrawal Requests</span></a>
              </li>

							<li class="menu-title">
								<span>Other Services</span>
							</li>

							<li class="submenu">
								<a href="#"><i class="la la-user"></i> <span> Personal Profile </span> <span class="menu-arrow"></span></a>
								<ul style="display: none;">
									<li><a href="{{ route('edit-profile') }}"> Merchant Profile </a></li>
									<li><a href="{{ route('user.change-password') }}"> Password </a></li>
								</ul>
							</li>

              <li class="submenu">
                <a href="#"><i class="la la-user"></i> <span> Support </span> <span class="menu-arrow"></span></a>
                <ul style="display: none;">
                  <li><a class="@if(request()->path() == 'user/openSupportTicket') active @endif" href="{{route('user.ticket.open')}}"> Open Support Tickets </a></li>
                  <li><a class="@if(request()->path() == 'user/supportTicket') active @endif " href="{{route('user.ticket')}}"> Support Ticket </a></li>
                </ul>
              </li>


						</ul>
					</div>
                </div>
            </div>
            @endif
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
                    @include('errors.alert')
                    @include('errors.error')
                    @yield('body')
                    @yield('content')
				         </div>
				<!-- /Page Content -->
          </div>
			<!-- /Page Wrapper -->
        </div>
		<!-- /Main Wrapper -->

    @include('partials.footer')

    <script src="{{ url('/') }}/assets/smarthr/js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ url('/') }}/assets/smarthr/js/popper.min.js"></script>
    <script src="{{ url('/') }}/assets/smarthr/js/bootstrap.min.js"></script>
    <!-- Slimscroll JS -->
    <script src="{{ url('/') }}/assets/smarthr/js/jquery.slimscroll.min.js"></script>
    <script src="{{asset('assets/admin/js/toastr.min.js')}}"></script>
    <!-- Chart JS -->
    <script src="{{ url('/') }}/assets/smarthr/plugins/morris/morris.min.js"></script>
    <script src="{{ url('/') }}/assets/smarthr/plugins/raphael/raphael.min.js"></script>
    <script src="{{ url('/') }}/assets/smarthr/js/chart.js"></script>
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
//     document.onkeydown = function(e) {
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
