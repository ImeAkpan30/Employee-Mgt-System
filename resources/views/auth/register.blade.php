@extends('layouts.app')

@section('content')
<div>
    <div class="grid">
        <div>
            <div class="form1 logi">
                <div class="text-center display" id="load">
                    <div class="lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>

                <div class="text-center text-bold log">{{ __('Register') }}</div>

                <div class="card-body regitrationcardbody">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row mb-2 mt-3{{ $errors->has('username') ? ' has-error' : '' }}">
                            {{-- <label for="username" class="col-md-4 control-label">User Name</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2 mt-3{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{-- <label for="email" class="col-md-4 control-label">E-Mail Address</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row m2-3 mt-3">
                            {{-- <label for="firstname" class="col-md-4 control-label">First Name</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="firstname" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2 mt-3">
                            {{-- <label for="lastname" class="col-md-4 control-label">Last Name</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2 mt-3">
                            {{-- <label for="role" class="col-md-4 control-label">Role</label> --}}

                            <div class="col-md-8 offset-md-2">
                                {{-- <input id="role" type="text" class="form-control" name="role" value="{{ old('role') }}" required value="manager" disabled> --}}
                                <select id="role" type="role" class="form-control" name="role">
                                    <option>Select Role</option>
                                    <option value="Manager">Manager</option>
                                    <option value="employee">Employee</option>

                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-2 mt-3">
                            {{-- <label for="password" class="col-md-4 control-label">Password</label> --}}

                            <div class="col-md-8 offset-md-2">
                                {{-- <input id="password" type="password" class="form-control rounded-pill rounder-1" name="password" required> --}}
                                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                                <span id="eye" onclick="eye()" class="fa fa-fw  fa-eye field-icon "></span>
                                <span style="display: none" id="eyeslash" onclick="eyeSlash()" class="fa fa-fw  fa-eye-slash field-icon "></span>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-2 mt-3">
                            {{-- <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label> --}}

                            <div class="col-md-8 offset-md-2">
                                {{-- <input id="password-confirm" type="password" class="rounded-pill rounder-1  form-control" name="password_confirmation" required> --}}
                                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required placeholder="Confirm Password">
                                <span id="eye" onclick="eye()" class="fa fa-fw  fa-eye field-icon "></span>
                                <span style="display: none" id="eyeslash" onclick="eyeSlash()" class="fa fa-fw  fa-eye-slash field-icon "></span>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" onclick="loader()" class="btn1 rounded-pill rounder-1">
                                    {{ __('Register') }}
                                </button>

                                <div style="margin-left:50%; margin-top:1rem" class="or">
                                    OR
                                </div>
                                <br>
                                <button class="btn3 rounded-pill rounder-1">
                                    <img src="{{ url('images/github.png') }}" width="22rem" class="mr-3"><a href="{{route('social-login.redirect', 'github')}}"> Register with Github</a>
                                </button>


                                <br><br>
                                <button class="btn2 rounded-pill rounder-1">
                                    <img src="{{ url('images/google.png') }}" width="22rem" class="mr-3"><a href="{{route('social-login.redirect', 'google')}}"> Register with Google</a>
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="dash">

        </div>
    </div>

    </div>
</div>

<script>

    function eye() {
      let passe = document.getElementById("myInput");
      let eye = document.getElementById("eye");
      let eyeslash = document.getElementById("eyeslash");
       passe.type = "text";
       eyeslash.style.display = "block";
       eye.style.display = "none";
      }
    function eyeSlash() {
      let passe = document.getElementById("myInput");
      let eye = document.getElementById("eye");
      let eyeslash = document.getElementById("eyeslash");
       passe.type = "password";
       eyeslash.style.display = "none";
       eye.style.display = "block";
  }

  function loader() {
      let load = document.getElementById("load");
      load.style.display = "block";
  }
      </script>

</div>
@endsection

