@extends('custom.admin')

@section('import-css')
    <link href="{{ asset('assets/admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@stop
@section('body')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-plus"></i> {{$page_title}}</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{url()->current()}}">{{$page_title}}</a></li>
        </ul>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title ">{{$page_title}}
                    <a href="{{route('contacts.index')}}" class="btn btn-primary btn-md pull-right ">
                        <i class="fa fa-eye"></i> All contacts
                    </a>
                </h3>
                <div class="tile-body">
                    <form role="form" method="POST" action="{{route('update-contact',[$contact])}}" name="editForm" enctype="multipart/form-data">
                        @csrf


                        <div class="row">

                            <div class="form-group col-md-6">
                                <h5> First Name</h5>
                                <div class="input-group">
                                    <input type="text" name="firstname" value="{{ old('firstname') ?? $contact->firstname ?? '' }}" class="form-control form-control-lg" placeholder="First Name" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('firstname'))
                                    <div class="error">{{ $errors->first('firstname') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5> Last Name</h5>
                                <div class="input-group">
                                    <input type="text" value="{{ old('lastname') ?? $contact->lastname ?? '' }}" class="form-control form-control-lg" placeholder="Last Name" name="lastname">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('lastname'))
                                    <div class="error">{{ $errors->first('lastname') }}</div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <h5>Mobile workphone </h5>
                                <div class="input-group">
                                    <input type="text" name="mobilephone" value="{{ old('mobilephone') ?? $contact->mobilephone ?? '' }}" class="form-control form-control-lg" placeholder=" Mobile workphone" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-workphone"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('mobilephone'))
                                    <div class="error">{{ $errors->first('mobilephone') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <h5> Email </h5>
                                <div class="input-group">
                                    <input type="email" name="email" value="{{ old('email') ?? $contact->email ?? '' }}" class="form-control form-control-lg" placeholder=" Email Address" >
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <h5> Work phone </h5>
                                        <div class="input-group">
                                            <input type="text" name="workphone" value="{{ old('workphone') ?? $contact->workphone ?? '' }}" class="form-control form-control-lg" placeholder="Work Phone Number">
                                            <div class="input-group-append"><span class="input-group-text"><i class="fa fa-workphone"></i></span></div>
                                        </div>
                                        @if ($errors->has('workphone'))
                                            <div class="error">{{ $errors->first('workphone') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> City </h5>
                                        <div class="input-group">
                                            <input type="text" name="city" value="{{ old('city') ?? $contact->city ?? '' }}" class="form-control form-control-lg" placeholder=" City" >
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-location-arrow"></i></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('city'))
                                            <div class="error">{{ $errors->first('city') }}</div>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h5> Zip Code </h5>
                                        <div class="input-group">
                                            <input type="text" name="zip_code" value="{{ old('zip_code') ?? $contact->zip_code ?? '' }}" class="form-control form-control-lg" placeholder="Zip Code">
                                            <div class="input-group-append"><span class="input-group-text">Zip Code</span></div>
                                        </div>
                                        @if ($errors->has('zip_code'))
                                            <div class="error">{{ $errors->first('zip_code') }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="form-group col-md-6">
                                <h4>Address</h4>
                                <textarea name="address" placeholder="Write Address" rows="8" class="form-control form-control-lg"> {{ old('address') ?? $contact->address ?? '' }}</textarea>
                            </div>


                        </div>

                        <div class="row">                    
                            <div class="form-group col-md-12 ">
                                    <label><strong>Country</strong></label>

                                    <select name="country_id" class="form-control form-control-lg" >
                                        <option value="">Select Country</option>
                                        @foreach($country as $data)
                                        <option value="{{$data->id}}" @if($data->id == $contact->country_id) selected @endif>{{$data->name}}</option>
                                            @endforeach

                                    </select>
                            </div>
                        </div>



                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Image</h4>
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;" data-trigger="fileinput">
                                        <img style="width: 200px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=Image" alt="...">

                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px"></div>
                                    <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="photo" accept="image/*" >
                                                </span>
                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                    </div>
                                </div>
                                @if ($errors->has('image'))
                                    <div class="error">{{ $errors->first('image') }}</div>
                                @endif

                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-12">
                                <h4>Others Info</h4>
                                <textarea name="about" id="area1"  rows="10" class="form-control form-control-lg">{{ old('about') ?? $contact->about ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12 ">
                                <button class="btn btn-primary btn-block btn-lg">Save New Contact</button>
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
