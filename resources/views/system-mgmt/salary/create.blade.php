@extends('system-mgmt.salary.base')
@section('title', 'EM | System Management')

@section('action-content')
    <div class="container" style="margin-top: 25px;">
        <div class="page-wrapper">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center text-bold">Add Salary</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('salary.store') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('employee_name') ? ' has-error' : '' }}">
                                    <label for="employee_name" class="col-md-4 control-label">Employee Name</label>

                                    <div class="col-md-6">
                                        <select type="text" name="employee_name" class="form-control" id="fname" placeholder="">
                                            @foreach($users as $user)
                                                {{--<option value="{{$user->all}}" {{ old('user') ? 'selected' : '' }}>{{$user->all()}}</option>--}}
                                                <option value="{{$user->id}}" {{ old('user') ? 'selected' : '' }}>{{$user->username}}</option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('employee_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('employee_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Salary Amount</label>
                                    <div class="col-md-6">
                                        <input type="text" name="salary_amount" class="form-control" id="fname" placeholder="Enter a salary amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i>
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
    </div>
@endsection


