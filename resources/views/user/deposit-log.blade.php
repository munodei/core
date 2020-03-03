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
                        <th scope="col">SL</th>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Details</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Time</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(count($invests) >0)
                        @foreach($invests as $k=>$data)
                            <tr>
                                <td data-label="SL">{{++$k}}</td>
                                <td data-label="#Trx">{{isset($data->trx ) ? $data->trx  : 'N/A'}}</td>
                                <td data-label="Details">{{isset($data->gateway->name) ? $data->gateway->name : 'N/A'}} </td>
                                <td data-label="Amount">{!! isset($data->amount) ? $data->amount : 'N/A' !!} {!! $basic->currency !!}</td>
                                <td data-label="Time">
                                    {!! date(' d M, Y h:s A', strtotime($data->created_at)) !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5"> No records found!!</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <div class="post-navigation">
                    <ul class="pagination">
                        {{ $invests->links('partials.pagination') }}
                    </ul>
                </div>

            </div>
        </div>
    </div>





@stop
