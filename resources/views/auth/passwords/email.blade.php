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
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
      @csrf
        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="emailaddress">Email address</label>
                <input class="form-control" name="email" value="{{ old('email')}}" type="email" id="emailaddress" required=""
                    placeholder="john@deo.com">
            </div>
        </div>
        <div class="form-group row text-center m-t-10">
            <div class="col-12">
                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Reset Password</button>
            </div>
        </div>
    </form>
    <div class="row m-t-50">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Back to <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
        </div>
    </div>
</div>
@endsection
