@extends('user')
@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg white-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <h1 class="title">{{$page_title}}</h1>
                    </div><!-- //.breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <div class="testimonial-page-conent">
        <div class="container">
            <div class="row">

                <table class="table table-default table-responsive">
                    <thead>
                    <tr>
                        <th scope="col">Transaction Number</th>
                        <th scope="col">Send Amount </th>
                        <th scope="col">Recipient</th>
                        <th scope="col">Receive Amount</th>
                        <th scope="col"> Send Date</th>
                        <th scope="col"> Received Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Invoice</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($sendMoney) >0)
                        @foreach($sendMoney as $k=>$data)
                            <tr>
                                <td data-label="Transaction Number">{{isset($data->trx ) ? $data->trx  : '-'}}</td>
                                <td data-label="Send Amount"><strong>{!! isset($data->from_currency_amo) ? $data->from_currency_amo : '-' !!} {!! $data->fromCurrency->code !!}</strong></td>

                                <td data-label="Recipient">{{isset($data->name) ? $data->name : '-'}} </td>
                                <td data-label="Receive Amount"><strong>{!! isset($data->to_currency_amo) ? $data->to_currency_amo : '-' !!} {!! $data->toCurrency->code !!}</strong></td>
                                <td data-label="Date Send">
                                    {!! date('d  M, Y  h:i A', strtotime($data->created_at)) !!}
                                </td>
                                <td data-label="Date Received">
                                    @if($data->received_at != null)
                                        {!!  date('d  M, Y  h:i A', strtotime($data->received_at)) !!}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td data-label="Status">
                                    @if($data->status == 2)
                                        <span  class="badge  badge-pill  badge-success "> completed </span>
                                    @elseif($data->status == 1)
                                        <span class="badge  badge-pill  badge-danger ">Pending </span>
                                    @endif
                                </td>
                                <td data-label="Status">
                                    <a href="{{route('send.invoice',$data->trx)}}" class="btn btn-info btn-sm"><i class="fa fa-file" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"> No data found !!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="post-navigation">
                    <ul class="pagination">
                        {{ $sendMoney->links('partials.pagination') }}
                    </ul>
                </div>

            </div>
        </div>
    </div>





@stop
