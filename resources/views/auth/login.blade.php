@extends('layouts.app')

@section('content')
<div class="card-box p-5">
    <h2 class="text-uppercase text-center pb-4">
        <a href="{{ url('/') }}" class="text-success">
            <span><img src="{{ asset('assets/images/logo.png') }}" alt="iTechCV" width="150"></span>
        </a>
    </h2>

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group m-b-20 row">
            <div class="col-12">
                <label for="emailaddress">Email Address</label>
                <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                    id="emailaddress" placeholder="Enter your email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row m-b-20">
            <div class="col-12">
                <label for="password">Password</label>
                <input class="form-control @error('password') is-invalid @enderror" name="password" type="password"
                    required="" id="password" placeholder="Enter your password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
            </div>
        </div>

        <div class="form-group row m-b-20">
            <div class="col-12">

                <div class="checkbox checkbox-custom">
                    <input name="remember" id="remember" type="checkbox" checked="">
                    <label for="remember">
                        Remember me
                    </label>
                </div>

            </div>
        </div>

        <div class="form-group row text-center m-t-10">
            <div class="col-12">
                <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign In</button>
            </div>
        </div>

    </form>

    <div class="row m-t-50">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Dont have an account? <a href="{{ route('register') }}" class="text-dark m-l-5"><b>Sign
                        Up</b></a></p>
        </div>
    </div>
    <div class="row mt-5 w-100 text-center" style="position:absolute;bottom:-20%;">
        <div class="col-sm-12">
            <p>Copyright © {{ date('Y')}}<a href="{{ url('/') }}"> iTechCV</a> All Rights Reserved</p>
        </div>
    </div>
</div>
@endsection
