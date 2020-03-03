@extends('merchant')
@section('content')



    <div class="app-title">
        <div>
            <h1><i class="fa fa-donate"></i> My Support Tickets</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Support Tickets</a></li>
        </ul>
    </div>




    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">All {{$page_title}}

                    <a href="{{ route('user.ticket.open')}}" class="btn btn-success btn-md pull-right ">
                        <i class="fa fa-plus"></i> Open New Support Ticket
                    </a>

                </h3>
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Ticket Number</th>
                                <th>Subject</th>
                                <th>Status</th>
                                <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $key => $support)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $support->created_at->format('d F, Y h:i A') }}</td>
                                    <td>#{{ $support->ticket }}</td>
                                    <td>{{ $support->subject }}</td>
                                    <td>
                                        @if($support->status == 0)
                                            <span class="badge badge-primary">Open</span>
                                        @elseif($support->status == 1)
                                            <span class="badge badge-success "> Answered</span>
                                        @elseif($support->status == 2)
                                            <span class="badge badge-info "> Customer Replied</span>
                                        @elseif($support->status == 3)
                                            <span class="badge badge-danger ">Closed</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('user.message', $support->ticket) }}" class="edit ">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                        </table>

                        {{$supports->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>





    @stop
