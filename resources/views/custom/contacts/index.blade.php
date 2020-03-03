@extends('custom.admin')

@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-users"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Manage contacts</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-title-w-btn">
                    <h3 class="title">{{$page_title}}</h3>
                    <a class="btn btn-primary icon-btn" href="{{route('contacts.create')}}"><i class="fa fa-plus"></i>Add contacts  </a>
                </div>

                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover order-column" id="">
                            <thead>
                            <tr>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col"> Email</th>
                                <th scope="col">Crreated</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($contacts) >0)
                                @foreach($contacts as $k=>$data)
                                    <tr>
                                        <td data-label="Username">
                                            <a href="{{route('user.single', $data->id)}}">
                                                {{$data->firstname}}
                                            </a>
                                        </td>
                                        <td data-label="Email">{{$data->lastname}}</td>
                                        <td data-label="Phone">{{$data->mobilephone}}</td>
                                        <td data-label="Amount"><strong>{{$data->email}}</strong></td>

                                        <td data-label="Time">
                                            {!! date(' d M, Y h:i A', strtotime($data->created_at)) !!} </td>
                                        <td data-label="Action">
                                            <a href="{{ route('contact', [$data]) }}" class="btn btn-outline-primary btn-sm ">
                                                <i class="fa fa-eye"></i> Info
                                            </a>
                                            <a href="{{ route('contacts.edit', $data->id) }}" class="btn btn-outline-success btn-sm ">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('contacts.destroy', $data->id) }}" class="btn btn-outline-danger btn-sm ">
                                                <i class="fa fa-edit"></i> Delete
                                            </a>

                                        </td>
                                    </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6"> You don't have any Contacts!!</td>
                                </tr>

                            @endif
                            <tbody>
                        </table>

                        {{$contacts->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
