@extends('employees-mgmt.base')
@section('title', 'EM | Employee Management')

@section('action-content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold text-danger text">UPDATE EMPLOYEE</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action='{{ url("employee-management/update/{$employees->id}") }}' enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="row">
                              <div class="col-md-6">
                                <label for="firstname">First Name</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ $employees->firstname }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="col-md-6">
                                <label for="lastname">Last Name</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ $employees->lastname }}" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-6">
                                    <label for="middlename">Middle Name</label>
                                    <input id="middlename" type="text" class="form-control" name="middlename" value="{{ $employees->middlename }}" required>

                                    @if ($errors->has('middlename'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('middlename') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Gender</label>


                                    <select  class="form-control"  name="gender">
                                        <option value="" selected disabled>Please select your Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">


                                    <div class="col-md-12">

                                    <label for="address">Address</label>
                                    <input id="address" type="text" class="form-control" name="address" value="{{ $employees->address }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif

                                </div>

                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-6">
                                    <label for="phone">Phone Number</label>
                                    <input id="phone" type="text" class="form-control" name="phone" value="{{ $employees->phone}}" required>

                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="emergency_contact">Emergency Contact</label>
                                    <input id="emergency_contact" type="text" class="form-control" name="emergency_contact" value="{{ $employees->emergency_contact }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-6">
                                    <label for="inputAddress">Company</label>
                                    <select class="form-control"  name="companies_id">
                                        <option value="">Please select company</option>
                                            @foreach($companies as $company)
                                                <option {{$employees->company_id == $company->id ? 'selected' : ''}} value="{{$company->id}}">{{$company->company_name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress">Job Type</label>
                                    <select class="form-control"  name="job_type">
                                        <option value="">Please select job type</option>


                                        <option value="Full Time">Full Time</option>
                                          <option value="Part Time">Part Time</option>
                                          <option value="Intern">Intern</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 15px">
                                <div class="col-md-6">
                                    <label for="inputAddress">City</label>
                                    <select class="form-control" name="cities_id">
                                        @foreach ($cities as $city)
                                            <option {{$employees->city_id == $city->id ? 'selected' : ''}} value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputAddress">State</label>
                                    <select class="form-control" name="states_id">
                                        @foreach ($states as $state)
                                            <option {{$employees->state_id == $state->id ? 'selected' : ''}} value="{{$state->id}}">{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px">
                              <div class="col-md-6">
                                <label for="inputCity">Country</label>
                                <select class="form-control" name="countries_id">
                                    @foreach ($countries as $country)
                                        <option {{$employees->country_id == $country->id ? 'selected' : ''}} value="{{$country->id}}">{{$country->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                              <div class="col-md-6">
                                <label for="inputState">Zip</label>
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ $employees->zip }}" required>

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>
                            <div class="row" style="margin-top: 15px">

                                <div class="col-md-6">
                                    <label for="age">Age</label>
                                    <input id="age" type="text" class="form-control" name="age" value="{{ $employees->age }}" required>

                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('age') }}</strong>
                                        </span>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <label for="zip">Salary</label>
                                    <input id="salary" type="text" class="form-control" name="salary" value="{{ $employees->salary }}" required>

                                    @if ($errors->has('salary'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('salary') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px">

                                <div class="col-md-6">
                                    <label class="control-label">Birthday</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" value="{{ $employees->birthdate }}" name="birthdate" class="form-control pull-right" id="birthDate" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="">Hired Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" value="{{ $employees->date_hired }}" name="date_hired" class="form-control pull-right" id="hiredDate" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px">

                                <div class="col-md-6">
                                    <label class="control-label">Department</label>
                                    <select id="departments_id"  class="form-control" name="departments_id">

                                        @if(count($departments) > 0)
                                            @foreach($departments->all() as $department)
                                                <option {{$employees->departments_id == $department->id ? 'selected' : ''}} value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="control-label">Division</label>
                                    <select class="form-control" name="divisions_id">
                                        @foreach ($divisions as $division)
                                            <option {{$employees->divisions_id == $division->id ? 'selected' : ''}} value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row" style="margin-top: 15px">

                                <div class="col-md-6">
                                    <label for="picture" class="" >Picture</label>

                                    <input type="file" id="picture" name="picture" onchange="return previewImage(event)" required>
                                </div>
                                <div class="col-md-6">
                                    <img id="output" width="50" height="50" style="border-radius: 50px" class="rounded-pill">
                                </div>
                            </div>
                            <div class="row text-center" style="margin-top: 30px; margin-bottom: 20px">
                                <div class="col-md-8 col-md-offset-2">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> Update Employee
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
