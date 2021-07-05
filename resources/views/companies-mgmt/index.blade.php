@extends('companies-mgmt.base')
@section('title', 'EM | Company Management')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-6">
          <h3 class="box-title">List of companies</h3>
        </div>
        <div class="col-sm-3">
          <a class="btn btn-primary" href="{{ route('company-management.create') }}"><i class="fa fa-plus-circle"></i> Add new Company</a>
        </div>
        <div class="col-sm-3">
          <a class="btn btn-info" href="{{ route('company-management.create') }}"> <i class="fa fa-paper-plane" ></i> Send Company Invite</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('company-management.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Company_Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['company_name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Logo: activate to sort column descending" aria-sort="ascending">Company Logo</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column descending" aria-sort="ascending">Company Name</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Email: activate to sort column ascending">Company Email</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Website: activate to sort column ascending">Company Website</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Address: activate to sort column ascending">Company Address</th>
                {{-- <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Phone: activate to sort column ascending">Company Phone</th> --}}
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="No. of Employees: activate to sort column ascending">No. of Employees</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Services: activate to sort column ascending">Services</th>
                <th width="8%" tabindex="0" aria-controls="example2" class="text-center" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($companies as $company)
                <tr role="row" class="odd">
                  <td><img src="{{ $company->logo }}" width="50" height="50" style="border-radius: 50px"/></td>
                  <td class="sorting_1">{{ $company->company_name }} </td>
                  <td class="hidden-xs">{{ $company->company_email }}</td>
                  <td class="hidden-xs">{{ $company->company_website }}</td>
                  <td class="hidden-xs">{{ $company->company_address }}</td>
                  {{-- <td class="hidden-xs">{{ $company->company_phone }}</td> --}}
                  <td class="hidden-xs">{{ $company->no_of_employees }}</td>
                  <td class="hidden-xs">{{ $company->services }}</td>
                  <td class="hidden-xs text-center">
                    {{-- <form class="row" method="POST" action="{{ route('employee-management.destroy', ['id' => $employee->id]) }}" onsubmit = "return confirm('Are you sure?')"> --}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href= "{{ route('company-management.edit', $company->id ) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('company-management.destroy', $company->id ) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i></a>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <tr role="row">
                <th width="8%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Logo: activate to sort column descending" aria-sort="ascending">Company Logo</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column descending" aria-sort="ascending">Company Name</th>
                <th width="12%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Email: activate to sort column ascending">Company Email</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Website: activate to sort column ascending">Company Website</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Address: activate to sort column ascending">Company Address</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="No. of Employees: activate to sort column ascending">No. of Employees</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Services: activate to sort column ascending">Services</th>
                <th tabindex="0" class="text-center" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($companies)}} of {{count($companies)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $companies->links() }}
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
