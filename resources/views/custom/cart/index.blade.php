@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item active">{{ $page_title }}</li>
      </ul>
    </div>
  </div>
</div>
<!-- /Page Header -->


<br>

<div class="row staff-grid-row">
      <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>
          <span class="badge badge-secondary badge-pill">{{ sizeof($items) }}</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed">

            <div>
              <h6 class="my-0">Item</h6>

            </div>

            <span class="text-muted">Price</span>
          </li>
          @foreach($items as $item)

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <a href="#" data-toggle="modal" data-target="#product_view{{$item->itemID}}">
            <img src="{{ $item->photo }}" width="25px" height="25px"/>
            <div>
              <h6 class="my-0">{{ str_limit($item->item_name,20) ?? '' }}</h6>

            </div>
            <span class="text-muted" style="color:red;">{{ $item->item_quantity ?? ''}}</span><br>
            <span class="text-muted">{{ $item->item_price ?? ''}}</span>
          </a>
            <a href="{{ route('item.clear',['id'=>$item->itemID])}}"><i style="color:red;margin-left:5px;" class="fa fa-trash" aria-hidden="true"></i>
             </a>
          </li>
          @endforeach

        </ul>

        <form class="card p-2">
          <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="event.preventDefault();document.getElementById('shopping_request_form').submit();">Proceed To make Shopping Request</button>
        </form>
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <form method="post" action="{{ route('shopping-list-request') }}" id="shopping_request_form">
          {!! csrf_field() !!}
          <input type="hidden" name="shopping_list_id" id="do_my_shopping_list_id" value="{{ $cart->id }}">
          <input type="hidden" name="shopping_list_slug" id="do_my_shopping_list_slug" value="{{ $cart->cart }} ">
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
                  <select class="select form-control" name='delivery_option' onchange="delivery_option1(this.value)" required>
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
                  <select class="select form-control" name='country'  id='country' required>
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


      <!-- Share Contact Group -->

      <div id="AddContactTogroup" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Contact to Group</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Add Contact  '<span id='share_shopping_list_list'></span>' to Contact Group <br><br>
              <form method="post" action="{{ route('add-contact-to-group') }}">
                {!! csrf_field() !!}
                <input type="hidden" name="contact_id" id="add_to_group_contact_id" value=""/>
              <div class="input-group m-b-30">
                <select class="form-control search-input" data-live-search="true" required name="contact_group_id" id="contact_group_id">

                  @foreach($contact_groups as $k=>$groups)
                    @foreach($groups as $group)
                        <option value="{{ $group->contactGroupID }}">{{ $group->group_contacts_name }}</option>
                          <?php break; ?>
                    @endforeach
                  @endforeach
                </select>
                <span class="input-group-append">
                  <button class="btn btn-primary">Add to Group</button>
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
      @foreach($items as $item)
      <div class="modal fade product_view" id="product_view{{ $item->itemID }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
                <h3 class="modal-title">{{ $item->item_name }}</h3>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 product_content">
                        <h4><img src="{{ $item->photo}}" width="100px" height="100px"/></h4>
                        <h4>Quantity : {{ $item->item_quantity }}</h4>
                        <p>{{ $item->item_description }}</p>
                        <h3 class="cost"><span class="glyphicon glyphicon-usd"></span> {{ $item->item_price  }}</h3>

                        <div class="space-ten"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
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
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>

@endsection
