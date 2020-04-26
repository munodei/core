@extends('merchant-1')

@section('body')

@section('import-css')
    <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.css">
@stop

<div class="content container-fluid">
    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Contact Groups</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <button data-toggle="modal" data-target="#AddShoppingList" class="btn add-btn"><i class="fa fa-plus"></i> Add Contact Group</button>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->
<div class="row staff-grid-row">

  @if(count($contact_groups1) >0)

      @foreach($contact_groups as $k=>$groups)
        @foreach($groups as $group)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <h3 class="page-title" title="{{ $group->group_contacts_description }}">{{ $group->group_contacts_name }}</h3>
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('contacts.index') }}"><i class="fa fa-plus m-r-5"></i> Add Contacts</a>
                  <a class="dropdown-item" href="#" data-target="#EditContactGroup" data-toggle="modal" onclick="EditContactGroup({{ $group->contactGroupID }},'{{ $group->group_contacts_name }}','{{ $group->group_contacts_description }}');"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#ShareContactGroup" onclick="ShareContactGroup({{ $group->contactGroupID }},'{{ $group->group_contacts_name }}')"><i class="fa fa-share-alt m-r-5" ></i> Share</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#DeleteContactGroup" onclick="DeleteContactGroup({{ $group->contactGroupID }},'{{ $group->group_contacts_name }}')"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#TransferMoneyToContactGroup" onclick="TransferMoneyToContactGroup({{ $group->contactGroupID }},'{{ $group->group_contacts_name }}')"><i class="fa fa-exchange m-r-5"></i> Transfer Money</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#SendMoneyToContactGroup" onclick="SendMoneyToContactGroup({{ $group->contactGroupID }},'{{ $group->group_contacts_name }}')"><i class="fa fa-money m-r-5"></i> Send Money</a>
                </div>
              </div>
              <div class="chat-box">
                <div class="task-wrapper">
                  <div class="task-list-container">
                    <div class="task-list-body">
                      <ul id="task-list">

                        @foreach($groups as $contact)

      			                 @if(isset($contact->firstname))
                                  <li class="task">
                                    <div class="task-container">
                                      <span class="task-action-btn task-check">
                                        <a href="#" class="avatar" title="{{$contact->firstname}} {{$contact->lastname}}">
                                          <img alt="{{$contact->firstname}} {{$contact->lastname}}" width="37px" height="37px" src="{{ url('/') }}/{{ $contact->photo }}">
                                        </a>
                                      </span>
                                      <div class="small text-muted">{{$contact->firstname}}<br> {{$contact->lastname}}</div>
                                      <div class="small text-muted">{{$contact->email}} <br> {{$contact->mobilephone}}</div>

                                    </div>

                                  </li>



                                  @else
                                  <center>You don't have any Contacts in this Group! </center>


                                      <br>
                                  @endif

                              @endforeach
                      </ul>
                      @if(sizeof($groups)==1)
                      <br>
                        <br>
                        @endif
                    </div>

                  </div>
                </div>
              </div>
              </div>
              </div>
          <?php break; ?>
        @endforeach
      @endforeach
      @else
      <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
          <br>
          <center> You don't have any Contact Groups !!</center>
      </div>

      @endif

      <!-- Delete Contact Group -->

      <div id="DeleteContactGroup" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Contact Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('delete-contact-group') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id='delete_group_contact_id' value=""/>
                Are you sure you want delete this Contact Group '<span id="delete_group_contact_name"></span>'?
              <div>
              </div>
      <br>
        <button class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Contact Group -->

      <!-- Send Money To All Contacts in Group -->

      <div id="SendMoneyToContactGroup" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Send Money</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="#">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id='send_money_group_contact_id' value=""/>
                Are you sure you want to send money to all contacts in Group '<span id="send_money_group_contact_name"></span>'?
              <div>
              </div>
      <br>
        <button class="btn btn-primary">Send</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Send Money To All Contacts in Group-->

      <!-- Transfer Money To All Contacts in Group -->

      <div id="TransferMoneyToContactGroup" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Transfer Money</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="#">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id='transfer_money_group_contact_id' value=""/>
                Are you sure you want to transfer money to all contacts in Group '<span id="transfer_money_group_contact_name"></span>'?
              <div>
              </div>
      <br>
        <button class="btn btn-primary">Transfer</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Transfer Money To All Contacts in Group-->

      <!-- Share Contact Group -->

      <div id="ShareContactGroup" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Share Contact Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Share Contact Group '<span id='share_contact_group_group'></span>' <br><br>
              <form method="post" action="{{ route('share-contact-group') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="share_contact_group_id" value="">

              <div class="input-group m-b-30">
                <select class="form-control search-input" data-live-search="true" required name="email" id="email">

                 @foreach($contacts as $contact)
                     @if($contact->email!='' || $contact->email!=null)
                        <option value="{{ $contact->email }}">({{ $contact->firstname }} {{ $contact->lastname }}) {{ $contact->email }}</option>
                     @endif
                  @endforeach
                </select>
                <span class="input-group-append">
                  <button class="btn btn-primary">Share</button>
                </span>
              </div>
              <div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /Share Contact Group -->

				<!-- Add Contact Group -->

				<div id="AddShoppingList" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Contact Group</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                <form method="post" action="{{ route('contact-groups.store') }}" id="send-pm1">
                  {!! csrf_field() !!}
                  <div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
								<div class="col-sm-10">
										<input type="text" required name="group_contacts_name" class="form-control form-control-lg" id="group_contacts_name"  value="">
								</div>
						</div>

						<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
								<div class="col-sm-10">
										<textarea  required name="group_contacts_description"  class="form-control form-control-lg" id="group_contacts_description"></textarea>
								</div>
						</div>

								<div>
								</div>

								<div class="submit-section">
									<button onclick="event.preventDefault();document.getElementById('send-pm1').submit();" class="btn btn-primary submit-btn">Create A Contact Group </button>
								</div>
              	</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Contact Group -->

        <!-- Edit Contact Group -->

        <div id="EditContactGroup" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Contact Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('update-contact-group') }}" id="send-pm12">
                  {!! csrf_field() !!}
                  <input type="hidden" name="id" id='edit_contact_group_id' value=""/>
                  <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" required name="group_contacts_name" class="form-control form-control-lg" id="edit_group_contacts_name"  value="">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                    <textarea  required name="group_contacts_description"  class="form-control form-control-lg" id="edit_group_contacts_description"></textarea>
                </div>
            </div>

                <div>
                </div>

                <div class="submit-section">
                  <button onclick="event.preventDefault();document.getElementById('send-pm12').submit();" class="btn btn-primary submit-btn">Update Contact Group Information </button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Add Contact Group -->

        <!-- Let Us Do your Shopping For You -->

        <div id="DoMyShopping" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Let Us Do your Shopping For You!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('shopping-list-request') }}">
                  {!! csrf_field() !!}
                  <input type="hidden" name="shopping_list_id" id="do_my_shopping_list_id" value="">
                  <input type="hidden" name="shopping_list_slug" id="do_my_shopping_list_slug" value="">
                  <div class="row">

                        <div class="col-sm-12 form-group">
                          <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="name" id="name" placeholder="First and Last Name" value="{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}" />
                        </div>

                        <div class="col-sm-12 form-group">
                          <label class="col-form-label">Email Address <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="emailaddress" id="emailaddress" placeholder="Email Address" value="{{ auth()->user()->email }}" />
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                          <input type="text" class="form-control"  name="phone" id="phone" placeholder="Contact Number" value="{{ auth()->user()->phone }}" />
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Is phone number on WhatsApp?<span class="text-danger">*</span></label>
                            <div class="checkbox">
                              <input type="checkbox" name="is_whatsapp" id="chekcbox2" checked value="1">
                              <label for="chekcbox2"><span class="checkbox-icon"></span> </label>
                            </div>
                        </div>


                        <div class="col-sm-12 form-group">
                            <label class="col-form-label">Delivery Address<span class="text-danger">*</span></label>
                          <i class="icon-material-outline-location-on"></i>
                          <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{ auth()->user()->address }}" required/>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Suburb <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="suburb" id="suburb" placeholder="suburb" value="{{ auth()->user()->suburb }}" required/>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Neighbourhood <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="neighbourhood" id="neighbourhood" placeholder="Neighbourhood" value="{{ auth()->user()->neighbourhood }}" required/>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">City <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ auth()->user()->city }}" required/>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">State<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="state" id="state" placeholder="State" value="{{ auth()->user()->state }}" required/>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Country <span class="text-danger">*</span></label>
                          <select class="select" name='country'  id='country' required>
    													@foreach($countries as $country)
                              <option @if(auth()->user()->country_id == $country->id) selected @endif value='{{ $country->id }}'>{{ $country->name }}</option>
                              @endforeach
												   </select>
                        </div>

                        <div class="col-sm-6 form-group">
                          <label class="col-form-label">Zip Code/ Postal Code <span class="text-danger">*</span></label>
                          <input type="number" class="form-control" name="zip_code" id="zip_code" placeholder="Zip Code" value="{{ auth()->user()->zip_code }}" required />
                        </div>

                        <div class="col-sm-12 form-group">
                          <label class="col-form-label">Special Instructions <span class="text-danger">*</span></label>
                            <textarea name="textarea" name="message" id="message"  cols="10" placeholder="Message" class="form-control"></textarea>
                        </div>

                        <div class="col-sm-12 form-group">
                            <label class="col-form-label">Add Attachments<span class="text-danger">*</span></label>
                           <input class="uploadButton-input" type="file" accept="image/*, application/pdf" id="upload"/>
                        </div>

                  </div>




                <div class="submit-section">
                  <button onclick="" class="btn btn-primary submit-btn">Shop For Me</button>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- /Let Us Do your Shopping For Yout -->


@endsection
@section('import-script')

    <!-- Summernote JS -->
<script src="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.min.js"></script>

<!-- Task JS -->
<script src="{{ url('/') }}/assets/smarthr/js/task.js"></script>
<script>

    function delivery_option1(id){

      $.ajax({
                url: '{{ url('/') }}/user/get-delivery-option/'+id,
                cache   : false,
                type    : "GET",
                dataType : 'json',
                error   : function(data)
                {
                    console.log('error occured when trying to find the from city');
                },
                success : function(data)
                {
                  $('#address').val(data.address);
                  $('#suburb').val(data.suburb);
                  $('#neighbourhood').val(data.neighbourhood);
                  $('#city').val(data.city);
                  $('#state').val(data.state);
                  $('#country').val(data.country);
                  $('#zip_code').val(data.zip_code);
                  $('#message').val(data.instruction);
                }
                    });

    }
  function SendMoneyToContactGroup(id,name){

    $('#send_money_group_contact_id').val(id);
    $('#send_money_group_contact_name').html(name);

  }

  function TransferMoneyToContactGroup(id,name){

    $('#transfer_money_group_contact_id').val(id);
    $('#transfer_money_group_contact_name').html(name);

  }
  function  EditContactGroup(id,name,desc){

        $('#edit_contact_group_id').val(id);
        $('#edit_group_contacts_name').val(name);
        $('#edit_group_contacts_description').val(desc);

    }

  function  ShareContactGroup(id,slug){
      $('#share_contact_group_id').val(id);
      $('#share_contact_group_group').html(slug);
    }

  function  DeleteContactGroup(id,name){
      $('#delete_group_contact_id').val(id);
      $('#delete_group_contact_name').html(name);
    }

</script>

@stop
