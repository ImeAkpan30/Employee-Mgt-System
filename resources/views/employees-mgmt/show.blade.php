@extends('employees-mgmt.base')
@section('title', 'EM | Employee Management')

@section('action-content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold">Employee Profile</div>
                <div class="panel-body">

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">First Name</label>

                            <div class="col-md-6">
                                {{ $employees->firstname }}


                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">Last Name</label>

                            <div class="col-md-6">
                                {{ $employees->lastname }}


                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                {{ $employees->middlename }}


                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                {{ $employees->address }}


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Company</label>
                            <div class="col-md-6">

                                            {{$employees->companies->company_name}}

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Job Type</label>
                            <div class="col-md-6">

                                    {{$employees->job_type}}

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">City</label>
                            <div class="col-md-6">

                                        {{$employees->cities->name}}

                            </div>
                        </div>
                              <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">State</label>
                            <div class="col-md-6">

                                       {{$employees->states->name}}

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">Country</label>
                            <div class="col-md-6">

                                        {{$employees->countries->name}}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">Salary</label>

                            <div class="col-md-6">
                                {{ $employees->salary }}


                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right">{{ __('Hired Date') }}</label>
                            <div class="col-md-6">

                                {{ $employees->date_hired }}

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">

                                {{ $employees->departments->name  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                            <div class="col-md-6">

                                {{  $employees->divisions->name  }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="picture" class="col-md-4 col-form-label text-md-right" >{{ __('Profile Picture') }}</label>
                            <div class="col-md-6">

                                <img src="{{ $employees->image }}" width="50" height="50" style="border-radius: 50px"/>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-md-offset-4">
                                <a class="btn btn-primary" href="{{ url('employee-management') }}"
                                    style="margin-top: 10px; padding-left: 15px; padding-right: 15px;"><i class="fa fa-arrow-left fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
