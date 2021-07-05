@extends('layouts.app')

@section('content')

<div>
    <div class="grid">
        <div>
            <div class="form1 logi">
                <div class="text-center display" id="load">
                    <div class="lds-roller "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                </div>

                <div class="text-center text-bold log">{{ __('Reset Password') }}</div>

                <div class="card-body regitrationcardbody">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            <div class="col-md-8 offset-md-2">
                                <input id="email" type="email" class="rounded-pill rounder-1 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  placeholder="E-Mail Address"  required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn1 rounded-pill rounder-1">
                                    {{ __('Send Password Reset Link') }}
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

    <script>



function loader() {
    let load = document.getElementById("load");
    load.style.display = "block";
}
    </script>
@endsection
