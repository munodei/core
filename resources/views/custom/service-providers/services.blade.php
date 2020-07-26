@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('essential_service_providers.all') }}">Service Providers</a></li>
          <li class="breadcrumb-item active"><a href="{{ url()->current() }}">{{ $page_title }}</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- /Page Header -->
<!-- Search Filter -->
<center>
<div class="row filter-row">

    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus">
        <form  method="post" action = "{{ url()->current() }}" id="searchform"  value="{{ request('service_provider')  }}"  autocomplete="off">
                                      @csrf
              <input type="text" class="form-control floating" name="service_provider" value="{{ request('service_provider')  }}" id="searchtxt"  autocomplete="off">
            
              <input type="hidden" class="form-control form-control-block search-input col-md-6  mr-sm-2" id="postal_code" name="postal_code" >
              <input type="hidden" class="form-control form-control-block search-input col-md-6  mr-sm-2" id="latitude" name="latitude" >
              <input type="hidden" class="form-control form-control-block search-input col-md-6  mr-sm-2" id="longitude" name="longitude" >
              <input type="hidden" class="form-control form-control-block search-input col-md-6  mr-sm-2" id="service_id" name="service_id" >
              
              <label class="focus-label">Search Service Providers...</label>
          </div>
      </div>

      <div class="col-sm-6 col-md-3">
          <div class="form-group form-focus">
             <input type="text" class="form-control floating"  id="searchPincode1" name="searchPincode1"  autocomplete="off">
             <label class="focus-label">Location...</label>
          </div>
      </div>

      </form>
    <div class="col-sm-6 col-md-3">
      <button class="btn btn-success btn-block" onclick="event.preventDefault();document.getElementById('searchform').submit();"> Search </button>
    </div>

</div>
<!-- Search Filter -->

<br>
<h2 class="title">Featured Categories</h2></center>
<br>
    <div class="row">

       @foreach($mainCategoryServices as $category)
       <?php if($category->image != null || $category->image !='' ){ ?>
      <div class="col-md-4">
          <a href="{{ route('category.providers', ['name' => $category->catSlug]) }}">
            <div class="card mb-4 shadow-sm">
              <img src="{{ url('/')}}/images/upload-nct/category_img/{{ $category->image}}" alt="{{ $category->fieldvalue}}" class="bd-placeholder-img card-img-top" width="100%" height="225">
            <div class="card-body">
              <div class="content">
                <center>
                  <h4 class="title">{{ $category->fieldvalue }}</h4>
                  </center>
              </div>
              <div class="d-flex justify-content-between align-items-center">
              </div>
            </div>
            </div>
               </a>
      </div>
      <?php }?>
      @endforeach

    </div>
<br>



 @foreach($categories as $category)
        <div class="row">
          <div class="col-md-12 text-center">
             <a href="{{ route('category.providers', ['name' => $category[0]->catSlug]) }}">
            <h2>{{ $category[0]->Category}} Services</h2>
          </a>
          </div>
        </div>
        <br>
        <div class="row">
        @foreach($category as $cat)

            <div class="col-md-4">
            <a href="{{ route('services.providers', ['name' => $cat->subCatSlug]) }}">
            <div class="card mb-4 shadow-sm">
             
              <div class="card-body">
                <div class="content">
                    <center><h4 class="title">{{ $cat->fieldvalue }}</h4></center>
                </div>
               
                <div class="d-flex justify-content-between align-items-center">
                </div>
              </div>
            </div>
          </a>
        </div>
        @endforeach
        </div>
@endforeach


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
      <script>
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
<?php
$url =isset($mainCategories[0]->pagename)?$mainCategories[0]->pagename:'';
 ?>
jQuery(document).ready(function() {
   var availableTags = <?php echo $sqlSubcat;?>;
  autocomplete(document.getElementById("searchtxt"), availableTags);
});

function autocomplete(inp, arr) {
/*the autocomplete function takes two arguments,
the text field element and an array of possible autocompleted values:*/
var currentFocus;
/*execute a function when someone writes in the text field:*/
inp.addEventListener("input", function(e) {
  var a, b, i, val = this.value;
  /*close any already open lists of autocompleted values*/
  closeAllLists();
  if (!val) { return false;}
  currentFocus = -1;
  /*create a DIV element that will contain the items (values):*/
  a = document.createElement("DIV");
  a.setAttribute("id", this.id + "autocomplete-list");
  a.setAttribute("class", "autocomplete-items  form-control search-input floating");
  a.setAttribute("style", "background-color: white; text-align: left;height:200px; overflow:scroll;  position: absolute;z-index: 10;");
  /*append the DIV element as a child of the autocomplete container:*/
  this.parentNode.appendChild(a);
  /*for each item in the array...*/
  for (i = 0; i < arr.length; i++) {
    /*check if the item starts with the same letters as the text field value:*/
    if (arr[i].value.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
      /*create a DIV element for each matching element:*/
      b = document.createElement("DIV");
      b.setAttribute("class", "list-group-item-action");
      /*make the matching letters bold:*/
      b.innerHTML = "<strong>" + arr[i].value.substr(0, val.length) + "</strong>";
      b.innerHTML += arr[i].value.substr(val.length);
      /*insert a input field that will hold the current array item's value:*/
      b.innerHTML += "<input type='hidden' value='" + arr[i].value + "'>";
      b.innerHTML += "<input type='hidden' value='" + arr[i].desc + "'>";
      /*execute a function when someone clicks on the item value (DIV element):*/
      b.addEventListener("click", function(e) {
          /*insert the value for the autocomplete text field:*/
          inp.value = this.getElementsByTagName("input")[0].value;
          $("#service_id").val(this.getElementsByTagName("input")[1].value);
          /*close the list of autocompleted values,
          (or any other open lists of autocompleted values:*/
          closeAllLists();
      });
      a.appendChild(b);
    }
  }
});
/*execute a function presses a key on the keyboard:*/
inp.addEventListener("keydown", function(e) {
  var x = document.getElementById(this.id + "autocomplete-list");
  if (x) x = x.getElementsByTagName("div");
  if (e.keyCode == 40) {
    /*If the arrow DOWN key is pressed,
    increase the currentFocus variable:*/
    currentFocus++;
    /*and and make the current item more visible:*/
    addActive(x);
  } else if (e.keyCode == 38) { //up
    /*If the arrow UP key is pressed,
    decrease the currentFocus variable:*/
    currentFocus--;
    /*and and make the current item more visible:*/
    addActive(x);
  } else if (e.keyCode == 13) {
    /*If the ENTER key is pressed, prevent the form from being submitted,*/
    e.preventDefault();
    if (currentFocus > -1) {
      /*and simulate a click on the "active" item:*/
      if (x) x[currentFocus].click();
    }
  }
});
function addActive(x) {
/*a function to classify an item as "active":*/
if (!x) return false;
/*start by removing the "active" class on all items:*/
removeActive(x);
if (currentFocus >= x.length) currentFocus = 0;
if (currentFocus < 0) currentFocus = (x.length - 1);
/*add class "autocomplete-active":*/
x[currentFocus].classList.add("autocomplete-active");
}
function removeActive(x) {
/*a function to remove the "active" class from all autocomplete items:*/
for (var i = 0; i < x.length; i++) {
  x[i].classList.remove("autocomplete-active");
}
}
function closeAllLists(elmnt) {
/*close all autocomplete lists in the document,
except the one passed as an argument:*/
var x = document.getElementsByClassName("autocomplete-items");
for (var i = 0; i < x.length; i++) {
  if (elmnt != x[i] && elmnt != inp) {
    x[i].parentNode.removeChild(x[i]);
  }
}
}
/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
  closeAllLists(e.target);
  });
}




</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwRjBfftmMgmECTHn0mpOvYtYD7C8n2B8&libraries=places&callback=initAutocomplete"
    async defer></script>
<script>
$(document).ready(function() {
   initAutocomplete();
});

var autocompleteHeader;
function initAutocomplete() {
    autocompleteHeader = new google.maps.places.Autocomplete(
            (document.getElementById('searchPincode1')),
            {types: ['geocode']}
    );

    autocompleteHeader.addListener('place_changed', fillInAddressHeader);
}

function fillInAddressHeader() {

        // Get the place details from the autocomplete object.
        var place = autocompleteHeader.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        } else {
            address1 = '';
            address2 = '';
            city1 = '';
            city2 = '';
            state = '';
            country = '';
            postal_code = '';

            formatted_address = place.formatted_address;
            latitude = place.geometry.location.lat();
            longitude = place.geometry.location.lng();
            var arrAddress = place.address_components;


            $.each(arrAddress, function(i, address_component) {
                if (address_component.types[0] == "route") {
                    address1 = address_component.long_name;
                }
                if (address_component.types[0] == "sublocality") {
                    address2 = address_component.long_name;
                }

                if (address_component.types[0] == "locality") {
                    //alert("city1:"+address_component.long_name);
                    city1 = address_component.long_name;
                }
                if (address_component.types[0] == "administrative_area_level_2") {
                    city2 = address_component.long_name;
                }

                if (address_component.types[0] == "administrative_area_level_1") {
                    state = address_component.long_name;
                }
                if (address_component.types[0] == "country") {
                    country = address_component.long_name;
                }
                if (address_component.types[0] == "postal_code") {
                    postal_code = address_component.long_name;
                }
            });
            $("#postal_code").val(postal_code);
            $("#latitude").val(latitude);
            $("#longitude").val(longitude);
            /*$("#formatted_address").val(formatted_address);
            $("#address1").val(address1);
            $("#address2").val(address2);
            $("#country").val(country);
            $("#state").val(state);
            $("#city1").val(city1);
            $("#city2").val(city2);
            $("#postal_code").val(postal_code);
            $("#latitude").val(latitude);
            $("#longitude").val(longitude);*/


        }
    }
</script>

@endsection
