@extends('merchant-1')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('contacts.index') }}">Contacts</a></li>
      </ul>
    </div>
  </div>
</div>



    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                  <div class="row">
                      <div class="form-group col-md-12 ">

                        <a href="{{ route('all-contacts-export') }}">
                            <button class="btn btn-primary btn-block btn-lg">Export All Contacts</button>
                        </a>
                      </div>
                  </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('import-script')
    <script src="{{ asset('assets/admin/js/bootstrap-fileinput.js') }}"></script>
@stop
@section('script')
    <script src="{{ asset('assets/admin/js/nicEdit-latest.js') }}"></script>

    <script>
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area1'); });
    </script>
@stop
