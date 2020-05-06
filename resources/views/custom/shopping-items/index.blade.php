@extends('frame')

@section('body')
@section('import-css')
    <link rel="stylesheet" href="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.css">
@stop


<div class="chat-main-row">
<div class="chat-main-wrapper">
<div class="col-lg-7 message-view task-view task-left-sidebar">
<div class="chat-window">
  <div class="fixed-header">
    <div class="navbar">
      <div class="float-left mr-auto">
        <div class="add-task-btn-wrapper">
          <a href="{{ route('add-shopping-item') }}">
            <span class="add-task-btn btn btn-white btn-sm">
              Add Shopping Item
            </span>
          </a>
        </div>
      </div>
      <a class="task-chat profile-rightbar float-right" id="task_chat" href="#task_window"><i class="fa fa fa-cart-plus"></i></a>

    </div>
  </div>
  <div class="chat-contents">
    <div class="chat-content-wrap">
      <div class="chat-wrap-inner">
        <div class="chat-box">
          <div class="task-wrapper">
            <div class="task-list-container">
              <div class="task-list-body">
                  <center> Your Shopping Items</center>
                  <br>
                  @include('errors.alert')
                  @include('errors.error')
                <ul id="task-list">

              @if(sizeof($shopping_items)>0)
              @foreach($shopping_items as $shopping_item)
                  <li class="task">
                    <div class="task-container">

                      <div class="dropdown profile-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" href="#" title="Add {{ $shopping_item->shopping_item_name }} To Shopping List" onclick="addToShoppingList({{ $shopping_item->id }})" data-toggle="modal" data-target="#AddToShoppingItemGroupModal"><i class="fa fa-plus m-r-5"></i> Add Shopping Item To List</a>
                          <a class="dropdown-item" href="#" title="Buy {{ $shopping_item->shopping_item_name }}" onclick="buyNow({{ $shopping_item->id }},'{{ $shopping_item->shopping_item_name }}')" data-toggle="modal" data-target="#BuyNow"><i class="fa fa-shopping-cart m-r-5"></i> Buy Now</a>
                          <a class="dropdown-item" href="#" title="Share {{ $shopping_item->shopping_item_name }}" onclick="sharingShoppingItem({{ $shopping_item->id }})" data-toggle="modal" data-target="#ShareShoppingItem"><i class="fa fa-share-alt m-r-5" ></i> Share</a>
                          <a class="dropdown-item" href="#" title="Add {{ $shopping_item->shopping_item_name }} To Cart" onclick="addToCartShoppingItem({{ $shopping_item->id }},'{{ $shopping_item->shopping_item_name }}','1')" data-toggle="modal" data-target="#AddToCartShoppingItem"><i class="fa fa-shopping-basket m-r-5" ></i> Add To cart</a>
                          <a class="dropdown-item" href="#"  title="Delete {{ $shopping_item->shopping_item_name }}" data-toggle="modal" onclick="deleteShoppingItem({{ $shopping_item->id }})" data-target="#DeleteShoppingItem"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                        </div>
                      </div>

                      <span class="task-action-btn task-check">
                        <a href="#" class="avatar">
                          <img alt="{{ $shopping_item->shopping_item_name }}" width="100%" height="100%" src="{{ $shopping_item->photo }}">
                        </a>
                      </span>

                          <div class="small text-muted"><strong>Name :</strong> {{ $shopping_item->shopping_item_name }}</div>
                          <div class="small text-muted"><strong>Brand :</strong> {{ $shopping_item->shopping_item_brand }}</div>
                          <div class="small text-muted"><strong>Price :</strong> {{ $shopping_item->shopping_item_price }}</div>
                          <div class="small text-muted"><strong>Quantity :</strong> {{ $shopping_item->shopping_item_quantity }}</div>
                          <div class="small text-muted"><strong>Supplier :</strong> {{ $shopping_item->shopping_item_outlets }}</div>
                         <div class="small text-muted">
                           <a href="#" title="Add {{ $shopping_item->shopping_item_name }} To Shopping List" onclick="addToShoppingList({{ $shopping_item->id }})" data-toggle="modal" data-target="#AddToShoppingItemGroupModal">
                             <i style="color:green;" class="fa fa-plus" aria-hidden="true"></i>
                           </a>
                           <a href="#" title="Buy {{ $shopping_item->shopping_item_name }}" onclick="buyNow({{ $shopping_item->id }},'{{ $shopping_item->shopping_item_name }}')" data-toggle="modal" data-target="#BuyNow">
                           <i style="color:purple;" class="fa fa-shopping-cart" aria-hidden="true"></i>
                         </a>
                          <a href="#" title="Share {{ $shopping_item->shopping_item_name }}" onclick="sharingShoppingItem({{ $shopping_item->id }})" data-toggle="modal" data-target="#ShareShoppingItem">
                           <i style="color:green;" class="fa fa--share-alt" aria-hidden="true"></i>
                         </a>
                          <a href="#" title="Add {{ $shopping_item->shopping_item_name }} To Cart" onclick="addToCartShoppingItem({{ $shopping_item->id }},'{{ $shopping_item->shopping_item_name }}','1')" data-toggle="modal" data-target="#AddToCartShoppingItem">
                           <i style="color:orange;" class="fa fa-shopping-basket" aria-hidden="true"></i>
                         </a>
                          <a title="Delete {{ $shopping_item->shopping_item_name }}" data-toggle="modal" onclick="deleteShoppingItem({{ $shopping_item->id }})" data-target="#DeleteShoppingItem">
                           <i style="color:red;" class="fa fa-trash" aria-hidden="true"></i>
                         </a>
                         </div>

                      <span class="task-action-btn task-btn-right">
                      </span>
                    </div>
                  </li>
              @endforeach
              @else
              <center>Unfortunately you don't have any shopping items available </center>
              <br>
              @endif
                </ul>
              </div>
            </div>
          </div>
          <div class="notification-popup hide">
            <p>
              <span class="task"></span>
              <span class="notification-text"></span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<div class="col-lg-5 message-view task-chat-view task-right-sidebar" id="task_window">
<div class="chat-window">

  <div class="chat-contents task-chat-contents">
    <div class="chat-content-wrap">
      <div class="chat-wrap-inner">
        <div class="chat-box">
          <div class="chats">
            <h4>Suggested Shopping Items</h4>

                <div class="chat-box">
                  <div class="task-wrapper">
                    <div class="task-list-container">
                      <div class="task-list-body">
                        <ul id="task-list">

                      @if(sizeof($products)>0)
                      @foreach($products as $shopping_item)
                          <li class="task">
                            <div class="task-container">
                              <div class="dropdown profile-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="#" title="Add To Your Shopping Items" onclick="addShoppingProductToShoppingItems({{ $shopping_item->id }},'{{ $shopping_item->product_name }}')" data-toggle="modal" data-target="#AddShoppingItem"><i class="fa fa-plus m-r-5"></i> Add To My Shopping Items</a>
                                    <a class="dropdown-item" href="#" title="Add {{ $shopping_item->shopping_item_name }} To Cart" onclick="addToCartShoppingItem({{ $shopping_item->id }},'{{ $shopping_item->product_name }}','0')" data-toggle="modal" data-target="#AddToCartShoppingItem"><i class="fa fa-shopping-basket m-r-5" ></i> Add To cart</a>
                                </div>
                              </div>

                              <span class="task-action-btn task-check">
                                <a href="#" class="avatar">
                                  <img alt="{{ $shopping_item->product_name }}" width="100%" height="100%" src="{{ $shopping_item->photo }}">
                                </a>
                              </span>
                              <div class="small text-muted"><strong>Name :</strong> {{ $shopping_item->product_name }}</div>
                              <div class="small text-muted"><strong>Brand :</strong> {{ $shopping_item->product_brand }}</div>
                              <div class="small text-muted"><strong>Price :</strong> {{ $shopping_item->product_price }}</div>
                              <div class="small text-muted"><strong>Quantity :</strong> {{ $shopping_item->product_quantity }}</div>
                              <div class="small text-muted"><strong>Supplier :</strong> {{ $shopping_item->product_outlets }}</div>
                              <div class="small text-muted">
                              <a href="#" title="Add To Your Shopping Items" onclick="addShoppingProductToShoppingItems({{ $shopping_item->id }},'{{ $shopping_item->product_name }}')" data-toggle="modal" data-target="#AddShoppingItem">
                                <i style="color:green;" class="fa fa-plus" aria-hidden="true"></i>
                              </a>
                              <a href="#" title="Add {{ $shopping_item->shopping_item_name }} To Cart" onclick="addToCartShoppingItem({{ $shopping_item->id }},'{{ $shopping_item->product_name }}','0')" data-toggle="modal" data-target="#AddToCartShoppingItem">
                                <i style="color:orange;" class="fa fa-shopping-basket" aria-hidden="true"></i>
                              </a>
                                </div>
                              <span class="task-action-btn task-btn-right">
                              </span>
                            </div>
                          </li>
                      @endforeach
                      @else
                      <center>Unfortunately you don't have any shopping items available </center>
                      <br>
                      @endif
                        </ul>
                      </div>

                    </div>
                  </div>
                </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>
</div>


				<!-- Add Shopping Item To Your Shopping List -->

				<div id="AddToShoppingItemGroupModal" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Shopping Item To Your Shopping List</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
                <form method="post" action="{{ route('shopping-item-group-update') }}" id="send-pm">
                  {!! csrf_field() !!}
                  <input type="hidden" name="id" id="add_shopping_item_id" value=""/>
								<div class="input-group m-b-30">
                  <select class="form-control search-input" data-live-search="true" required name="group_id" id="group_id">
                    @if(isset($shopping_lists1))
                      @foreach($shopping_lists1 as $shopping_item_group)
                        <option value="{{ $shopping_item_group->shopping_listID }}">{{ $shopping_item_group->shopping_lists_name }}</option>
                      @endforeach
                    @endif
                  </select>
									<span class="input-group-append">
										<button class="btn btn-primary">Add</button>
									</span>


								</div>
								<div>
								</div>


              	</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add Shopping Item Group Modal -->



        <!-- Share Shopping Item -->

        <div id="ShareShoppingItem" class="modal custom-modal fade" role="dialog">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Share Shopping Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="post" action="{{ route('share-shopping-item') }}" id="send-pm">
                  {!! csrf_field() !!}
                  <input type="hidden" name="id" id='sharing_shopping_item_id' value=""/>
                <div class="input-group m-b-30">
                  <select class="form-control search-input" data-live-search="true" required name="group_id" id="group_id">

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
        <!-- Share Shopping Item Modal -->


<!-- Delete Shopping Item -->

<div id="DeleteShoppingItem" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Delete Shopping Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('delete-shopping-item') }}" id="send-pm">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='delete_shopping_item_id' value=""/>
          Are you sure you want delete this Shopping Item?
        <div>
        </div>
<br>
  <button class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Share Shopping Item Modal -->

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

<!-- Buy Now Shopping Item -->

<div id="BuyNow" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Buy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('cart.store') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='buy_now_shopping_item_id' value=""/>
          <input type="hidden" name="shopping_item" value="1"/>
          Are you sure you want buy '<i id="buy_now_shopping_item"></i>'?
        <div>
        </div>
        <br>
          <label>Quantity</label>
        <div class="input-group m-b-30">

          <select class="form-control search-input" data-live-search="true" required name="item_quantity">

           @for($i=1;$i<=100;$i++)

                  <option value="{{ $i }}">{{ $i }}</option>

            @endfor
          </select>


        </div>
<br>
  <button class="btn btn-success">Buy Now</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  Buy Now Shopping Item -->

<!-- Add to cart Shopping Item -->

<div id="AddToCartShoppingItem" class="modal custom-modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Shopping Item To Cart</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('cart.create') }}">
          {!! csrf_field() !!}
          <input type="hidden" name="id" id='add_to_cart_shopping_item_id' value=""/>
          <input type="hidden" name="shopping_item" id="shopping_item_or_not" value="1"/>
          Are you sure you want to add '<i id="add_to_cart_shopping_item"></i>' to your cart?
        <div>
        </div>
        <br>
          <label>Quantity</label>
        <div class="input-group m-b-30">

          <select class="form-control search-input" data-live-search="true" required name="item_quantity">

           @for($i=1;$i<=100;$i++)

                  <option value="{{ $i }}">{{ $i }}</option>

            @endfor
          </select>


        </div>
<br>
  <button class="btn btn-success">Add To Cart</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  Add to cart  Shopping Item -->



@endsection

@section('import-script')

    <!-- Summernote JS -->
<script src="{{ url('/') }}/assets/smarthr/plugins/summernote/dist/summernote-bs4.min.js"></script>

<!-- Task JS -->
<script src="{{ url('/') }}/assets/smarthr/js/task.js"></script>
<script>

  function  addToShoppingList(id){
      $('#add_shopping_item_id').val(id);
    }

  function  sharingShoppingItem(id){
      $('#sharing_shopping_item_id').val(id);
    }

  function  deleteShoppingItem(id){
      $('#delete_shopping_item_id').val(id);
    }

  function  addShoppingProductToShoppingItems(id,product)
    {
      $('#product_shopping_item').html(product);
      $('#product_shopping_item_id').val(id);
    }

  function buyNow(id,product){
    $('#buy_now_shopping_item').html(product);
    $('#buy_now_shopping_item_id').val(id);
  }

  function addToCartShoppingItem(id,product,item){
    $('#add_to_cart_shopping_item').html(product);
    $('#add_to_cart_shopping_item_id').val(id);
    $('#shopping_item_or_not').val(item);
  }

</script>

@stop
