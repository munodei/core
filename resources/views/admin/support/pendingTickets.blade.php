@extends('admin')
@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-question-circle"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Pending Support Tickets</h3>
                <div class="card-body">
                <table class="table table-hover table-responsive-lg">
                    <thead>
                    <tr>
                        <th>Username</th>
                        <th>Ticket</th>
                        <th>Subject</th>
                        <th>status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td><a href="{{ route('user.single', $item->user_id)}}"> {{$item->user->username}}</a></td>
                            <td>{{ $item->ticket }} </td>
                            <td>{{ $item->subject }} </td>
                            <td>
                                @if($item->status == 0)
                                    <p class="btn badge-info custom-btn-badge">New Ticket</p>
                                @elseif($item->status == 2)
                                    <p class="btn badge-success custom-btn-badge">Customer Replied</p>
                                @endif
                            </td>
                            <td>{{ $item->created_at->format('d F, Y H:i A') }}</td>
                            <td>
                                <a href="{{ route('admin.ticket.reply', $item->id) }}" class="btn btn-info "><i
                                            class="fa fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>

    @stop
