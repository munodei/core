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
                    <form role="form" method="POST" action="{{ route('contacts-import-save') }}" name="editForm" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="form-group col-md-12">
                                <h5> Google Contacts Import ( Attach Google Contacts CSV from your Google Contacts, make sure the contacts selected have email addresses)</h5>
                                <div class="input-group">
                                    <input type="file" name="google_contacts" value="{{ old('google_contacts') }}" class="form-control form-control-lg"  >
                                </div>
                                @if ($errors->has('google_contacts'))
                                    <div class="error">{{ $errors->first('google_contacts') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-12">
                                <h5>Outlook Contacts Import (Attach Outlook Contacts CSV from your Google Contacts, make sure the contacts selected have email addresses)</h5>
                                <div class="input-group">
                                    <input type="file" value="{{ old('outlook_contacts') }}" class="form-control form-control-lg" name="outlook_contacts">
                                </div>
                                @if ($errors->has('outlook_contacts'))
                                    <div class="error">{{ $errors->first('outlook_contacts') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h5>Ordinary Contacts Import (Attach CSV/ XLSX or XLS file with contacts arranged as advised) </h5>
                                <div class="input-group">
                                    <input type="file" name="ordinary_contacts" value="{{ old('ordinary_contacts')}}" class="form-control form-control-lg" >
                                </div>
                                @if ($errors->has('ordinary_contacts'))
                                    <div class="error">{{ $errors->first('ordinary_contacts') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Upload Contacts</button>
                            </div>
                        </div>
                    </form>
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
