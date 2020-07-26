@extends('merchant-1')

@section('body')

    <!-- Page Header -->
<div class="page-header">
  <div class="row align-items-center">
    <div class="col">
      <h3 class="page-title">{{$page_title}}</h3>
      <ul class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Contacts</li>
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

    <div class="col-sm-6 col-md-3">
      <div class="form-group form-focus">
        <form  method="post" action = "{{ route('search-contacts') }}" id="searchform"  value="{{ request('search')  }}"  autocomplete="off">
                                @csrf
        <input type="text" class="form-control floating" name="search" value="{{ request('search')  }}"  autocomplete="off">
        </form>
        <label class="focus-label">Contact Name</label>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <button class="btn btn-success btn-block" onclick="event.preventDefault();document.getElementById('searchform').submit();"> Search </button>
    </div>

</div>
<!-- Search Filter -->

<div class="row staff-grid-row">

  @if(count($contacts) >0)
      @foreach($contacts as $k=>$data)
          <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
            <div class="profile-widget">
              <div class="profile-img">
                <a href="{{ route('contact',[$data->contactID]) }}" class="avatar"><img src="{{ url('/') }}/{{ $data->photo }}" alt="{{$data->firstname}} {{$data->lastname}}"></a>
              </div>
              <div class="dropdown profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                  <a class="dropdown-item" href="#" data-toggle="modal" onclick="getContactID({{ $data->contactID }});" data-target="#AddContactTogroup" ><i class="fa fa-folder m-r-5"></i> Add to Contact Group</a>
                  <a class="dropdown-item" href="{{ route('contact', [$data->contactID]) }}"><i class="fa fa-eye m-r-5"></i> View</a>
                  <a class="dropdown-item" href="{{ route('contacts.edit', $data->contactID) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                  <a class="dropdown-item" href="{{ route('delete-contact', $data->contactID) }}"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
              </div>
              <h4 class="user-name m-t-10 mb-0 text-ellipsis"><a href="#">{{$data->firstname}} {{$data->lastname}}</a></h4>
              <div class="small text-muted">{{$data->email}} {{$data->mobilephone}}</div>
              <br>
              <br>
            </div>
          </div>
      @endforeach
      @else
      <div class="col-md-4 col-sm-6 col-12 col-lg-4 col-xl-3">
          <center> You don't have any Contacts!!</center>
      </div>

      @endif

{{$contacts->links()}}

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
