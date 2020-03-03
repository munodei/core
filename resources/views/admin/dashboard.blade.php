@extends('admin')

@section('body')

    @php
        $totalusers = \App\User::count();
       $banusers = \App\User::where('status',0)->count();
       $verifiedPhone = \App\User::where('phone_verify',1)->count();
       $verifiedEmail = \App\User::where('email_verify',1)->count();
       $activeusers = \App\User::where('status',1)->count();

        $gateway =  App\Gateway::count();
        $deposit =  App\Deposit::whereStatus(1)->count();
        $totalDeposit =  App\Deposit::whereStatus(1)->sum('amount');

        $blog =App\Post::count();
        $subscribers =App\Subscriber::count();
        $country =App\Country::count();

//SupportMessage

$totalSupportTicket = App\SupportMessage::count();
$ticketPending = App\SupportMessage::whereIn('type',[0,2])->count();
    @endphp

    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
        </ul>
    </div>



    <div class="tile">
      <h3 class="tile-title"><i class="fa fa-users"></i> User Statistics</h3>
            
        <div class="row tile-body">

            <div class="col-lg-3">
                <a href="{{route('users')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-info  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Total Users</h3>
                                    <h5>{{$totalusers}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3">
                <a href="{{route('users')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-success  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Email Verified Users</h3>
                                    <h5>{{$verifiedEmail}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('users')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-dark  text-center">
                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Phone Verified Users</h3>
                                    <h5>{{$verifiedPhone}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3">
                <a href="{{route('user.ban')}}" class="text-decoration">
                    <div class="bs-component">
                        <div class="card mb-3 text-white  bg-danger  text-center">

                            <div class="card-body">
                                <blockquote class="card-blockquote">
                                    <h3>Ban Users </h3>
                                    <h5>{{$banusers}} </h5>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>




    <div class="row">
        <div class="col-md-6 ">
            <div class="tile  mb-4">
                <h3 class="tile-title"><i class="fa fa-th"></i> Deposit Statistics</h3>

                <div class="row tile-body">

                    <div class="col-lg-6">
                        <a href="{{route('gateway')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-dark  text-center">

                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Deposit Method</h3>
                                            <h5>{{$gateway}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{route('deposits')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-primary  text-center">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Number Of Deposit </h3>
                                            <h5>{{$deposit}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="tile mb-4">
                <h3 class="tile-title"><i class="fa fa-question"></i> Support Ticket</h3>

                <div class="row tile-body">

                    <div class="col-lg-6">
                        <a href="{{route('admin.ticket')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-info  text-center">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Total Support Ticket</h3>
                                            <h5>{{$totalSupportTicket}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <a href="{{route('admin.pending.ticket')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-warning  text-center">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Pending Support Ticket</h3>
                                            <h5>{{$ticketPending}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">

        <div class="col-md-12 ">
            <div class="tile mb-4">
                <h3 class="tile-title"><i class="fa fa-th"></i> Other Info</h3>

                <div class="row tile-body">
                    <div class="col-lg-4">
                        <a href="{{route('country.index')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-info  text-center">

                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Total Country</h3>
                                            <h5>{{$country}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                    <div class="col-lg-4">
                        <a href="{{route('admin.blog')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-dark  text-center">

                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Total Blogs</h3>
                                            <h5>{{$blog}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4">
                        <a href="{{route('manage.subscribers')}}" class="text-decoration">
                            <div class="bs-component">
                                <div class="card mb-3 text-white  bg-primary  text-center">
                                    <div class="card-body">
                                        <blockquote class="card-blockquote">
                                            <h3>Total Subscribers </h3>
                                            <h5>{{$subscribers}} </h5>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>


    </div>



    @php

        /*
            $sell =  \App\Subscriber::whereYear('created_at', '=', date('Y'))->get()->groupBy(function($d) {
                  return $d->created_at->format('F');
               });
               $monthly_sell = [];
               $month = [];
               foreach ($sell as $key => $value) {
                $monthly_sell[] = count($value);
                $month[] = $key;
               }
        */
    @endphp




@endsection

@section('script')
    <script type="text/javascript" src="{{asset('assets/admin/js/chart.js')}}"></script>
    <script type="text/javascript">
        var data = {
            labels:  {{-- json_encode($month) --}},
            datasets: [
                {
                    label: "My Second dataset",
                    fillColor: "rgba(151,187,205,0.2)",
                    strokeColor: "rgba(151,187,205,1)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data: {{--- json_encode($monthly_sell) --}},
                }
            ]
        };


        var ctxl = $("#lineChartDemo").get(0).getContext("2d");
        var lineChart = new Chart(ctxl).Line(data);

    </script>

@stop

