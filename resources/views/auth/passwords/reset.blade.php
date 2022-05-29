@extends('layouts.app')

@section('content')
<div class="card-box p-5">
  <h2 class="text-uppercase text-center pb-4">
    <a href="{{ url('/') }}" class="text-success">
      <span><img src="{{ url('/') }}/assets/images/logo.png" alt="" height="110"></span>
    </a>
  </h2>

  <div class="text-center m-b-20">
    <p class="text-muted m-b-0">Enter your email address and we will send you an email with instructions to reset
      your password. </p>
    </div>
    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group row m-b-20">
          <div class="col-12">
            <label for="emailaddress">Email address</label>
            <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" type="email" id="emailaddress" required=""
            placeholder="john@deo.com">
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

        <div class="form-group row m-b-20">
          <div class="col-12">
            <label for="password">{{ __('Password') }}</label>
            <input class="form-control @error('email') is-invalid @enderror" name="password" type="password" id="password" required="">
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
        </div>

      <div class="form-group row m-b-20">
        <div class="col-12">
          <label for="password-confirm">{{ __('Confirm Password') }}</label>
          <input class="form-control" name="password_confirmation"  type="password" id="password-confirm" required="">

        </div>
      </div>

      <div class="form-group row text-center m-t-10">
          <div class="col-12">
              <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Reset Password</button>
          </div>
      </div>
    </form>
  </div>
  @endsection
