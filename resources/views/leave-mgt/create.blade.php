@extends('leave-mgt.base')

@section('action-content')



    <div class="page-wrapper">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
    @endif

            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


        <div class="container" style="margin-top: 20px;">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-bold">Leave Application</div>
                        <div class="panel-body">

                            <form action="{{route('leave.store')}}" method="post" class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label for="leave_type" class="col-md-4 control-label">Leave type</label>

                                    <div class="col-md-6">
                                        <input id="leave_type" type="text" class="form-control" name="leave_type" value="{{ old('leave_type') }}" placeholder="Leave Type" required autofocus>

                                        @if ($errors->has('leave_type'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('leave_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date_from" class="col-md-4 control-label">Date From</label>

                                    <div class="col-md-6">
                                        <input id="FromDate" type="date" min="{{date('Y-m-d')}}" class="form-control" name="date_from" required>

                                        @if ($errors->has('date_from'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date_from') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date_to" class="col-md-4 control-label">Date To</label>

                                    <div class="col-md-6">
                                        <input id="ToDate" type="date" class="form-control" name="date_to" required>

                                        @if ($errors->has('date_to'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('date_to') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="days" class="col-md-4 control-label">Days</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="days" id="TotalDays" placeholder="Number of leave days" required>

                                        @if ($errors->has('days'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('days') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="reason" class="col-md-4 control-label">Reason</label>

                                    <div class="col-md-6">
                                        <textarea type="text" name="reason" class="form-control" placeholder="Reason..."></textarea>

                                        @if ($errors->has('reason'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('reason') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Apply
                                        </button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    </div>

@endsection

@section('js')
    <script>
        $("#ToDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;

            // $('#TotalDays').val(days);
            if (days == NaN) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })

        $("#FromDate").change(function () {
            var start = new Date($('#FromDate').val());
            var end = new Date($('#ToDate').val());

            var diff = new Date(end - start);
            var days=1;
            days = diff / 1000 / 60 / 60 / 24;

            // $('#TotalDays').val(days);
            if (days == NaN) {
                $('#TotalDays').val(0);
            } else {
                $('#TotalDays').val(days+1);
            }
        })
    </script>
    @endsection
