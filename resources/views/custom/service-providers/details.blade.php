@extends('merchant-1')

@section('css')
<meta property="og:image" content="{{$photo->meta_value ?? 'images/user/user-default.png' }}" />
<meta property="og:image:secure_url" content="{{$photo->meta_value ?? 'images/user/user-default.png' }}" />
<meta property="og:image:type" content="image/jpeg" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | Service Provider | {!! $post->post_title !!}" />
<meta property="og:description" content="{{ $basic->sitename }},  Supported Frnachise, {!! $post->post_title !!}" />
@endsection
@section('content')
    {!! $basic->fb_comment !!}
    <div class="content container-fluid">
        
          <!-- Page Header -->
      <div class="page-header">
        <div class="row align-items-center">
          <div class="col">
            <h3 class="page-title">{!! $post->post_title !!}</h3>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('essential_service_providers.all') }}">Service Providers</a></li>
            </ul>
          </div>
        </div>
      </div>
<!-- /Page Header -->
          
          <div class="card mb-0">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="profile-view">
                    <div class="profile-img-wrap">
                      <div class="profile-img">
                        <a href="#"><img alt="" src="{{ url('/')}}/assets/{{$photo->meta_value ?? 'images/user/user-default.png' }}" width="300px" height="300px"></a>
                      </div>
                    </div>
                    <div class="profile-basic">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="profile-info-left">
                            <h3 class="user-name m-t-0 mb-0">  {{ $post->service_provider_user->display_name }}</h3>
                            <h6 class="text-muted">{!! $post->post_title !!}</h6>
                            <div class="staff-msg"><a class="btn btn-custom" data-target="#contact" data-toggle="modal"  href="#">Contact</a>&nbsp;<a class="btn btn-primary" data-target="#endorse" data-toggle="modal"  href="#">Endorse</a>&nbsp;<a class="btn btn-success" data-target="#review" data-toggle="modal"  href="#">Review</a></div>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <ul class="personal-info">
                            <li>
                              <div class="title">Status:</div>
                              <div class="text"><a href="">Verified</a></div>
                            </li>
                            <li>
                              <div class="title">Level:</div>
                              <div class="text"><a href="">Level One Service Provider</a></div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card tab-box">
            <div class="row user-tabs">
              <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                <ul class="nav nav-tabs nav-tabs-bottom">
                  <li class="nav-item"><a href="#emp_profile" data-toggle="tab" class="nav-link active">Profile</a></li>
                  <li class="nav-item"><a href="#emp_projects" data-toggle="tab" class="nav-link">Portfolio</a></li>
                  <li class="nav-item"><a href="#bank_statutory" data-toggle="tab" class="nav-link">Reviews</a></li>
                  <li class="nav-item"><a href="#endorsements" data-toggle="tab" class="nav-link">Endorsements</a></li>
                </ul>
              </div>
            </div>
          </div>
          
          <div class="tab-content">
          
            <!-- Profile Info Tab -->
            <div id="emp_profile" class="pro-overview tab-pane fade show active">

              <div class="row">
                <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                    <div class="card-body">
                      <h3 class="card-title">Education Informations </h3>
                      <div class="experience-box">
                        <ul class="experience-list">
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name">International College of Arts and Science (UG)</a>
                                <div>Bsc Computer Science</div>
                                <span class="time">2000 - 2003</span>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name">International College of Arts and Science (PG)</a>
                                <div>Msc Computer Science</div>
                                <span class="time">2000 - 2003</span>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 d-flex">
                  <div class="card profile-box flex-fill">
                    <div class="card-body">
                      <h3 class="card-title">Experience </h3>
                      <div class="experience-box">
                        <ul class="experience-list">
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name">Web Designer at Zen Corporation</a>
                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name">Web Designer at Ron-tech</a>
                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="experience-user">
                              <div class="before-circle"></div>
                            </div>
                            <div class="experience-content">
                              <div class="timeline-content">
                                <a href="#/" class="name">Web Designer at Dalt Technology</a>
                                <span class="time">Jan 2013 - Present (5 years 2 months)</span>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Profile Info Tab -->
            
            <!-- Projects Tab -->
            <div class="tab-pane fade" id="emp_projects">
              <div class="row">
                
                <div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
                  <div class="card">
                    <div class="card-body">

                      <h4 class="project-title"><a href="project-view.html">Hospital Administration</a></h4>
                      <div class="chat-avatar">
                              <a href="#" class="avatar">
                                <img alt="{{ $post->service_provider_user->display_name }}" width="30px" height="30px" src="{{ url('/')}}/assets/{{$photo->meta_value ?? 'images/user/user-default.png' }}">
                              </a>
                            </div>
                      <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. When an unknown printer took a galley of type and
                        scrambled it...
                      </p>
                      <div class="pro-deadline m-b-15">
                        <div class="sub-title">
                          Completed:
                        </div>
                        <div class="text-muted">
                          17 Apr 2019
                        </div>
                      </div>
                      <div class="project-members m-b-15">
                        <div>Project Leader :</div>
                        <ul class="team-members">
                          <li>
                            <a href="#" data-toggle="tooltip" title="" data-original-title="Jeffery Lalor"><img alt="" src="assets/img/profiles/avatar-16.jpg"></a>
                          </li>
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /Projects Tab -->
            
            <!-- Bank Statutory Tab -->
            <div class="tab-pane fade" id="bank_statutory">
              <div class="card">
                <div class="card-body">

                  <div class="chat chat-left">
                            <div class="chat-avatar">
                              <a href="#" class="avatar">
                                <img alt="{{ $post->service_provider_user->display_name }}" width="30px" height="30px" src="{{ url('/')}}/assets/{{$photo->meta_value ?? 'images/user/user-default.png' }}">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-bubble">
                                <div class="chat-content">
                                  <p>If you're looking for a great person to do your {!! $post->post_title !!}, then you're a message away rom that.</p>
                                  
                                  <span class="chat-time">{{ $post->service_provider_user->display_name }} @ {{date('d M Y',strtotime($post->created_at))}} 8:35 am</span>
                                </div>
                                <div class="chat-action-btns">
                                  <ul>
                                    <li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
                                    <li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>
                                    <li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li>
                                  </ul>
                                </div>
                              </div>

                            </div>
                          </div>
                  
                </div>
              </div>
            </div>
            <!-- /Bank Statutory Tab -->

                        <!-- Bank Statutory Tab -->
            <div class="tab-pane fade" id="endorsements">
              <div class="card">
                <div class="card-body">
                   <div class="chat chat-left">
                            <div class="chat-avatar">
                              <a href="#" class="avatar">
                                <img alt="{{ $post->service_provider_user->display_name }}" width="30px" height="30px" src="{{ url('/')}}/assets/{{$photo->meta_value ?? 'images/user/user-default.png' }}">
                              </a>
                            </div>
                            <div class="chat-body">
                              <div class="chat-bubble">
                                <div class="chat-content">
                                  <p>I proudly endorse myself as skilled {!! $post->post_title !!}.</p>
                                  
                                  <span class="chat-time">{{ $post->service_provider_user->display_name }} @ {{date('d M Y',strtotime($post->created_at))}} 8:35 am</span>
                                </div>
                                <div class="chat-action-btns">
                                  <ul>
                                    <li><a href="#" class="share-msg" title="Share"><i class="fa fa-share-alt"></i></a></li>
                                    <li><a href="#" class="edit-msg"><i class="fa fa-pencil"></i></a></li>
                                    <li><a href="#" class="del-msg"><i class="fa fa-trash-o"></i></a></li>
                                  </ul>
                                </div>
                              </div>

                            </div>
                          </div>
                </div>
              </div>
            </div>
            <!-- /Bank Statutory Tab -->
            
          </div>
                </div>




    <!-- blog page content area start-->
    <div class="blog-details-page-conent">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 single-blog-details-inner-wrapper">
                    <div class="single-blog-details-post"><!-- single blog page -->
                      <center>
                    
                      </center>
                      <br>
                        <div class="content">
                            <h4 class="title"><a href="#">{!! $post->post_title !!} | {{ $location->meta_value ?? '' }}</a> </h4>
                            <div class="post-meta">
                                <span class="time"><i class="far fa-clock"></i> {{date('d M Y',strtotime($post->created_at))}}</span>
                            </div>

                                {!! $post->post_content !!}

                        </div>
                    </div><!-- //. single blog page content -->
                    @include('partials.share')
                    <div class="comments-list">
                        <div class="fb-comments" data-colorscheme="dark" data-width="100%"
                             data-href="{{url()->current()}}"
                             data-numposts="5"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog page content area end-->


@include('partials.subscribe')

        <!-- Profile Modal -->
        <div id="endorse" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Endorse {{ $post->service_provider_user->display_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="profile-img-wrap edit-img">
                        <img class="inline-block"  @if(isset(Auth::user()->image)) @if(Auth::user()->image != null)
                    src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->username }}"
                @else
                    src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif 
                @else
                src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif >
                        <div class="fileupload btn">
                          <span class="btn-text">edit</span>
                          <input class="upload" type="file">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->fname ?? '' }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->lname ?? '' }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>User name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email </label>
                            <input type="text" class="form-control" id="email " name="email " value="{{ auth()->user()->email  ?? ''  }}">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>phone </label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Pictures </label>
                            <input type="file" class="form-control" id="pictures" name="pictures">
                          </div>
                        </div>

                        
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Endorsement </label>
                            <textarea class="form-control" id="" name=""></textarea>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Endorse</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Profile Modal -->

                <!-- Profile Modal -->
        <div id="review" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Review {{ $post->service_provider_user->display_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="profile-img-wrap edit-img">
                        <img class="inline-block"  @if(isset(Auth::user()->image)) @if(Auth::user()->image != null)
                    src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->username }}"
                @else
                    src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif 
                @else
                src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif >
                        <div class="fileupload btn">
                          <span class="btn-text">edit</span>
                          <input class="upload" type="file">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->fname ?? '' }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->lname ?? '' }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>User name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email </label>
                            <input type="text" class="form-control" id="email " name="email " value="{{ auth()->user()->email  ?? ''  }}">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>phone </label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Pictures </label>
                            <input type="file" class="form-control" id="pictures" name="pictures">
                          </div>
                        </div>

                        
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Review </label>
                            <textarea class="form-control" id="" name=""></textarea>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Review</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Profile Modal -->

                <!-- Profile Modal -->
        <div id="contact" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Contact {{ $post->service_provider_user->display_name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="profile-img-wrap edit-img">
                        <img class="inline-block"  @if(isset(Auth::user()->image)) @if(Auth::user()->image != null)
                    src="{{asset('assets/images/user/'.Auth::user()->image)}}" alt="{{ Auth::user()->username }}"
                @else
                    src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif 
                @else
                src="{{asset('assets/images/user/user-default.png')}}" alt="user avatar"
                @endif >
                        <div class="fileupload btn">
                          <span class="btn-text">edit</span>
                          <input class="upload" type="file">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->fname ?? '' }}">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="{{ auth()->user()->lname ?? '' }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>User name</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ auth()->user()->username ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Email </label>
                            <input type="text" class="form-control" id="email " name="email " value="{{ auth()->user()->email  ?? ''  }}">
                          </div>
                        </div>


                        <div class="col-md-6">
                          <div class="form-group">
                            <label>phone </label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone ?? ''  }}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label>Message </label>
                            <textarea class="form-control" id="" name=""></textarea>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="submit-section">
                    <button class="btn btn-primary submit-btn">Contact</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Profile Modal -->
@endsection
@section('js')
@endsection
