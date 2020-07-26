@extends('bills')


@section('body')

<!-- Page Wrapper -->
  <div class="page-wrapper">
      <div class="content container-fluid">

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Saved Bills</li>
      </ul
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('bills.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Bill</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->



<div class="row staff-grid-row">

  @if(count($bills) >0)
      @foreach($bills as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="profile-img">
                <a href="{{ route('bills.edit',$data) }}" class="avatar"><img src="{{ $data->biller->biller_image }}" alt="{{ $data->bill_owner }} | {{ $data->biller->biller_name }} " width="80px" height="80px"></a>
              </div>
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" data-toggle="modal" onclick="payBill({{ $data->id }},'{{ $data->biller->biller_name}}' ,'{{ $data->bill_account_number}}');" data-target="#PayBill"><i class="la la-money m-r-5"></i> Pay Bill</a>
                  <a class="dropdown-item" href="{{ route('bills.edit',$data) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" onclick="deleteBill({{ $data->id }})"  data-target="#DeleteBill"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{ $data->biller->biller_name}}</a></h4>
              <div class="small text-muted">{{$data->bill_owner}}</div>
              <div class="small text-muted">{{$data->bill_account_number}}</div>
              <div class="small text-muted">
                <a href="#" title="Pay Bill"  data-toggle="modal" onclick="payBill({{ $data->id }},'{{ $data->biller->biller_name}}' ,'{{ $data->bill_account_number}}');" data-target="#PayBill">
                <i style="color:purple;" class="la la-money" aria-hidden="true"></i>
              </a>
               <a title="Delete Bill" data-toggle="modal" onclick="deleteBill({{ $data->id }})"  data-target="#DeleteBill">
                <i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>
              </a>
              </div>
              <br>
              <br>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <center> You don't have any Saved Bills!!</center>
      </div>

      @endif



</div>

<!-- Delete Bill -->

<div id="DeleteBill" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('delete-bill') }}" id="send-pm">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='delete_bill_id' value=""/>
          Are you sure you want delete this Bill?
        <div>
        </div>
<br>
  <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- End Delete Bill -->

<!-- Pay Bill -->
<div class="modal fade" id="PayBill" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pay Bill "<strong><span id="pay_bill_name"></span></strong>"</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('bill.preview') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="pay_bill_id" value="">
                    <label><strong>Account Number</strong>
                        <span id="bill_account_number" class="modal-msg">
                            <br>
                           <code
                               class="font-weight-bold">Charged 0 {{$basic->currency}}
                               + 0%</code>
                    </span>
                    </label>
                    <hr/>

                    <div class="input-group input-group-lg mb-3">

                        <input type="text" class="form-control " name="amount" placeholder="0.00"
                               aria-label="amount"
                               onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"
                               placeholder=" Enter Amount" required>
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                  id="basic-addon1">{{$basic->currency}}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ">Preview</button>
                    <button type="button" class="btn btn-danger " data-dismiss="modal">Close
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Pay Bill -->


      <script>
      function  deleteBill(id){
          $('#delete_bill_id').val(id);
        }

      function payBill(id,name,account){
          $('#pay_bill_id').val(id);
          $('#pay_bill_name').html(name);
            $('#bill_account_number').html(account);
      }
      </script>
              </div>
      </div>

@endsection
