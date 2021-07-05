@extends('layouts.app')

@section('content')
<div>
    <div class="grid">
        <div>
            <div class="form1 logi">
                <div class="text-center display" id="load">
                    <div class="lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>

                <div class="text-center text-bold log">{{ __('Login') }}</div>

                <div class="card-body regitrationcardbody">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-5 mt-3">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}


                            <div class="col-md-8 offset-md-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            <div class="col-md-8 offset-md-2">
                                {{-- <input id="password" type="password" class="rounded-pill rounder-1  form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required autocomplete="current-password"> --}}
                                <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                                <span id="eye" onclick="eye()" class="fa fa-fw  fa-eye field-icon "></span>
                                <span style="display: none" id="eyeslash" onclick="eyeSlash()" class="fa fa-fw  fa-eye-slash field-icon "></span>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" onclick="loader()" class="btn1 rounded-pill rounder-1">
                                    {{ __('Login') }}
                                </button>

                                <div style="margin-left:50%; margin-top:1rem" class="or">
                                    OR
                                </div>
                                <br>
                                <button class="btn3 rounded-pill rounder-1">
                                    <img src="{{ url('images/github.png') }}" width="22rem" class="mr-3"><a href="{{route('social-login.redirect', 'github')}}"> Login with Github</a>
                                </button>


                                <br><br>
                                <button class="btn2 rounded-pill rounder-1">
                                    <img src="{{ url('images/google.png') }}" width="22rem" class="mr-3"><a href="{{route('social-login.redirect', 'google')}}"> Login with Google</a>
                                </button>


                                <br>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
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
@endsection
