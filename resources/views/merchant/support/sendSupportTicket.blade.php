@extends('merchant')
@section('content')

    <div class="app-title">
        <div>
            <h1><i class="fa fa-question-circle"></i> Open support ticket</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">Support Tickets</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Open support ticket</h3>
                
                <div class="tile-body all-settings">
                    <form method="post" action="{{ route('user.ticket.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="all-settings">
                                    <div class="area-title">
                                        <h3><span><i class="icofont-question-circle"></i></span>Open support ticket</h3>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-8 offset-md-2">
                                            @include('errors.error')
                                        </div>
                                        <div class="col-lg-8 offset-md-2">
                                            <div class="single-settings">
                                                <h5> Subject</h5>
                                                <input type="text" name="subject" class="form-control-lg form-control" placeholder="Subject">
                                            </div>
                                        </div>
                                        <div class="col-lg-8 offset-md-2">

                                            <br><br>
                                            <div class="single-settings">
                                                <h5>Your Message</h5>
                                                <textarea class="form-control form-control-lg" name="message" rows="8"></textarea>

                                            </div>
                                        </div>
                                        <div class="form-group col-lg-8 offset-md-2">
                                            <br><br>
                                            <button class="btn btn-lg btn-primary btn-block " type="submit">Send</button>
                                        </div>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>





@stop
