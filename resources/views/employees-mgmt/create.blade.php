@extends('employees-mgmt.base')
@section('title', 'EM | Employee Management')

@section('action-content')
<br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold text-danger text">NEW EMPLOYEE PORTAL <a href= "{{ url('employee-management') }}"><i class="fa fa-arrow-left btn btn-default same pull-right" id="same"></i></a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('employee-management.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                            <label for="middlename" class="col-md-4 control-label">Middle Name</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control" name="middlename" value="{{ old('middlename') }}" required>

                                @if ($errors->has('middlename'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">

                                <select  class="form-control"  name="gender">
                                    <option value="" selected disabled>Please select your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('emergency_contact') ? ' has-error' : '' }}">
                            <label for="emergency_contact" class="col-md-4 control-label">Emergency Contact</label>

                            <div class="col-md-6">
                                <input id="emergency_contact" type="text" class="form-control" name="emergency_contact" value="{{ old('emergency_contact') }}" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Company</label>
                            <div class="col-md-6">
                                <select id="companies_id" type="companies_id" class="form-control"  name="companies_id">
                                    <option value="">Please select company</option>
                                    @if(count($companies) > 0)
                                        @foreach($companies->all() as $company)
                                            <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Job Type</label>
                            <div class="col-md-6">
                                <select id="job_type" type="job_type" class="form-control"  name="job_type">
                                    <option value="">Please select job type</option>

                                      <option value="Full Time">Full Time</option>
                                      <option value="Part Time">Part Time</option>
                                      <option value="Intern">Intern</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Country</label>
                            <div class="col-md-6">
                                <select id="countries_id" type="countries_id" class="form-control"  name="countries_id">
                                    <option value="">Please select your country</option>
                                    @if(count($countries) > 0)
                                        @foreach($countries->all() as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">State</label>
                            <div class="col-md-6">

                                <select id="states_id" type="states_id" class="form-control"  name="states_id">
                                    <option value="">Please select your state</option>
                                    @if(count($states) > 0)
                                        @foreach($states->all() as $state)
                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">City</label>
                            <div class="col-md-6">
                                <select class="form-control js-cities" name="cities_id">
                                    <option value="-1">Please select your city</option>
                                     @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Zip</label>

                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control" name="zip" value="{{ old('zip') }}" required>

                                @if ($errors->has('zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Age</label>

                            <div class="col-md-6">
                                <input id="age" type="text" class="form-control" name="age" value="{{ old('age') }}" required>

                                @if ($errors->has('age'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('salary') ? ' has-error' : '' }}">
                            <label for="zip" class="col-md-4 control-label">Salary</label>

                            <div class="col-md-6">
                                <input id="salary" type="text" class="form-control" name="salary" value="{{ old('salary') }}" required>

                                @if ($errors->has('salary'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Birthday</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('birthdate') }}" name="birthdate" class="form-control pull-right" id="birthDate" required>
                                </div>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Joined Date</label>
                            <div class="col-md-6">
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{ old('date_hired') }}" name="date_hired" class="form-control pull-right" id="hiredDate" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('department_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <select id="departments_id" type="departments_id" class="form-control"  name="departments_id">
                                    <option value="">Please select your Department</option>
                                    @if(count($departments) > 0)
                                        @foreach($departments->all() as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                 @if ($errors->has('departments_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('departments_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('divisions_id') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Division</label>
                            <div class="col-md-6">
                                <select id="divisions_id" type="divisions_id" class="form-control"  name="divisions_id">
                                    <option value="">Please select your Division</option>
                                    @if(count($divisions) > 0)
                                        @foreach($divisions->all() as $division)
                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                 @if ($errors->has('division_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('division_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="picture" class="col-md-4 control-label" >Picture</label>
                            <div class="col-md-4">
                                <input type="file" id="picture" name="picture" onchange="return previewImage(event)" required>

                            </div>
                            <div class="col-md-2">
                                <img id="output" width="50" height="50" style="border-radius: 50px">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div> --}}

        <div class="stepwizard">
           <div class="stepwizard-row">
               <div class="stepwizard-step col-lg-3">
                   <a href="" type="button" class="btn btn-success btn-circle">1</a>
                   <p><small>Personal Information</small></p>
               </div>
               <div class="stepwizard-step col-lg-3" >
                   <a href="" type="button" class="btn btn-default btn-circle header1" disabled="disabled">2</a>
                   <p><small>Contact Information</small></p>
               </div>
               <div class="stepwizard-step col-lg-3">
                   <a href="" type="button" class="btn btn-default btn-circle header2" disabled="disabled">3</a>
                   <p><small>Job Details</small></p>
               </div>
               <div class="stepwizard-step col-lg-3" id="header3">
                   <a href="" type="button" class="btn btn-default btn-circle header3" disabled="disabled">4</a>
                   <p><small>Others</small></p>
               </div>
           </div>
        </div>

    <div class="card shadow mt-3">
        <div class="card-body card_display active">
            <h5 class="modal-title text-bold" id="exampleModalLabel">PERSONAL INFORMATION</h5>
            <hr>
            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                <label for="firstname" class="col-md-2 control-label">First Name</label>

                <div class="col-md-8">
                    <input id="firstname" type="text" class="form-control"  placeholder="First Name" name="firstname" value="{{ old('firstname') }}" required autofocus>

                    @if ($errors->has('firstname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('firstname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                <label for="lastname" class="col-md-2 control-label">Last Name</label>

                <div class="col-md-8">
                    <input id="lastname" type="text" class="form-control"  placeholder="Last Name" name="lastname" value="{{ old('lastname') }}" required>

                    @if ($errors->has('lastname'))
                        <span class="help-block">
                            <strong>{{ $errors->first('lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('middlename') ? ' has-error' : '' }}">
                <label for="middlename" class="col-md-2 control-label">Middle Name</label>

                <div class="col-md-8">
                    <input id="middlename" type="text" class="form-control" placeholder="Middle Name" name="middlename" value="{{ old('middlename') }}" required>

                    @if ($errors->has('middlename'))
                        <span class="help-block">
                            <strong>{{ $errors->first('middlename') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                <label for="age" class="col-md-2 control-label">Age</label>

                <div class="col-md-8">
                    <input id="age" type="text" class="form-control" placeholder="Enter Age" name="age" value="{{ old('age') }}" required>

                    @if ($errors->has('age'))
                        <span class="help-block">
                            <strong>{{ $errors->first('age') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Birthday</label>
                <div class="col-md-8">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="{{ old('birthdate') }}" name="birthdate" class="form-control pull-right" id="birthDate" required>
                    </div>
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address" class="col-md-2 control-label">Gender</label>

                <div class="col-md-8">
                    <select  class="form-control"  name="gender">
                        <option value="" selected disabled>Please select your Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="picture" class="col-md-2 control-label" >Picture</label>
                <div class="col-md-6">
                    <input type="file" id="picture" name="picture" onchange="return previewImage(event)" required>

                </div>
                <div class="col-md-2">
                    <img id="output" width="50" height="50" style="border-radius: 50px">
                </div>
            </div>
        </div>

       <div class="card-body card_display">
            <h5 class="modal-title text-bold" id="exampleModalLabel">CONTACT INFORMATION</h5>
            <hr/>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="col-md-2 control-label">Contact No.</label>

                <div class="col-md-8">
                    <input id="phone" type="text" class="form-control" placeholder="Enter Contact Number" name="phone" value="{{ old('phone') }}" required>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('emergency_contact') ? ' has-error' : '' }}">
                <label for="emergency_contact" class="col-md-2 control-label">Emergency Contact</label>

                <div class="col-md-8">
                    <input id="emergency_contact" type="text" class="form-control" placeholder="Enter emergency contact" name="emergency_contact" value="{{ old('emergency_contact') }}" required>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address" class="col-md-2 control-label">Address</label>

                <div class="col-md-8">
                    <input id="address" type="text" class="form-control" placeholder="Enter Address" name="address" value="{{ old('address') }}" required>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="card-body card_display">
           <h5 class="modal-title text-bold" id="exampleModalLabel">JOB DETAILS</h5>
           <hr>
            <div class="form-group mt-3">
                <label class="col-md-2 control-label">Department</label>
                <div class="col-md-8">

                    <select id="departments_id" type="departments_id" class="form-control"  name="departments_id">
                        <option value="">Please select your Department</option>
                        @if(count($departments) > 0)
                            @foreach($departments->all() as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Division</label>
                <div class="col-md-8">
                    <select id="divisions_id" type="divisions_id" class="form-control"  name="divisions_id">
                        <option value="">Please select your Division</option>
                        @if(count($divisions) > 0)
                            @foreach($divisions->all() as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Join Date</label>
                <div class="col-md-8">
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" value="{{ old('date_hired') }}" name="date_hired" class="form-control pull-right" id="hiredDate" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Company</label>
                <div class="col-md-8">
                    <select id="companies_id" type="companies_id" class="form-control"  name="companies_id">
                        <option value="">Please select company</option>
                        @if(count($companies) > 0)
                            @foreach($companies->all() as $company)
                                <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Job Type</label>
                <div class="col-md-8">
                    <select id="job_type" type="job_type" class="form-control"  name="job_type">
                        <option value="">Please select job type</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        <option value="Intern">Intern</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="salary" class="col-md-2 control-label">Salary</label>
                <div class="col-md-8">
                    <input id="salary" type="text" class="form-control" placeholder="Enter Salary" name="salary" value="{{ old('salary') }}" required>
                </div>
            </div>
        </div>

        <div class="card-body card_display">
            <h5 class="modal-title text-bold" id="exampleModalLabel">OTHERS</h5>
            <hr>
            <div class="form-group">
                <label class="col-md-2 control-label">City</label>
                <div class="col-md-8">
                    <select class="form-control js-cities" name="cities_id">
                        <option value="-1">Please select your city</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">State</label>
                <div class="col-md-8">
                    <select id="states_id" type="states_id" class="form-control"  name="states_id">
                        <option value="">Please select your state</option>
                        @if(count($states) > 0)
                            @foreach($states->all() as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">Country</label>
                <div class="col-md-8">
                    <select id="countries_id" type="countries_id" class="form-control"  name="countries_id">
                        <option value="">Please select your country</option>
                        @if(count($countries) > 0)
                            @foreach($countries->all() as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="zip" class="col-md-2 control-label">Zip</label>
                <div class="col-md-8">
                    <input id="zip" type="text" class="form-control" placeholder="Enter Zip" name="zip" value="{{ old('zip') }}" required>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="mt-3 text-center">
                <button type="" class="btn btn-primary sleep prev"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
                <button type="" class="btn btn-info next"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>


            </div>
            <div style="text-align: center">
                <button type="submit" class="btn btn-success eat sub" id="hide"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employee</button>
            </div>
        </div>
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

    let nextBtn = document.querySelector('.next')
let prevBtn = document.querySelector('.prev')
let cardDisplay = document.querySelectorAll(".card_display")
let button = document.querySelector('.btn')
let header1 = document.querySelector(".header1")
let header2 = document.querySelector(".header2")
let header3 = document.getElementById("header3")
let show = document.querySelector(".stepwizard-row").children
let hide = document.querySelector("#hide")
let currentForm = 0

prevBtn.addEventListener('click', function(){
   nextBtn.disabled = false
   if(currentForm === 0){
       prevBtn.disabled = true
   }
   else{
    cardDisplay[currentForm].classList.remove('active');
    currentForm--;
    cardDisplay[currentForm].classList.add('active')

    for( let i = 0; i <=show.length; i++){
        if(show[i] = cardDisplay){
            show[currentForm + 1].querySelector(".btn-circle").style.backgroundColor= "#ccc"
        }
    }
   }
})

nextBtn.addEventListener('click', function(){
    // hide.style.display = "none"
    prevBtn.disabled = false
    cardDisplay[currentForm].classList.remove('active');
    currentForm++;
    cardDisplay[currentForm].classList.add('active')


    if(currentForm + 1 === cardDisplay.length){
        nextBtn.disabled = true
        hide.style.display = "block"
    }
    for( let i = 0; i <=show.length; i++){
            if(show[i] = cardDisplay){
                show[currentForm].querySelector(".btn-circle").style.backgroundColor= "green"
            }
        }
})

</script>
@endsection
