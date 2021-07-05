@extends('employees-mgmt.base')
@section('title', 'EM | Employee Management')
@section('action-content')
    <!-- Main content -->
    <section class="content">

      <div class="box">

  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of employees</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('employee-management.create') }}"  onclick="loader()"><i class="fa fa-plus-circle"></i> Add new employee</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="text-center display" id="load">
    <div class="lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
</div>
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('employee-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['First Name', 'Company Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['firstname'] : '', isset($searchingVals) ? $searchingVals['employees.companies_id'] : '']])
          @endcomponent
        @endcomponent
      </form>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">

          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee Name</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company: activate to sort column ascending">Company</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Job type: activate to sort column ascending">Job Type</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Age</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Birthdate</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Join Date: activate to sort column ascending">Joined Date</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Division</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)

                <tr role="row" class="odd">
                  <td><img src="{{ $employee->image }}" width="50" height="50" style="border-radius: 50px"/></td>
                  <td class="sorting_1">{{ $employee->firstname }} {{$employee->middlename}} {{$employee->lastname}}</td>
                  <td class="hidden-xs">{{ $employee->address }}</td>
                  <td class="hidden-xs">{{ $employee->companies->company_name }}</td>
                  <td class="hidden-xs">{{ $employee->job_type }}</td>
                  <td class="hidden-xs">{{ $employee->age }}</td>
                  <td class="hidden-xs">{{ $employee->birthdate }}</td>
                  <td class="hidden-xs">{{ $employee->date_hired }}</td>
                  <td class="hidden-xs">{{ $employee->departments->name }}</td>
                  <td class="hidden-xs">{{ $employee->divisions->name }}</td>
                  <td >
                    <div class="dropdown">
                        {{-- <i class="fa fa-ellipsis-v text-muted dropbtn" style="margin-left: 23px;"></i>
                        <div class="dropdown-content">
                            <a href= "{{route('employee-management.show',$employee->id)}}", data-toggle="modal" data-target="#employee_{{$employee->id}}"><i class="fa fa-eye"></i> View</a>

                            <a href= "{{ route('employee-management.edit', $employee->id ) }}"><i class="fa fa-edit"></i> Edit</a>
                            <a href= "{{ route('mailbox.compose', $employee->id) }}"><i class="fa fa-envelope"></i> Mail</a>
                            <a href="{{ route('employee-management.destroy', $employee->id ) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i> Delete</a>
                        </div> --}}
                      {{-- </div> --}}


                        <a href= "{{route('employee-management.show',$employee->id)}}", data-toggle="modal" data-target="#employee_{{$employee->id}}"><i class="fa fa-eye"></i></a>

                        <a href= "{{ route('employee-management.edit', $employee->id ) }}"><i class="fa fa-edit"></i></a>
                        {{-- <a href= "{{ route('mailbox.compose', $employee->id) }}"><i class="fa fa-envelope"></i></a> --}}
                        <a href="{{ route('employee-management.destroy', $employee->id ) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i></a>

                       <!-- Modal -->
                       <div class="modal fade" id="employee_{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header" style="background-color:#3c8dbc; color:white">
                              <h5 class="modal-title text-center text-bold" id="exampleModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Employee Profile</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" style="color: white">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">


                                    <div class="row">
                                         <label for="full_name" class="col-md-6 text-muted"><i class="fa fa-user icon" aria-hidden="true"></i> {{ __('Full Name') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->firstname }} {{$employee->middlename}} {{$employee->lastname}}


                                        </div>
                                    </div>


                                    <div class="row" style="margin-top: 15px">
                                        <label for="username" class="col-md-6 col-form-label text-muted"><i class="fa fa-university icon" aria-hidden="true"></i> {{ __('Company Name') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->companies->company_name }}

                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-asterisk icon" aria-hidden="true"></i> {{ __('Job Type') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->job_type }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-map-marker icon" aria-hidden="true"></i> {{ __('Address') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->address }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-male icon" aria-hidden="true"></i> {{ __('Gender') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->gender }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"> <i class="fa fa-phone icon" aria-hidden="true"></i> {{ __('Phone Number') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->phone }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-briefcase icon" aria-hidden="true"></i> {{ __('Department') }}</label>

                                        <div class="col-md-6">

                                            {{ $employee->departments->name  }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-briefcase icon" aria-hidden="true"></i> {{ __('Division') }}</label>

                                        <div class="col-md-6">

                                            {{  $employee->divisions->name  }}
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 15px">
                                        <label for="email" class="col-md-6 col-form-label text-muted"><i class="fa fa-user icon" aria-hidden="true"></i> {{ __('Profile Picture') }}</label>

                                        <div class="col-md-6">

                                            <img src="{{ $employee->image }}" width="50" height="50" style="border-radius: 50px"/>
                                        </div>
                                    </div>

                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>

                            </div>
                          </div>
                        </div>
                      </div>


                    </div>

                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Picture: activate to sort column descending" aria-sort="ascending">Picture</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee Name</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company: activate to sort column ascending">Company</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Job type: activate to sort column ascending">Job Type</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending">Age</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthdate: activate to sort column ascending">Birthdate</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Joined Date: activate to sort column ascending">Joined Date</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Department</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Division</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{count($employees)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $employees->links() }}
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



@endsection

<script>
    function loader() {
  let load = document.getElementById("load");
  load.style.display = "block";
}


</script>

