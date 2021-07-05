@extends('system-mgmt.report.base')
@section('title', 'EM | System Management')
@section('action-content')

    <style>
        @media print  {
            #page-breadcrumb{
                display: none;
            }
            #form{
                display: none;
            }
            .no-print {
                display: none;
            }
        }
    </style>
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header" id="page-breadcrumb">
    <div class="row">
        <div class="col-sm-3">
          <h3 class="box-title text-bold">List of hired employees</h3>
        </div>
        <div class="col-sm-3">
            <button class="btn btn-danger" onclick="pdf()"><i class="fa fa-print"></i> Print</button>
        </div>
        <div class="col-sm-3">
            <form class="form-horizontal" role="form" method="GET" action="{{ route('report.excel') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['from']}}" name="from" />
                <input type="hidden" value="{{$searchingVals['to']}}" name="to" />
                <button type="submit" class="btn btn-primary">
                  Export to Excel
                </button>
            </form>
        </div>
        <div class="col-sm-3">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('report.pdf') }}">
                {{ csrf_field() }}
                <input type="hidden" value="{{$searchingVals['from']}}" name="from" />
                <input type="hidden" value="{{$searchingVals['to']}}" name="to" />
                <button type="submit" class="btn " style="background-color:#33a398; color:#fff">
                  Export to PDF
                </button>
            </form>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
      <form method="POST" action="{{ route('report.search') }}" id="form">
         {{ csrf_field() }}
         @component('layouts.search', ['title' => 'Search'])
          @component('layouts.two-cols-date-search-row', ['items' => ['From', 'To'],
          'oldVals' => [isset($searchingVals) ? $searchingVals['from'] : '', isset($searchingVals) ? $searchingVals['to'] : '']])
          @endcomponent
         @endcomponent
      </form>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending">Employee Name</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending">Company Name</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Birthday</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="departments_name: activate to sort column ascending">Departments name</th>
                <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Joined Day: activate to sort column ascending">Date Hired</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($employees as $employee)
                <tr role="row" class="odd">
                  <td>{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</td>
                  <td>{{ $employee->companies->company_name }} </td>
                  <td>{{ $employee->birthdate }}</td>
                  <td>{{ $employee->address }}</td>
                  <td>{{ $employee->departments->name }}</td>
                  <td>{{ $employee->date_hired }}</td>
              </tr>
            @endforeach
            </tbody>
            {{-- <tfoot>
              <tr role="row">
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Employee Name: activate to sort column ascending">Employee Name</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Company Name: activate to sort column ascending">Company Name</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Birthday: activate to sort column ascending">Birthday</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Address: activate to sort column ascending">Address</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="departments_name: activate to sort column ascending">Departments name</th>
                  <th width = "20%" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Joined Day: activate to sort column ascending">Joined Day</th>
              </tr>
            </tfoot> --}}
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($employees)}} of {{count($employees)}} entries</div>
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
    function pdf() {
        window.print();
    }
</script>
@endsection
