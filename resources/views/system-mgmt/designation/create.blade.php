@extends('system-mgmt.designation.base')
@section('title', 'EM | System Management')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold text-danger text">NEW DESIGNATION PORTAL</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('designation.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('employee_name') ? ' has-error' : '' }}">
                            <label for="employee_name" class="col-md-4 control-label">Employee Name</label>

                            <div class="col-md-6">
                                <select type="text" name="employee_name" class="form-control" id="fname" placeholder="Select employee">
                                    @foreach($employees as $employee)
                                        {{--<option value="{{$user->all}}" {{ old('user') ? 'selected' : '' }}>{{$user->all()}}</option>--}}
                                        <option value="{{$employee->id}}" {{ old('user') ? 'selected' : '' }}>{{$employee->firstname}} {{$employee->lastname}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employee_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('employee_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                            <div class="form-group{{ $errors->has('designation') ? ' has-error' : '' }}">
                                <label for="fname" class="col-md-4 control-label">Designation Name</label>
                                <div class="col-md-6">
                                    <input type="text" name="designation" class="form-control" id="fname" placeholder="Enter a designation type">
                                </div>
                            </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
