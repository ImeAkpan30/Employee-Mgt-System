@extends('system-mgmt.designation.base')
@section('title', 'EM | System Management')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Designation List</h3>
        </div>
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('designation.create') }}"><i class="fa fa-plus-circle"></i> Add designation</a>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
    <form method="POST" action="{{ route('designation.search') }}">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-search-row', ['items' => ['Designation Type'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['designation_type'] : '']])
          @endcomponent
        @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="S/N: activate to sort column ascending">S/N</th>
                <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Employee Name: activate to sort column ascending">Employee Name</th>
                <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Designation Type: activate to sort column ascending">Designation Type</th>
                <th  width="20%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($designations as $designation)
                <tr role="row" class="odd">
                    <td class="text-center">{{$loop->index+1 }}</td>
                    <td class="text-center">{{ $designation->employees->firstname }} {{ $designation->employees->lastname }}</td>
                    <td class="text-center">{{ $designation->designation_type }}</td>
                    <td class="text-center">
                        {{-- <form id="delete-form-{{$designation->id}}" action="{{route('designation.delete',$designation->id)}}" method="put">
                            @csrf
                            @method('DELETE')
                               <a href="{{route('designation.edit',$designation->id)}}"><i class="fa fa-edit"></i></a>
                            <button type="button" onclick="deletePost({{$designation->id}})" class="btn btn-sm btn-danger">Delete</button>
                            <i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?');deletePost({{$designation->id}})"></i></a>
                        </form> --}}

                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <a href= "{{ route('designation.edit',$designation->id) }}"><i class="fa fa-edit"></i></a>
                        <a href="{{ route('designation.delete',$designation->id) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?');deletePost({{$designation->id}})"></i></a>

                  </td>
              </tr>
            @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th width="10%" class="text-center" tabindex="0" rowspan="1" colspan="1">S/N</th>
                <th width="20%" class="text-center" tabindex="0" rowspan="1" colspan="1">Employee Name</th>
                <th width="20%" class="text-center" tabindex="0" rowspan="1" colspan="1">Designation Type</th>
                <th  width="20%" class="text-center" tabindex="0" rowspan="1" colspan="2">Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-5">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($designations)}} of {{count($designations)}} entries</div>
        </div>
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $designations->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->



            {{--sweetalert box for deleting start--}}
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.8/dist/sweetalert2.all.min.js"></script>

            <script type="text/javascript">
                function deletePost(id)

                {
                    const swalWithBootstrapButtons = swal.mixin({
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger',
                        buttonsStyling: false,
                    })

                    swalWithBootstrapButtons({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, cancel!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            event.preventDefault();
                            document.getElementById('delete-form-'+id).submit();
                        } else if (
                            // Read more about handling dismissals
                            result.dismiss === swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons(
                                'Cancelled',
                                'Your file is safe :)',
                                'error'
                            )
                        }
                    })
                }

            </script>
            {{--sweetalert box for deleting end--}}
        </div>
@endsection
