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
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"> {{Auth::guard('admin')->user()->username}} <i class="fa fa-sort-desc fa-lg"></i> </a>
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
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" class="img-circle" src="{{asset('assets/admin/img/'.Auth::guard('admin')->user()->image)}}" alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::guard('admin')->user()->name }} </p>
            <p class="app-sidebar__user-designation">{{ Auth::guard('admin')->user()->username }}</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item @if(request()->path() == 'admin/dashboard') active @endif" href="{{route('admin.dashboard')}}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>

        <li><a class="app-menu__item @if(request()->path() == 'admin/merchant') active @endif" href="{{route('merchant.index')}}"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Manage Merchant </span></a></li>

        <li class="treeview @if(request()->path() == 'admin/continent') is-expanded
                @elseif(request()->path() == 'admin/country') is-expanded
                @elseif(request()->path() == 'admin/state') is-expanded
                @elseif(request()->path() == 'admin/city') is-expanded
                @elseif(request()->path() == 'admin/neighbourhood') is-expanded
                @elseif(request()->path() == 'admin/suburb') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-globe"></i><span class="app-menu__label">Manage Locations</span> <i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/continent') active @endif" href="{{route('continent.index')}}"><i class="icon fa fa-arrow-right"></i>   Continent</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/country') active @endif" href="{{route('country.index')}}"><i class="icon fa fa-globe"></i> Countries </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/state') active @endif" href="{{route('state.index')}}"><i class="icon fa fa-globe"></i> States </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/city') active @endif" href="{{route('city.index')}}"><i class="icon fa fa-globe"></i> Cities </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/neighbourhood') active @endif" href="{{route('neighbourhood.index')}}"><i class="icon fa fa-globe"></i> Neighbourhoods </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/suburb') active @endif" href="{{route('suburb.index')}}"><i class="icon fa fa-globe"></i> Suburbs </a></li>

            </ul>
        </li>

        <li class="treeview @if(request()->path() == 'admin/product') is-expanded
                @elseif(request()->path() == 'admin/outlet') is-expanded
                @elseif(request()->path() == 'admin/outlet-cat') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-globe"></i><span class="app-menu__label">Manage Outlets</span> <i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/outlet') active @endif" href="{{route('outlet.index')}}"><i class="icon fa fa-arrow-right"></i>   Outlets</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/outlet-cat') active @endif" href="{{route('outlet-cat.index')}}"><i class="icon fa fa-globe"></i> Outlet Categories </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/product') active @endif" href="{{route('product.index')}}"><i class="icon fa fa-globe"></i> Outlet Products </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/product-category') active @endif" href="{{route('product-category.index')}}"><i class="icon fa fa-globe"></i> Outlet Product Categories </a></li>
                    <li><a class="treeview-item @if(request()->path() == 'admin/outlet-cat-outlet') active @endif" href="{{route('outlet-cat-outlet.index')}}"><i class="icon fa fa-globe"></i>  Outlet Category RelationShips </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/product-sub-category') active @endif" href="{{route('product-sub-category.index')}}"><i class="icon fa fa-globe"></i>  Outlet Sub Product Categories </a></li>
            </ul>
        </li>



        <li class="treeview  @if(request()->path() == 'admin/users')  is-expanded
                @elseif(request()->path() == 'admin/user-banned')  is-expanded
                @elseif(request()->path() == 'admin/user/{user}')  is-expanded
                        @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Manage User</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/users') active @endif" href="{{route('users')}}"><i class="icon fa fa-user"></i> Users</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/user-banned') active @endif" href="{{route('user.ban')}}" rel="noopener"><i class="icon fa fa-ban"></i> Banned User</a></li>
            </ul>
        </li>


        <li class="treeview @if(request()->path() == 'admin/deposits') is-expanded
                @elseif(request()->path() == 'admin/gateway') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-credit-card"></i><span class="app-menu__label">Manage Deposit</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/deposits') active @endif" href="{{route('deposits')}}"><i class="icon fa fa-credit-card"></i> Deposit Log</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/gateway') active @endif" href="{{route('gateway')}}"><i class="icon fa fa-credit-card"></i> Deposit Method</a></li>
            </ul>
        </li>


        <li><a class="app-menu__item @if(request()->path() == 'admin/subscribers') active @endif" href="{{route('manage.subscribers')}}"><i class="app-menu__icon fa fa-thumbs-up"></i><span class="app-menu__label">All Subscribers</span></a></li>
        <li><a class="app-menu__item @if(request()->path() == 'admin/blog') active @endif" href="{{route('admin.blog')}}"><i class="app-menu__icon fa fa-newspaper-o"></i><span class="app-menu__label">Manage Blogs</span></a></li>


        <li class="treeview @if(request()->path() == 'admin/pendingSupportTickets') is-expanded
                @elseif(request()->path() == 'admin/supportTickets') is-expanded
                @endif ">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-question-circle"></i><span class="app-menu__label">Support Ticket </span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/pendingSupportTickets') active @endif" href="{{route('admin.pending.ticket')}}"><i class="icon fa fa-question-circle"></i> Pending Ticket </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/supportTickets') active @endif" href="{{route('admin.ticket')}}"><i class="icon fa fa-question-circle"></i> All Tickets </a></li>
            </ul>
        </li>


        <li class="treeview @if(request()->path() == 'admin/general-settings') is-expanded
                                @elseif(request()->path() == 'admin/template') is-expanded
                                @elseif(request()->path() == 'admin/sms-api') is-expanded
                                @elseif(request()->path() == 'admin/contact-setting') is-expanded
                            @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bars"></i><span class="app-menu__label">Website Control</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item @if(request()->path() == 'admin/general-settings') active @endif" href="{{route('admin.GenSetting')}}"><i class="icon fa fa-cogs"></i> General Setting </a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/template') active @endif" href="{{route('email.template')}}"><i class="icon fa fa-envelope"></i> Email Setting</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/sms-api') active @endif" href="{{route('sms.api')}}"><i class="icon fa fa-mobile"></i> SMS Setting</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/contact-setting') active @endif" href="{{route('contact-setting')}}"><i class="icon fa fa-phone"></i> Contact Setting </a></li>
            </ul>
        </li>


        <li class="treeview     @if(request()->path() == 'admin/manage-logo') is-expanded
                                @elseif(request()->path() == 'admin/testimonial') is-expanded
                                @elseif(request()->path() == 'admin/faqs') is-expanded
                                @elseif(request()->path() == 'admin/about') is-expanded
                                @elseif(request()->path() == 'admin/achievement') is-expanded
                                @elseif(request()->path() == 'admin/menu-control') is-expanded
                                @elseif(request()->path() == 'admin/manage-social') is-expanded
                                @elseif(request()->path() == 'admin/manage-logo') is-expanded
                                @elseif(request()->path() == 'admin/manage-text') is-expanded
                            @endif">
            <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-desktop"></i><span class="app-menu__label">Interface Control</span><i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li><a class="treeview-item  @if(request()->path() == 'admin/manage-logo') active @endif " href="{{route('manage-logo')}}"><i class="icon fa fa-file-image-o"></i> Manage Logo  </a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/manage-text') active @endif " href="{{route('manage-footer')}}"><i class="icon fa fa-file-text"></i>  Section & footer Text  </a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/testimonial') active @endif " href="{{route('admin.testimonial')}}"><i class="icon fa fa-quote-left"></i> Testimonials  </a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/faqs') active @endif " href="{{route('faqs-all')}}"><i class="icon fa fa-question-circle"></i> Manage Faq  </a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/faqs') active @endif " href="{{route('service-faqs')}}"><i class="icon fa fa-question-circle"></i> Service Faq  </a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/about') active @endif " href="{{route('admin.about')}}"><i class="icon fa fa-info-circle"></i> Manage About</a></li>
                <li><a class="treeview-item  @if(request()->path() == 'admin/achievement') active @endif " href="{{route('admin.achievement')}}"><i class="icon fa fa-trophy"></i> Manage Achievement</a></li>
                <li><a class="treeview-item @if(request()->path() == 'admin/menu-control') active @endif " href="{{route('menu-control')}}"><i class="icon fa fa-list"></i> Menu Controls </a></li>

                <li><a class="treeview-item @if(request()->path() == 'admin/manage-social') active @endif" href="{{route('manage-social')}}"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label"> Manage Social </span></a></li>


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
