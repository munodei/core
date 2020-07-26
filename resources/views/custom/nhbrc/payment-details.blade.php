@extends('nhbrc')


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
        <li class="breadcrumb-item active">Payment Details</li>
      </ul>
    </div>

  </div>
</div>
<!-- /Page Header -->



<div class="row staff-grid-row">


          <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
            <p>
              To process your application, a payment of R750 must be received. if it is not received, your application will not be processed. this application fee is non-refundable. you may wish to ay the anual registration fee (an additional R600-00) at the same tie. this will assist in speeding up the prcess once your application is approved. if your application is rejected, this anual registration fee will be refunded.
            </p>
            <br>
            <p>
              Bank : First National Bank
            </p>
            <p>
              Account Number : 62081366520
            </p>
            <p>
              Branch code : 255005
            </p>
          </div>




</div>


      <script>
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>
              </div>
      </div>

@endsection
