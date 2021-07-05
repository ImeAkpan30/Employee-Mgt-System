@extends('system-mgmt.salary.base')
@section('title', 'EM | System Management')

@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h3 class="box-title">Salary List</h3>
                    </div>
                    <div class="col-sm-4">
                        @if(Auth::user()->role=='admin')
                        <a class="btn btn-primary" href="{{ route('salary.create') }}"><i class="fa fa-plus-circle"></i> Add Salary</a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                                <thead>
                                    <tr role="row">
                                        <th width="10%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="S/N: activate to sort column ascending">S/N</th>
                                        <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Employe name: activate to sort column ascending">Employe Name</th>
                                        <th width="20%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Salary Amount: activate to sort column ascending">Salary Amount</th>
                                        <th width="20%" tabindex="0" class="text-center" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{$salaries}}
                                    @foreach($salaries as $salary)
                                        <tr role="row" class="odd">
                                            <td class="text-center">{{ $loop->index+1 }}</td>
                                            <td class="text-center">{{ $salary->users->username }}</td>
                                            <td class="text-center">{{ $salary->salary_amount }}</td>
                                            <td class="text-center">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <a href= "{{ route('salary.edit',$salary->id) }}"><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('salary.delete',$salary->id) }}"><i class="fa fa-trash ml-4" style="color:red" onclick = "return confirm('Are you sure?')"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="10%" class="text-center" rowspan="1" colspan="1">S/N</th>
                                        <th width="20%" class="text-center" rowspan="1" colspan="1">Employe Name</th>
                                        <th width="20%" class="text-center" rowspan="1" colspan="1">Salary Amount</th>
                                        <th tabindex="0" class="text-center" rowspan="1" colspan="2">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($salaries)}} of {{count($salaries)}} entries</div>
                    </div>
                    <div class="col-sm-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                        {{ $salaries->links() }}
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </section>
    <!-- /.content -->

@endsection
