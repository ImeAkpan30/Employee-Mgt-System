@extends('leave-mgt.base')
@section('title', 'EM | Leave Management')

@section('action-content')
    <!-- Main content -->
    <section class="content">
        <div class="box">
    <div class="box-header">
      <div class="row">
          <div class="col-sm-8">
            <h3 class="box-title">Leave List</h3>
          </div>
          <div class="col-sm-4">
            @if(Auth::user()->role=='employee')
            <a class="btn btn-primary" href="{{ route('leave.create') }}">Apply leave</a>
            @endif
          </div>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <div class="row">
          <div class="col-sm-6"></div>
          <div class="col-sm-6"></div>
        </div>
        <form method="GET" action="{{ route('leave.search') }}">
           {{ csrf_field() }}
            @component('layouts.search', ['title' => 'Search by leave type'])
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fname" class="col-sm-3 control-label">Leave type</label>
                            <div class="col-sm-6">
                            <input  type="text" class="form-control" name="search" id="fname" placeholder="Leave type">
                            </div>
                            <div class="col-sm-3">
                                <a href="{{route('leave')}}" class="btn btn-md" style="background-color:#33a398; color:#fff  "><i class="fa fa-refresh" > Refresh</i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endcomponent

        </form>
      <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
        <div class="row">
          <div class="col-sm-12">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
              <thead>
                <tr role="row">
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Employee name: activate to sort column ascending">Employee Name</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Leave type: activate to sort column ascending">Leave type</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Date from: activate to sort column ascending">Date From</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Date To: activate to sort column ascending">Date To</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="No. of days: activate to sort column ascending">No. of days</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Reason: activate to sort column ascending">Reason</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Reference No: activate to sort column ascending">Reference No</th>
                  <th width="12%" class="sorting text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Leave type offer: activate to sort column ascending">Leave Type Offer</th>
                  <th  width="15%" class="text-center" tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($leaves as $leave)
                  <tr role="row" class="odd">
                    <td class="text-center">{{$leave->users->firstname }} {{$leave->users->lastname }}</td>
                    <td class="text-center">{{$leave->leave_type}}</td>
                    <td class="text-center">{{$leave->date_from}}</td>
                    <td class="text-center">{{$leave->date_to}}</td>
                    <td class="text-center">{{$leave->days}}</td>
                    <td class="text-center">{{$leave->reason}}</td>
                    <td class="text-center">{{$leave->reference_no}}</td>

                    <td class="text-center" style="display: inline-flex">
                        @if(Auth::user()->role=='admin')

                        @if($leave->leave_type_offer==0)
                            <form id="{{$leave->id}}" action="{{route('leave.paid',$leave->id)}}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure you want to be paid for leave?')" class="btn btn-sm btn-success" name="paid" value="1">Paid</button>
                            </form>
                            <form id="{{$leave->id}}" action="{{route('leave.unpaid',$leave->id)}}" method="POST">
                                @csrf
                                <button type="submit" onclick="return confirm('Are you sure want to be unpaid for leave?')" class="btn btn-sm btn-danger" name="paid" value="2">Unpaid</button>
                            </form>
                        @elseif($leave->leave_type_offer==1)

                            <form action="{{route('leave.unpaid',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to unpay for leave?')" type="submit" name="paid" value="2">Unpaid</button>
                            </form>
                        @else
                            <form action="{{route('leave.paid',$leave->id)}}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to pay for leave?')" type="submit" name="paid" value="1">Paid</button>
                            </form>
                        @endif

                    @else
                        @if($leave->leave_type_offer==0)
                            <span class="label label-warning">Pending</span>
                        @elseif($leave->leave_type_offer==1)
                            <span class="label label-success">Paid</span>
                        @else
                            <span class="label label-danger">Unpaid</span>
                        @endif
                    @endif

                </td>

                        <td class="text-center">
                            @if(Auth::user()->role=='admin')

                            @if($leave->is_approved==0)
                                <form id="approve-leave-{{$leave->id}}" action="{{route('leave.approve',$leave->id)}}" method="POST">
                                  @csrf
                                  <button type="submit" onclick="return confirm('Are you sure want to approve leave?')" class="btn btn-sm btn-success" name="approve" value="1">Approve</button>
                                </form>
                                <form id="reject-leave-{{$leave->id}}" action="{{route('leave.reject',$leave->id)}}" method="POST">
                                  @csrf
                                  <button type="submit" onclick="return confirm('Are you sure you want to reject leave?')" class="btn btn-sm btn-danger " name="approve" value="2">Reject</button>
                                </form>
                            @elseif($leave->is_approved==1)

                                <form action="{{route('leave.reject',$leave->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to reject leave?')" type="submit" name="approve" value="2">Reject</button>
                                </form>
                            @else
                                <form action="{{route('leave.approve',$leave->id)}}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve leave?')" type="submit" name="approve" value="1">Approve</button>
                                </form>
                            @endif

                                @else
                                @if($leave->is_approved==0)
                                    <span class="label label-warning">Pending</span>
                                @elseif($leave->is_approved==1)
                                    <span class="label label-success">Approved</span>
                                @else
                                    <span class="label label-danger">Rejected</span>
                                @endif
                            @endif
                    </td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
                <tr>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >Employee Name</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >Leave type</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >Date From</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >Date To</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >No. of days</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1" >Reason</th>
                    <th width="10%" class="text-center"  rowspan="1" colspan="1">Leave Type Offer</th>
                    <th  width="20%" class="text-center" rowspan="1" colspan="2">Action</th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to {{count($leaves)}} of {{count($leaves)}} entries</div>
          </div>
          <div class="col-sm-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{ $leaves->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
    </section>
    <!-- /.content -->

@endsection
