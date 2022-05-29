@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            @if(Auth::user()->user_role == 1)
              {{-- Role 1 meaning: this user is a job seeker, s/he looking for jobs and want to see & update hir/s information --}}
              @include('inc.job_seeker_dashboard')
            @elseif(Auth::user()->user_role == 2)
                @include('inc.employer_dashboard')
            @endif
            @component('inc.footer') @endcomponent

        </div> <!-- container -->

    </div>
@endsection

@section('footer_js')
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>
@endsection
