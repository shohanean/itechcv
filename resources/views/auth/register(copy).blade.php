@extends('layouts.app')

@section('content')
    <div class="card-box pr-5 pl-5 pb-5">
        <h2 class="text-uppercase text-center mt-0 pb-2">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="assets/images/logo.png" alt="" height="110"></span>
            </a>
        </h2>

        <form class="form-horizontal" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="username">Full Name</label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" id="username"
                           placeholder="Enter Name">
                    @error('name')
                    <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="emailaddress">Email address</label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                           id="emailaddress" placeholder="Enter Email">
                    @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label for="password">Password</label>
                    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password" id="password"
                           placeholder="Enter Your Password">
                </div>
                <div class="col-6">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" type="password" id="password_confirmation"
                           placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                    <span class="invalid-feedback text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label>Phone</label>
                    <div class="form-group">
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text" id="phone"
                               placeholder="Enter Phone">

                        @error('phone')
                        <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label>Gender</label>
                    <div class="form-group">
                        <input type="radio" id="male" name="gender" class="@error('gender') is-invalid @enderror"
                               value="1"><label for="male">&nbsp;Male</label>
                        <br>
                        <input type="radio" id="female" name="gender" class="@error('gender') is-invalid @enderror"
                               value="2"><label for="female">&nbsp;Female</label>
                        {{-- <input type="radio" id="others" name="gender" class="@error('gender') is-invalid @enderror"
                            value="3"><label for="others">&nbsp;Others</label> --}}
                        <br>
                        @error('gender')
                        <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    </div>
                    @enderror
                </div>
            </div>
    </div>
    <div class="form-group row m-b-20">
        <div class="col-6">
            <label>Are you student of CIT?</label>
            <div class="form-group">
                <input type="radio" id="yes" name="is_student" class="@error('is_student') is-invalid @enderror"
                       value="1"><label for="yes">&nbsp;Yes</label>
                <br>
                <input type="radio" id="no" name="is_student" class="@error('is_student') is-invalid @enderror"
                       value="2"><label for="no">&nbsp;No</label>
                <br>
                @error('is_student')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <label>What are you looking for?</label>
            <div class="form-group">
                <input type="radio" id="Job" name="looking" class="@error('looking') is-invalid @enderror"
                       value="user"><label for="Job"> I'm Seeker</label>
                <br>
                <input type="radio" id="Employee" name="looking" class="@error('looking') is-invalid @enderror"
                       value="employer"><label for="Employee">&nbsp;I'm Employer</label>
                <br>
                @error('looking')
                <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="form-group row text-center m-t-10">
        <div class="col-12">
            <button class="btn btn-block btn-custom waves-effect waves-light" type="submit">Sign Up</button>
        </div>
    </div>

    </form>

    <div class="row m-t-20">
        <div class="col-sm-12 text-center">
            <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign
                        In</b></a></p>
        </div>
    </div>

    </div>

@endsection
