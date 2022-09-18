@extends('layouts.app')

@section('content')
<div class="card-box p-5">
    <h2 class="text-uppercase text-center pb-4">
        <a href="{{ url('/') }}" class="text-success">
            <span><img src="{{ asset('assets/images/logo.png') }}" alt="iTechCV" width="120"></span>
        </a>
    </h2>
    <h2 class="text-center mb-3">Verify Your Email Address</h2>
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <div class="form-group text-center m-t-10">
        {{ __('Before proceeding, please check your email for a verification link.') }}
        <div class="col-12">
            {{ __('If you did not receive the email') }},
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <button class="btn btn-block btn-custom waves-effect waves-light mt-2"> Click here to request another </button>
            </form>
        </div>
    </div>

</div>
@endsection
