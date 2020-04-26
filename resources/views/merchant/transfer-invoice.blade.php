@extends('merchant-1')
@section('css')
@stop
@section('content')

              					<!-- Page Header -->
              					<div class="page-header">
              						<div class="row align-items-center">
              							<div class="col">
              								<h3 class="page-title">{{ $page_title }}</h3>
              								<ul class="breadcrumb">
              									<li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
              									<li class="breadcrumb-item active">Transfer Invoice</li>
              								</ul>
              							</div>
              							<div class="col-auto float-right ml-auto">
              								<div class="btn-group btn-group-sm">
              									<a href="javascript:window.print()"<button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button></a>
              								</div>
              							</div>
              						</div>
              					</div>
              					<!-- /Page Header -->

              					<div class="row">
              						<div class="col-md-12">
              							<div class="card">
              								<div class="card-body">
              									<div class="row">
              										<div class="col-sm-6 m-b-20">
              											<img src="{{asset('assets/images/logo/logo.png')}}" class="inv-logo" alt="">
              				 							<ul class="list-unstyled">
              												<li>{{ $basic->sitename }}</li>
              												<li>{{ $basic->address }}</li>
              												<li>{{ $basic->phone }}</li>
              												<li>{{ $basic->email }}</li>
              											</ul>
              										</div>
              										<div class="col-sm-6 m-b-20">
              											<div class="invoice-details">
              												<h3 class="text-uppercase">Transaction No. {{$invoice->trx}}</h3>
              												<ul class="list-unstyled">
              													<li>Date created: <span> {{ date('F j, Y',strtotime($invoice->created_at)) }}</span></li>

              												</ul>
              											</div>
              										</div>
              									</div>
              									<div class="row">
              										<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
              											<h5>Sender Details:</h5>
              				 							<ul class="list-unstyled">
              												<li>Name:<span> {{ $invoice->sender_name }}</span></li>
              												<li>Phone: <span>{{ $invoice->sender_phone }}</span></li>
                                      <li>Email: <span>{{ $invoice->sender_address }}</span></li>
              												<li>Merchant ID: <span>{{ $invoice->merchant_id }}</span></li>
              											</ul>
              										</div>
              										<div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
              											<span class="text-muted">Recipient Details:</span>
              											<ul class="list-unstyled invoice-payment-details">
              												<li><h5>Total Transferred: <span class="text-right">{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</span></h5></li>
              												<li>Name: <span> {{$invoice->name}}</span></li>
              												<li>Phone: <span>{{$invoice->phone}}</span></li>
                                      <li>Email: <span>{{$invoice->address}}</span></li>
                                      <li>Merchant ID: <span>{{ $invoice->recipient_id }}</span></li>

              											</ul>
              										</div>
              									</div>
              									<div class="table-responsive">
              										<table class="table table-striped table-hover">
              											<thead>
              												<tr>
              													<th>#</th>
              													<th>ITEM</th>
              													<th class="d-none d-sm-table-cell">DESCRIPTION</th>
              													<th>UNIT COST</th>
              													<th>QUANTITY</th>
              													<th class="text-right">TOTAL</th>
              												</tr>
              											</thead>
              											<tbody>

              												<tr>
              													<td>1</td>
              													<td>Internal Money Transfer</td>
              													<td class="d-none d-sm-table-cell">TrivieCash Internal Money Transfer</td>
              													<td>{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</td>
              													<td>1</td>
              													<td class="text-right">{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</td>
              												</tr>

              											</tbody>
              										</table>
              									</div>
              									<div>
              										<div class="row invoice-payment">
              											<div class="col-sm-7">
              											</div>
              											<div class="col-sm-5">
              												<div class="m-b-20">
              													<div class="table-responsive no-border">
              														<table class="table mb-0">
              															<tbody>
              																<tr>
              																	<th>Total Transferred:</th>
              																	<td class="text-right">{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2)}}</td>
              																</tr>
              																<tr>
              																	<th>Transfer Fee: <span class="text-regular">(1%)</span></th>
              																	<td class="text-right">{{$invoice->toCurrency->code}} {{ number_format($invoice->to_currency_amo,2) * 0.01}}</td>
              																</tr>
              																<tr>
              																	<th>Total Deducted:</th>
              																	<td class="text-right text-primary"><h5>{{$invoice->toCurrency->code}} {{number_format($invoice->to_currency_amo,2) + (number_format($invoice->to_currency_amo,2) * 0.01) }}</h5></td>
              																</tr>
              															</tbody>
              														</table>
              													</div>
              												</div>
              											</div>
              										</div>
              										<div class="invoice-info">
              											<h5>Other information</h5>
              											<p class="text-muted">Thank you for using {{$basic->sitename}}</p>
              										</div>
              									</div>
              								</div>
              							</div>
              						</div>
              					</div>




@endsection

@section('script')

@endsection
