@extends('system-mgmt.salary.base')
@section('title', 'EM | System Management')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold">Update Salary</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('salary.update', ['id' => $salary->id]) }}">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="salary_amount" class="col-md-4 control-label">Salary amount</label>

                            <div class="col-md-6">
                                <input id="salary_amount" type="text" class="form-control" name="salary_amount" value="{{ $salary->salary_amount }}">

                                @if ($errors->has('salary_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salary_amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
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
