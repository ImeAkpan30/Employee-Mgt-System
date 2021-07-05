@extends('companies-mgmt.base')
@section('title', 'EM | Company Management')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold">Update Company</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('company-management.update', $company->id ) }}" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ $company->company_name }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                            <label for="company_email" class="col-md-4 control-label">Company Email</label>

                            <div class="col-md-6">
                                <input id="company_email" type="text" class="form-control" name="company_email" value="{{ $company->company_email }}" required>

                                @if ($errors->has('company_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                            <label for="company_address" class="col-md-4 control-label">Company Address</label>

                            <div class="col-md-6">
                                <input id="company_address" type="text" class="form-control" name="company_address" value="{{ $company->company_address }}" required>

                                @if ($errors->has('company_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                            <label for="company_phone" class="col-md-4 control-label">Company Phone</label>

                            <div class="col-md-6">
                                <input id="company_phone" type="text" class="form-control" name="company_phone" value="{{ $company->company_phone }}" required>

                                @if ($errors->has('company_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-md-4 control-label">State</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control" name="state" value="{{ $company->state }}" required>

                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">City</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ $company->city }}" required>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('company_website') ? ' has-error' : '' }}">
                            <label for="company_website" class="col-md-4 control-label">Company Website</label>

                            <div class="col-md-6">
                                <input id="company_website" type="text" class="form-control" name="company_website" value="{{ $company->company_website }}" required>

                                @if ($errors->has('company_website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('no_of_employees') ? ' has-error' : '' }}">
                            <label for="no_of_employees" class="col-md-4 control-label">Number of Employees</label>

                            <div class="col-md-6">
                                <input id="no_of_employees" type="text" class="form-control" name="no_of_employees" value="{{ $company->no_of_employees }}" required>

                                @if ($errors->has('no_of_employees'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('no_of_employees') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('services') ? ' has-error' : '' }}">
                            <label for="services" class="col-md-4 control-label">Services</label>

                            <div class="col-md-6">
                                <input id="services" type="text" class="form-control" name="services" value="{{ $company->services  }}" required>

                                @if ($errors->has('services'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('services') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="company_logo" class="col-md-4 control-label" >Company Logo</label>
                            <div class="col-md-4">
                                {{-- <img src="../../{{$company->picture }}" width="50px" height="50px"/> --}}
                                <input type="file" id="company_logo" name="company_logo" onchange="return previewImage(event)" required>
                            </div>
                            <div class="col-md-2">
                                <img id="output" width="50" height="50" style="border-radius: 50px" class="rounded-pill">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-refresh" aria-hidden="true"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function previewImage(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
