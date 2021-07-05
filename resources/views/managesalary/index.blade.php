@extends('managesalary.base')

@section('action-content')

    <div class="container" style="margin-top: 25px;">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-bold">Manage salary details</div>
                        <div class="panel-body">
                        <form class="form-horizontal" role="form" method="GET" action='{{url("manage-salary.detail")}}'>
                                {{-- {{ csrf_field() }} --}}

                                <div class="form-group{{ $errors->has('employee_id') ? ' has-error' : '' }}">
                                    <label for="employee_id" class="col-md-4 control-label">Employee Name</label>

                                    <div class="col-md-6">
                                        <select type="text" name="" class="form-control" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)";>
                                            <option value="0" disabled {{ old('user') ? '' : 'selected' }}>All</option>
                                            @foreach($employees as $employee)
                                                        {{--<option value="{{$user->all}}" {{ old('user') ? 'selected' : '' }}>{{$user->all()}}</option>--}}
                                                <option value="{{route('manage-salary.detail',$employee->id)}}" {{ old('user') ? 'selected' : '' }}>{{$employee->firstname}} {{$employee->lastname}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('employee_id'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('employee_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            Go
                                        </button>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
