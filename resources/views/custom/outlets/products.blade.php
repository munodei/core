@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('outlet.departments',['outlet'=>$outlet->slug,'department'=>$departmentr])}}">Departments</a></li>
          <li class="breadcrumb-item active"><a href="{{ url()->current() }}">{{ $page_title }}</a></li>
      </ul>
    </div>

  </div>
</div>
<!-- /Page Header -->

<!-- Search Filter -->
<div class="row filter-row">

    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus">
        <form  method="post" action = "{{ route('search-contacts') }}" id="searchform"  value="{{ request('search')  }}"  autocomplete="off">
                                @csrf
        <input type="text" class="form-control floating" name="search" value="{{ request('search')  }}"  autocomplete="off">
        </form>
        <label class="focus-label">Search Products...</label>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <button class="btn btn-success btn-block" onclick="event.preventDefault();document.getElementById('searchform').submit();"> Search </button>
    </div>

</div>
<!-- Search Filter -->

<div class="row staff-grid-row">

  @if(count($products) >0)
      @foreach($products as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" title="Add To Your Shopping Items" onclick="addShoppingProductToShoppingItems({{ $data->id }},'{{ $data->product_name }}')" data-toggle="modal" data-target="#AddShoppingItem"><i class="fa fa-plus m-r-5"></i> Add To My Shopping Items</a>

                </div>
              </div>
              <div class="profile-img">
                <a href="{{route('outlet.departments',['outlet'=>$outlet->slug,'department'=>$departmentr])}}" class="avatar"><center><img src="{{ $data->photo }}" alt="{{ $data->outlet }}" width="100%" height="100%"/></center></a>
              </div>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{route('outlet.departments',['outlet'=>$outlet->slug,'department'=>$departmentr])}}">{{ $outlet->outlet }}</a></h4>
              <div class="small text-muted"><strong>Name :</strong> {{ $data->product_name }}</div>
              <div class="small text-muted"><strong>Brand :</strong> {{ $data->product_brand }}</div>
              <div class="small text-muted"><strong>Price :</strong> {{ $data->product_price }}</div>
              <div class="small text-muted"><strong>Quantity :</strong> {{ $data->product_quantity }}</div>
              <div class="small text-muted"><strong>Supplier :</strong> {{ $data->product_outlets }}</div>

              <br>
              <br>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
          <center> You don't have any Products in this Section!!</center>
      </div>

      @endif

{{$products->links()}}

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
      <!-- Add Product To your Shopping Items-->

      <div id="AddShoppingItem" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Product To your Shopping Items</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="post" action="{{ route('add-product-to-shopping-items') }}" id="send-pm">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id='product_shopping_item_id' value=""/>
                Are you sure you want add this '<i id="product_shopping_item"></i>' to your Shopping items?
              <div>
              </div>
      <br>
        <button class="btn btn-success">Add Shopping Item</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Add Product To your Shopping Items -->
      <script>
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }

        function  addShoppingProductToShoppingItems(id,product)
          {
            $('#product_shopping_item').html(product);
            $('#product_shopping_item_id').val(id);
          }
      </script>

@endsection
