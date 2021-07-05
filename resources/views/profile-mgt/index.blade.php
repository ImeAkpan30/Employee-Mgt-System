@extends('profile-mgt.base')
@section('title', 'EM | System Management')
@section('action-content')

<br><br>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-8 col-lg-offset-2 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center text-bold text-danger text">USER PROFILE</div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                {{ Auth::user()->firstname}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                {{ Auth::user()->lastname}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                {{ Auth::user()->username}}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                {{ Auth::user()->email}}
                            </div>
                        </div>
                    </form>
            </div>
            <div class="text-center">
              {{-- <button type="button" class="btn btn-primary">Back</button> --}}
              <a class="btn btn-primary" href="{{ url('/') }}"> Back</a>
            </div>
            <br>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
