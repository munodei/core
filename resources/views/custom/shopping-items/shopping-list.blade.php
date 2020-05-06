@extends('frame')

@section('body')
@section('import-css')
    <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.css">
@stop
<div class="content container-fluid">
  @include('errors.alert')
  @include('errors.error')
    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Shopping Lists</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <button data-toggle="modal" data-target="#AddShoppingList" class="btn add-btn"><i class="fa fa-plus"></i> Add Shopping List</button>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->

<div class="row staff-grid-row">

  @if(count($shopping_lists1) >0)

      @foreach($shopping_lists as $k=>$groups)
        @foreach($groups as $group)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <h3 class="page-title">{{ $group->shopping_lists_name }}</h3>
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="{{ route('shopping-items') }}"><i class="fa fa-plus m-r-5"></i> Add Shopping Items</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#DoMyShopping" onclick="DoMyShopping({{ $group->shopping_listID }},'{{ $group->shopping_listSlug }}')"><i class="fa fa-shopping-cart m-r-5"></i> Do My Shopping For Me</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#ShareShoppingList" onclick="ShareShoppingList({{ $group->shopping_listID }},'{{ $group->shopping_listSlug }}','{{ $group->shopping_lists_name }}')"><i class="fa fa-share-alt m-r-5" ></i> Share</a>
                  <a class="dropdown-item" href="#" data-toggle="modal"  data-target="#DeleteShoppingList" onclick="DeleteShoppingList({{ $group->shopping_listID }})"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <div class="chat-box">
                <div class="task-wrapper">
                  <div class="task-list-container">
                    <div class="task-list-body">
                      <ul id="task-list">

                        @foreach($groups as $shopping_item)

      			                 @if(isset($shopping_item->shopping_item_name) && $shopping_item->shopping_item_name !='' )
                                  <li class="task">
                                    <div class="task-container">
                                      <span class="task-action-btn task-check">
                                        <a href="#" class="avatar" title="{{ $shopping_item->shopping_item_description }}">
                                          <img alt="{{ $shopping_item->shopping_item_description }}" width="100%" height="100%" src="{{ $shopping_item->photo }}">
                                        </a>
                                      </span>
                                      <div class="small text-muted"><strong>Name :</strong> {{ str_limit($shopping_item->shopping_item_name,25) }}</div>
                                      <div class="small text-muted"><strong>Price :</strong> {{ $shopping_item->shopping_item_price }}</div>
                                      <div class="small text-muted"><strong>Quantity :</strong> {{ $shopping_item->shopping_item_quantity }}</div>
                                      <div class="small text-muted"><strong>Supplier :</strong> {{ $shopping_item->shopping_item_outlets }}</div>
                                      <div class="small text-muted"><a href="{{ route('delete-from-group-shopping-item',['group_id'=>$group->shopping_listID,'item_id'=>$group->shopping_itemID])}}"><i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>
                                       </a></div>
                                    </div>

                                  </li>


                                  @else
                                  <center>You don't have any shopping items in this List! </center>
                                  <br>
                                    <br>
                                  @endif
                              @endforeach
                      </ul>
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
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <br>
          <center> You don't have any Shopping Lists !!</center>
      </div>

      @endif

      <!-- Delete Shopping List -->

      <div id="DeleteShoppingList" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Delete Shopping List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('shopping-list-destroy') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id='delete_shopping_list_id' value=""/>
                Are you sure you want delete this Shopping List?
              <div>
              </div>
      <br>
        <button class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Delete Shopping List -->

      <!-- Share Shopping List -->

      <div id="ShareShoppingList" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Share Shopping List</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Share Shopping List '<span id='share_shopping_list_list'></span>' <br><br>
              <form method="post" action="{{ route('share-shopping-list') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="share_shopping_list_id" value="">
                <input type="hidden" name="slug" id="share_shopping_list_slug" value="">
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
      <!-- /Share Shopping List -->

				<!-- Add Shopping List -->

				<div id="AddShoppingList" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Shopping List</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                <form method="post" action="{{ route('shopping-list-save') }}" id="send-pm1">
                  {!! csrf_field() !!}
                  <div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">List</label>
								<div class="col-sm-10">
										<input type="text" required name="shopping_lists_name" class="form-control form-control-lg" id="shopping_lists_name"  value="">
								</div>
						</div>

						<div class="form-group row">
								<label for="inputEmail3" class="col-sm-2 col-form-label">Info</label>
								<div class="col-sm-10">
										<textarea  required name="shopping_lists_descripltion"  class="form-control form-control-lg" id="shopping_lists_descripltion"></textarea>
								</div>
						</div>

								<div>
								</div>

								<div class="submit-section">
									<button onclick="event.preventDefault();document.getElementById('send-pm1').submit();" class="btn btn-primary submit-btn">Create A Shopping List </button>
								</div>
              	</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Shopping List -->

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
                          <input type="text" class="form-control" name="name" id="name" placeholder="First and Last Name" value="{{ auth()->user()->fname }} {{ auth()->user()->lname }}" />
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
                          <label class="col-form-label">Select Saved Delivery Locations <span class="text-danger">*</span></label>
                          <select class="select" name='delivery_option' onchange="delivery_option1(this.value)" required>
                            <option>Select Saved Delivery Location</option>
                              @foreach($delivery_locations as $delivery_location)
                              <option value="{{ $delivery_location->id }}">{{ $delivery_location->name }}</option>
                              @endforeach
                           </select>
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

  function  DoMyShopping(id,slug){
      $('#do_my_shopping_list_id').val(id);
      $('#do_my_shopping_list_slug').val(slug);
    }

  function  ShareShoppingList(id,slug,list){
      $('#share_shopping_list_id').val(id);
      $('#share_shopping_list_slug').val(slug);
      $('#share_shopping_list_list').html(list);
    }

  function  DeleteShoppingList(id){
      $('#delete_shopping_list_id').val(id);
    }

</script>

@stop
