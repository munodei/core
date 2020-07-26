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
        <li class="breadcrumb-item active">Declation</li>
      </ul>
    </div>

  </div>
</div>
<!-- /Page Header -->



<div class="row staff-grid-row">

          <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
            <p>
             I, the undelined, being duly authorised to sign this application, herby certify that the information in  this document isaccurate and complete as at the date of application.
            </p>
            <p>
             I, on behalf of the applicant, undestan that it is an offense in the terms od Section 21 of the Housing Consumer Protection Measure Act to knowingly withhold information or to turnish information that I know to be false or misleading required in ther termss of this Act. I aslso know that on conviction of such an offense, I, or the directors, trustees, managing directors, managing members or offices of the applicant home builder may be subject to a not exceedin R25 000 or improsentment not exceeding one year on each charge.
            </p>
            <p>
             I understand that the applicant home builder must comply with the terms of the Housing Consumer Protection measures Act and any subsequent regulations issued in terms of this Act.
            </p>
            <p>
             I hereby authorise the Council to make such enquiries as necessary to verify the information containd in this form.
            </p>
            <p>
             I herby attach my application fee.
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
