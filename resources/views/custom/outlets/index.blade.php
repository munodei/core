@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{ $page_title }}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item">Outlets</li>
          <li class="breadcrumb-item active">{{ $page_title }}</li>
      </ul>
    </div>
    <div class="col-auto float-right ml-auto">
      <a href="{{ route('contacts.create') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add Contact</a>
      <div class="view-icons">
      </div>
    </div>
  </div>
</div>
<!-- /Page Header -->

<!-- Search Filter -->
<div class="row filter-row">



        <form  method="post"  class="col-sm-9 col-md-9 form-inline" action = "{{ route('search-contacts') }}" id="searchform"  value="{{ request('search')  }}"  autocomplete="off">
                                @csrf
            <div class="col-sm-6 col-md-6">
              <div class="form-group form-focus">
                <input type="text" class="form-control col-sm-6 col-md-6" name="search" value="{{ request('search')  }}"  autocomplete="off">

                <label class="focus-label">Search {{ $page_title }}...</label>
              </div>
            </div>
            <div class="col-sm-3 col-md-3">
                  <div class="form-group form-focus">
                  <select class="form-control floating" name="search" autocomplete="off">
                    @foreach($countries as $country)
                      <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                  </select>

                  <label class="focus-label">Select Country...</label>
                </div>
            </div>
           </form>

    <div class="col-sm-3 col-md-3">
      <button class="btn btn-success btn-block" onclick="event.preventDefault();document.getElementById('searchform').submit();"> Search </button>
    </div>

</div>
<!-- Search Filter -->
<br>

<div class="row staff-grid-row">

  @if(count($outlets) >0)
      @foreach($outlets as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="profile-img">
                <a href="{{ route('outlet.departments',['outlet'=>$data->slug,'department'=>$type]) }}" class="avatar"><center><img src="{{ $data->photo }}" alt="{{ $data->franchise }}" width="100%" height="100%"/></center></a>
              </div>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ route('outlet.departments',['outlet'=>$data->slug,'department'=>$type]) }}">{{ $data->franchise }}</a></h4>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="{{ route('outlet.departments',['outlet'=>$data->slug,'department'=>$type]) }}">{{ $data->country->name }}</a></h4>
              <br>
              <br>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
          <center> You don't have any Outlets in this Category!!</center>
      </div>

      @endif

{{$outlets->links()}}

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
      <script>
        function getContactID(id){

          $('#add_to_group_contact_id').val(id);

        }
      </script>

@endsection
