<!DOCTYPE html>
<html lang="en">
<head>

    <title>{{$basic->sitename}} | {{$page_title}}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('assets/images/logo/favicon.png')}}" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.12/css/all.css" integrity="sha384-G0fIWCsCzJIMAVNQPfjH08cyYaUtMwjJwqiRKxxE/rx96Uroj1BtIQ6MLJuheaO9" crossorigin="anonymous">
    <!-- Main CSS-->
    <link href="{{asset('assets/admin/css/main.css')}}" rel="stylesheet" >
    <!-- Font-icon css-->
    <link href="{{asset('assets/admin/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/fontawesome-iconpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/admin/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    @yield('import-css')
    <link href="{{asset('assets/admin/css/toastr.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/table.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/admin/css/custom.css')}}" rel="stylesheet">

    @yield('css')
    <link href="{{asset('assets/admin/css/ticket.css')}}"  rel="stylesheet">
    <link href="{{asset('assets/admin/css/sweetalert.css')}}"  rel="stylesheet">
    <link rel="stylesheet"  href="{{asset('assets/admin/css/custom.php')}}?color={{ $basic->color }}">
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" href="{{url('/')}}">{{$basic->sitename}}</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"> {{auth()->user()->username}} <i class="fa fa-sort-desc fa-lg"></i> </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="{{route('admin.changePass')}}"><i class="fa fa-key fa-lg"></i> Password</a></li>
                <li><a class="dropdown-item" href="{{route('admin.profile')}}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
                <li><a class="dropdown-item" href="{{route('admin.logout')}}"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</header>
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>

<aside class="app-sidebar">
    <div class="app-sidebar__user">
        @if(Auth::user()->image != null)
            <img class="app-sidebar__user-avatar" class="img-circle"
                 src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="User Image">
        @else
            <img class="app-sidebar__user-avatar" class="img-circle"
                 src="{{asset('assets/images/user/user-default.png')}}" alt="User Image">
        @endif
        <div>
            <p class="app-sidebar__user-name">{{ Auth::user()->fname }} </p>
            <p class="app-sidebar__user-designation">{{ Auth::user()->username }}</p>
        </div>
    </div>
    <ul class="app-menu">

        <li>
            <a class="app-menu__item" href="{{route('home')}}">
                <i class="app-menu__icon fa fa-home"></i>
                <span class="app-menu__label">Home</span>
            </a>
        </li>

        <li class="treeview @if(Route::currentRouteName() == 'contacts.index') is-expanded
                @elseif(Route::currentRouteName() == 'contacts.create') is-expanded
                @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">Contacts</span> <i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li class="@if(Route::currentRouteName() == 'contacts.index')  active @endif"><a class="treeview-item "
                                                                                          href="{{route('contacts.index')}}"><i
                            class="icon fa fa-users"></i> All Contacts</a></li>
                <li class="@if(Route::currentRouteName() == 'contacts.create')  active @endif "><a class="treeview-item "
                                                                                       href="{{route('contacts.create')}}"><i
                            class="icon fa fa-user"></i> Add Contacts </a></li>
            </ul>
        </li>

        <li class="treeview @if(Route::currentRouteName() == 'polls.index') is-expanded
                @elseif(Route::currentRouteName() == 'polls.create') is-expanded
                @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bar-chart"></i><span
                    class="app-menu__label">Your Polls</span> <i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li class="@if(Route::currentRouteName() == 'polls.index')  active @endif"><a class="treeview-item "
                                                                                          href="{{route('polls.index')}}"><i
                            class="icon fa fa-bar-chart"></i> All Your Polls</a></li>
                <li class="@if(Route::currentRouteName() == 'polls.create')  active @endif "><a class="treeview-item "
                                                                                       href="{{route('polls.create')}}"><i
                            class="icon fa fa-plus"></i> Add Poll </a></li>
            </ul>
        </li>



        <li><a class="app-menu__item @if(request()->path() == 'user/send-money') active @endif "
               href="{{route('send.money')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label"> Send Money</span></a>
        </li>

        <li><a class="app-menu__item @if(request()->path() == 'user/transfer-history') active @endif "
               href="{{route('sendingLog')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">  Send  History</span></a>
        </li>

        <li><a class="app-menu__item @if(request()->path() == 'user/payout-money') active @endif "
               href="{{route('merchant.withdraw')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">  Payout   Money </span></a>
        </li>
        <li><a class="app-menu__item @if(request()->path() == 'user/payout-log') active @endif "
               href="{{route('withdrawLog')}}"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">  Payout   Log </span></a>
        </li>

        <li><a class="app-menu__item @if(request()->path() == 'user/transaction-log') active @endif "
               href="{{route('user.trx')}}"><i class="app-menu__icon fa fa-exchange"></i><span class="app-menu__label"> Transaction Log</span></a>
        </li>


        <li class="treeview @if(request()->path() == 'user/deposit') is-expanded
                @elseif(request()->path() == 'user/deposit-log') is-expanded
                @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span
                    class="app-menu__label">Manage Deposit</span> <i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li class="@if(request()->path() == 'user/deposit-log') active @endif"><a class="treeview-item "
                                                                                          href="{{route('deposit')}}"><i
                            class="icon fa fa-money"></i> Deposit Money</a></li>
                <li class="@if(request()->path() == 'user/deposit') active @endif "><a class="treeview-item "
                                                                                       href="{{route('user.depositLog')}}"><i
                            class="icon fa fa-list"></i> Deposit History </a></li>
            </ul>
        </li>

        <li class="treeview @if(request()->path() == 'user/openSupportTicket') is-expanded
                @elseif(request()->path() == 'user/supportTicket') is-expanded
                @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-question-circle"></i><span
                    class="app-menu__label"> Support Ticket </span> <i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li class="@if(request()->path() == 'user/openSupportTicket') active @endif"><a class="treeview-item "
                                                                                          href="{{route('user.ticket.open')}}"><i
                            class="icon fa fa-money"></i>Open Support Ticket </a></li>
                <li class="@if(request()->path() == 'user/supportTicket') active @endif ">
                    <a class="treeview-item "  href="{{route('user.ticket')}}"><i
                            class="icon fa fa-list"></i> Support Ticket </a></li>
            </ul>
        </li>





    </ul>
</aside>
<main class="app-content">

    @yield('body')



</main>
<!-- Essential javascripts for application to work-->
<script src="{{asset('assets/admin/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('assets/admin/js/popper.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-toggle.min.js')}}"></script>
<script src="{{asset('assets/admin/js/bootstrap-fileinput.js')}}" ></script>

<script src="{{asset('assets/admin/js/fontawesome-iconpicker.min.js')}}" ></script>
<script src="{{asset('assets/admin/js/toastr.min.js')}}" ></script>
<script src="{{asset('assets/admin/js/sweetalert.js')}}"></script>
<script src="{{asset('assets/admin/js/main.js')}}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{asset('assets/admin/js/pace.min.js')}}"></script>
<!-- Page specific javascripts-->
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
</script>



</body>
</html>
