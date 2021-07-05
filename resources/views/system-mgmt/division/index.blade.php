@extends('system-mgmt.division.base')
@section('title', 'EM | System Management')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of divisions</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('division.create') }}"><i class="fa fa-plus-circle"></i> Add new division</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('division.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Name'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['name'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="division: activate to sort column ascending">Division Name</th>
                <th  width="20%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($divisions as $division)
                <tr role="row" class="odd">
                  <td class="text-center">{{ $division->name }}</td>
                  <td class="text-center">
                    {{-- <form class="row" method="POST" action="{{ route('division.destroy', ['id' => $division->id]) }}" onsubmit = "return confirm('Are you sure?')"> --}}
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href= "{{ route('division.edit',$division->id) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('division.destroy',$division->id) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i></a>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
            {{-- <tfoot>
              <tr>
                <th class="text-center" width="20%" rowspan="1" colspan="1">Division Name</th>
                <th class="text-center" rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot> --}}
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($divisions)}} of {{count($divisions)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $divisions->links() }}
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
