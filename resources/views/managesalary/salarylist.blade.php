@extends('managesalary.base')

@section('action-content')

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>

    <!-- Main content -->
    <section class="content">
        <div class="box">
    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
            <h3 class="box-title">Lists of employees and their salary lists</h3>
          </div>
          <div class="col-sm-4">
            <a class="btn btn-primary" href="{{ route('managesalary') }}"> Back</a>
          </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="zero_config" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="S.N: activate to sort column ascending">S.N</th>
                  <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Employee name: activate to sort column ascending">Employee Name</th>
                  <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Designation type: activate to sort column ascending">Designation Type</th>
                  <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Working days: activate to sort column ascending">Working Days</th>
                  <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Tax %: activate to sort column ascending">Tax %</th>
                  <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Gross salary: activate to sort column ascending">Gross Salary</th>
                  <th tabindex="0" class="text-center" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                </tr>
              </thead>
              <tbody>
              {{-- {{$users}} --}}
              @foreach($users as $user)
                  <tr role="row" class="odd">
                    <td class="text-center">{{$loop->index+1 }}</td>
                    <td class="text-center">{{ $user->employee_name }}</td>
                    <td class="text-center">{{ $user->designation_type }}</td>
                    <td class="text-center">{{ $user->working_days}}</td>
                    <td class="text-center">{{ $user->tax }}</td>
                    <td class="text-center">{{ $user->gross_salary }}</td>
                    <td class="text-center">
                        <a href="{{route('managesalary.makepayment',$user->id)}}" class="btn btn-sm btn-success">Generate Payslip</a>
                    </td>
                </tr>
              @endforeach
              </tbody>
              {{-- <tfoot>
                <tr>
                  <th width="10%" class="text-center" rowspan="1" colspan="1">S.N</th>
                  <th width="20%" class="text-center" rowspan="1" colspan="1">Employee Name</th>
                  <th width="20%" class="text-center" rowspan="1" colspan="1">Designation Type</th>
                  <th width="20%" class="text-center" rowspan="1" colspan="1">Working Days</th>
                  <th width="20%" class="text-center" rowspan="1" colspan="1">Tax %</th>
                  <th width="20%" class="text-center" tabindex="0" rowspan="1" colspan="1">Gross Salary</th>
                  <th rowspan="1" class="text-center" colspan="2">Action</th>
                </tr>
              </tfoot> --}}
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($users)}} of {{count($users)}} entries</div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
      </section>
      <!-- /.content -->
    </div>

        <script>
            $(document).ready(function() {
                $('#zero_config').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                        ]
                    } );
                } );
            </script>

@endsection
