@extends('users-mgmt.base')
@section('title', 'EM | Users Management')
@section('action-content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <!-- Main content -->
    <section class="content">

      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of users</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('user-management.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add new user</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('user-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['User Name', 'First Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['username'] : '', isset($searchingVals) ? $searchingVals['firstname'] : '']])
          @endcomponent
          </br>
          @component('layouts.two-cols-search-row', ['items' => ['Last Name', 'Role'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['lastname'] : '', isset($searchingVals) ? $searchingVals['role'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">User Name</th>
                <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending">Email</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="First Name: activate to sort column ascending">First Name</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Name: activate to sort column ascending">Last Name</th>
                <th width="20%" class="sorting hidden-xs text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Role: activate to sort column ascending">Role</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Leave count: activate to sort column ascending">Leave Count</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Last Login: activate to sort column ascending">Last Login</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Status</th>
                <th width="20%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Is Ban: activate to sort column ascending">Is Ban?</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr role="row" class="odd">
                  <td class="sorting_1 text-center">{{ $user->username }}</td>
                  <td class="text-center">{{ $user->email }}</td>
                  <td class="hidden-xs text-center">{{ $user->firstname }}</td>
                  <td class="hidden-xs text-center">{{ $user->lastname }}</td>
                  <td class="hidden-xs text-center">
                    @if($user->role =='manager')
                    <label class="label label-success">Manager</label>
                    @elseif($user->role =='employee')
                    <label class="label label-primary">Employee</label>
                    @endif
                  </td>
                  <td class="hidden-xs text-center">{{$user->approve_leave_count}}</td>
                  <td class="hidden-xs text-center">{{ \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() }}</td>

                  <td class="hidden-xs">
                    @if($user->isOnline())
                    <li class="text-success">
                        Online
                    </li>
                    {{-- <i class="fa fa-circle text-success"> Online</i> --}}
                    @else
                    <li class="text-muted">
                        Offline
                    </li>
                    {{-- <i class="fa fa-circle" style="color: red"> Offline</i> --}}
                    @endif
                  </td>
                  <td class="hidden-xs">
                    @if($user->isBanned())
                      <label class="label label-danger">Yes</label>
                    @else
                      <label class="label label-success">No</label>
                    @endif
                  </td>
                  <td>
                    {{-- <form class="row" method="POST" action="{{ route('user-management.destroy', ['id' => $user->id]) }}" onsubmit = "return confirm('Are you sure?')"> --}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @if($user->id === Auth::user()->id || Auth::user()->role=='admin')
                            <a href= "{{ route('user-management.edit',$user->id) }}"><i class="fa fa-edit"></i></a>
                        @endif

                        @if(Auth::user()->role=='admin')

                            <a href="{{ route('user-management.destroy',$user->id) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i></a>
                        @endif
                        @if($user->isBanned())
                            <a href="{{ route('user-management.revokeuser',$user->id) }}" class="btn btn-success btn-sm"> Revoke</a>
                                @elseif(Auth::user()->role =='admin')
                            <a class="btn btn-success ban btn-sm" data-id="{{ $user->id }}" data-action="{{ URL::route('user-management.ban') }}"> Ban</a>
                        @endif

                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $users->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>

<script type="text/javascript">
    $("body").on("click",".ban",function(){


      var current_object = $(this);


      bootbox.dialog({
      message: "<form class='form-inline add-to-ban' method='POST'><div class='form-group'><textarea class='form-control reason' rows='4' style='width:500px' placeholder='Add Reason for Ban this user.'></textarea></div></form>",
      title: "Add To Black List",
      buttons: {
        success: {
          label: "Submit",
          className: "btn-success",
          callback: function() {
                var baninfo = $('.reason').val();
                var token = $("input[name='_token']").val();
                var action = current_object.attr('data-action');
                var id = current_object.attr('data-id');


                if(baninfo == ''){
                    $('.reason').css('border-color','red');
                    return false;
                }else{
                    $('.add-to-ban').attr('action',action);
                    $('.add-to-ban').append('<input name="_token" type="hidden" value="'+ token +'">')
                    $('.add-to-ban').append('<input name="id" type="hidden" value="'+ id +'">')
                    $('.add-to-ban').append('<input name="baninfo" type="hidden" value="'+ baninfo +'">')
                    $('.add-to-ban').submit();
                }


          }
        },
        danger: {
          label: "Cancel",
          className: "btn-danger",
          callback: function() {
            // remove
          }
        },
      }
    });
});
</script>
@endsection
