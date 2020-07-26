@extends('nhbrc')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
      <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('nhbrc-director-details.index') }}">Company Directors</a></li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('nhbrc-director-details.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Company Director</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('nhbrc-director-details.update',$directors)}}" name="editForm" enctype="multipart/form-data">
                        @csrf
                         {{ method_field('put') }}
                        <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">
                        <div class="row">

                            <div class="form-group col-md-3">
                                <h5>Director Position</h5>
                                <div class="input-group">
                                    <select name="status" class="form-control form-control-lg">
                                        <option @if(old('status')==='Director' || $directors->status=="Director") selected @endif value="Director">Director</option>
                                        <option @if(old('status')==='Managing Director' || $directors->status=="Managing Director") selected @endif value="Managing Director">Managing Director</option>
                                        <option @if(old('status')==='Senior Management' || $directors->status=="Senior Management") selected @endif value="Senior Management">Senior Management</option>
                                    </select>
                                    </select>
                                </div>
                                @if ($errors->has('status'))
                                    <div class="error">{{ $errors->first('status') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-3">
                                <h5>Title</h5>
                                <div class="input-group">
                                    <select name="title" class="form-control form-control-lg">
                                        <option @if(old('title')==='Mr.'   || $directors->title==="Mr.") selected @endif value="Mr">Mr.</option> 
                                        <option @if(old('title')==='Eng.'   || $directors->title==="Eng.")  selected @endif value="Eng.">Eng.</option>
                                                                          
                                        <option @if(old('title')==='Miss.' || $directors->title==="Miss.") selected @endif value="Miss.">Miss.</option>
                                        <option @if(old('title')==='Mrs.'  || $directors->title==="Mrs.") selected   @endif value="Mrs.">Mrs.</option>
                                        <option @if(old('title')==='Prof.' || $directors->title==="Prof.") selected @endif value="Prof.">Prof.</option>
                                        <option @if(old('title')==='Lit.'  || $directors->title==="Lit.") selected  @endif value="Lit.">Lit.</option>
                                        <option @if(old('title')==='Gen.'  || $directors->title==="Gen.") selected  @endif value="Gen.">Gen.</option>
                                        <option @if(old('title')==='Cde.'  || $directors->title==="Cde.") selected  @endif value="Cde.">Cde.</option>
                                        <option @if(old('title')==='Sir.'  || $directors->title==="Sir.") selected  @endif value="Sir.">Sir.</option>
                                        <option @if(old('title')==='Dr.'   || $directors->title==="Dr.")  selected @endif value="Dr.">Dr.</option>
                                    </select>
                                </div>
                                @if ($errors->has('title'))
                                    <div class="error">{{ $errors->first('title') }}</div>
                                @endif
                            </div>

                            <input type="hidden" name="company_id" id="company_id" value="{{ $company->id }}">

                            <div class="form-group col-md-2">
                                <h5> Intials</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('intials') ?? $directors->intials ?? '' }}" class="form-control form-control-lg" placeholder="Director Intials" name="intials">
                                </div>
                                @if ($errors->has('intials'))
                                    <div class="error">{{ $errors->first('intials') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-4">
                                <h5>Surname</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('surname') ?? $directors->surname ?? '' }}" class="form-control form-control-lg" placeholder="Surname" name="surname">
                                </div>
                                @if ($errors->has('surname'))
                                    <div class="error">{{ $errors->first('surname') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5>Share Holding </h5>
                                <div class="input-group">
                                    <input type="text" name="shareholding" value="{{ old('shareholding') ?? $directors->shareholding ?? '' }}" class="form-control form-control-lg" placeholder="Share Holding" >
                                </div>
                                @if ($errors->has('shareholding'))
                                    <div class="error">{{ $errors->first('shareholding') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5>ID number </h5>
                                <div class="input-group">
                                    <input type="text" name="id_number" value="{{ old('id_number') ?? $directors->id_number ?? '' }}" class="form-control form-control-lg" placeholder=" Email Address" >
                                </div>
                                @if ($errors->has('id_number'))
                                    <div class="error">{{ $errors->first('id_number') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">

                                    <div class="form-group col-md-6">
                                        <h5>Email</h5>
                                        <div class="input-group">
                                            <input type="text" name="email" value="{{ old('email') ?? $directors->email ?? '' }}" class="form-control form-control-lg" placeholder="Email">
                                        </div>
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <h5>Contact Number </h5>
                                        <div class="input-group">
                                            <input type="text" name="contact_number" value="{{ old('contact_number') ?? $directors->contact_number ?? '' }}" class="form-control form-control-lg" placeholder="Contact Number" >
                                        </div>
                                        @if ($errors->has('contact_number'))
                                            <div class="error">{{ $errors->first('contact_number') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h4>Mailing Address</h4>
                                        <div class="input-group">
                                            <input type="text" name="address" value="{{ old('address') ?? $directors->address ?? '' }}" class="form-control form-control-lg" placeholder="Mailing Address" >
                                        </div>
                                        @if ($errors->has('address'))
                                            <div class="error">{{ $errors->first('address') }}</div>
                                        @endif
                                    </div>


                        </div>



                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Qualifications</h4>
                                <textarea name="qualifications" id="area1"  rows="10" class="form-control form-control-lg">{{ old('qualifications') ?? $directors->qualifications ?? '' }}</textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Experience</h4>
                                <textarea name="experience" id="area2"  rows="10" class="form-control form-control-lg">{{ old('experience') ?? $directors->experience ?? '' }}</textarea>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Update Company Director</button>
                            </div>
                        </div>

                    </form>
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
        bkLib.onDomLoaded(function() { new nicEditor({fullPanel : true}).panelInstance('area2'); });
    </script>
@stop
