@extends('merchant')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/front/css/print.css')}}">
@stop

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-money"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title">  Payout Now</h3>

                <section class="invoice">
  
                    <div class="row invoice-info text-center">
                        <div class="col-md-6 offset-md-3">
                            <address><h3 class="green">Your {{$basic->sitename}} Transaction No  : <span
                                        class="red">{{$invoice->trx}}</span></h3><br>

                                <h6>You have receive amount
                                    <span class="padding-left-10 red">{{number_format($invoice->to_currency_amo,2)}} {{$invoice->toCurrency->code}} </span>
                                </h6>
                                <h6> Name: <span class="padding-left-10 red">{{$invoice->name}}</span> </h6>
                                <h6>Contact Number : <span class="padding-left-10 red">{{$invoice->phone}}</span></h6><br><br>
                                <h6>Thank you for using {{$basic->sitename}}</h6>
                            </address>
                        </div>

                        <div class="col-md-4 offset-md-4 ">
                            <button class="btn btn-lg btn-primary btn-block print-button confirm-button " data-id="{{$invoice->id}}" data-toggle="modal" data-target="#exampleModal"></i>  Payout Now</button>
                        </div>
                    </div>
<br>
<br>
<br>

                </section>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Payout Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure want to payout this amount ???</strong>
                </div>
                <form action="{{route('withdrawConfirm')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" class="invoice-id">
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('script')

    <script>
        $( document ).ready(function() {
            $(".confirm-button").on('click', function () {
              var id =  $(this).data('id');
              $('.invoice-id').val(id);
            });
        });
    </script>

@endsection
