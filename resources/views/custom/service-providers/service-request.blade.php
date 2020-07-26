@extends('nhbrc')
@section('css')
<meta property="og:image" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:secure_url" content="{{asset('assets/images/logo/favicon.png')}}" />
<meta property="og:image:type" content="image/png" />
<meta property="og:image:width" content="500" />
<meta property="og:image:height" content="500" />
<meta property="og:image:alt" content="{{ $basic->sitename }} | {{ $page_title }}" />
<meta property="og:description" content="{{ $basic->sitename }},   {{ $page_title }}" />
@endsection
@section('body')

      <!-- Page Wrapper -->
            <div class="page-wrapper">
                <div class="content container-fluid">

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

<div id="wrapper">
<div id="main" class="accessible">

<div id="app_body">

    <div id="header">
  <div id="application" class="">
    <a name="app"></a>
    <form>
          @csrf
          <input type="hidden" name="serviceid" value="">
          <input type="hidden" name="id" value="">
          <input type="hidden" name="action" value="post-service">
          <div class="form-group">
              <label for="service_title">Category Service</label>
              <input type="text" name="service_cat" id="service_cat" class="form-control required" id="service_cat" placeholder="Service Title" value="">
          </div>
          <div class="form-group">
              <label for="service_title">Service Title</label>
              <input type="text" name="service_title" class="form-control required" id="service_title" placeholder="Service Title" value="">
          </div>
            <div class="form-group">
            <label for="service_description">Please add extra information of the service required</label>
            <textarea name="service_description" class="form-control required" style="height:100px;" id="service_description"></textarea>
            </div>
            <div class="form-group">
            <div class="input-group">
            <label class="sr-only" for="budget"><font color="#FF0000">*</font>Budget</label>
            <div class="input-group-prepend">
              <div class="input-group-text">R</div>
            </div>
            <input type="text" name="budget" class="form-control budget required" min="1" digits="true" id="budget" placeholder="Enter Budget" value="" data-error-container="#budget-error-class">
            </div>
            <div id="budget-error-class"></div>
            </div>
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Service Date</div>
              </div>
            <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></div>
            <input type="date" name="service_date"  class="form-control" id="service_date"  placeholder="Service Date" value="">
            </div>
            <div id="datepicker-error-class"></div>
            </div>
            <div class="clearfix">
            <div class="row">
            <div class="col-sm-6">
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Time</div>
              </div>
            <div class="input-group-addon"><span class="glyphicon glyphicon-time" aria-hidden="true"></span></div>
            <input type="time" name="service_time" class="form-control" id="service_time" data-error-container="#timepicker-error-class" placeholder="12:30" value="">
            </div>
            <div id="timepicker-error-class"></div>
            </div>
            </div>
            <div class="col-sm-6">
            <div class="form-group">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">Service Hours</div>
              </div>
            <input type="number" name="service_hour" class="form-control" id="service_hour" data-error-container="#service-hour-error-class" min="0" placeholder="1" value="">

            </div>
            <div id="service-hour-error-class"></div>
            </div>
            </div>
            </div>
            </div>
               <div class="form-group">
            <div class="input-group">
              <label class="sr-only">Required At?</label>
              <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></div>
              <input type="text" name="searchPincode1" id="searchPincode1" class="form-control required" data-error-container="#address-hour-error-class" placeholder="Enter Address" value="" autocomplete="off">
            </div>
            <div id="address-error-class"></div>
          </div>

          <div class="form-group">
            <div class="input-group">
              <label class="sr-only">Postal Code</label>
              <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span></div>
              <input type="text" name="postal_code" id="postal_code" class="form-control required" value="" data-error-container="#pincode-hour-error-class" placeholder="Please enter your postal code">
            </div>
            <div id="pincode-error-class"></div>
          </div>
          <div class="clearfix margin-bottom-20"></div>
            <input type="hidden" name="latitude" id="latitude" value="">
            <input type="hidden" name="longitude" id="longitude" value="">
           <!--  <input type="hidden" name="pincode" id="pincode" value=""> -->

    <!-- <div class="map-panel" id="gMap"></div> -->
           <button type="submit" class="btn btn-primary">Send Request</button>

        </form>
                 </div>
        <!-- /Page Content -->
          </div>
      <!-- /Page Wrapper -->

             <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
<?php
$url =isset($mainCategories[0]->pagename)?$mainCategories[0]->pagename:'';
 ?>
jQuery(document).ready(function() {
   var availableTags = <?php echo $sqlSubcat;?>;
  autocomplete(document.getElementById("service_cat"), availableTags);
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
          $("#serviceid").val(this.getElementsByTagName("input")[1].value);
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
