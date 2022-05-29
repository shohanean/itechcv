@extends('backend.master')

@section('header_css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{ route('cvRequest') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h1 class="text-center">Request for CV</h1>
                            <hr>
                            @if(session('message'))
                                <div class="alert alert-success">
                                    <p>{{ session('message') }}</p>
                                </div>
                            @endif
                            <div class="row pb-4">
                                <div class="col-md-3 pb-2">
                                    <p class="mb-1 font-weight-bold text-muted">Skills</p>
                                    <select multiple name="skill_id[]" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">

                                        @foreach ($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 pb-2">
                                    <p class="mb-1 font-weight-bold text-muted">Category</p>
                                    <select name="category_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-md-3 pb-2">
                                    <p class="mb-1 font-weight-bold text-muted">Job Location</p>
                                    <select name="location_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        @foreach($district as $dist)
                                            <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 pb-2">
                                    <p class="mb-1 font-weight-bold text-muted">Education</p>
                                    <select name="education_id" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                        @foreach($degreetitle as $edu)
                                            <option value="{{ $edu->id }}">{{ $edu->degree_title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row pb-4">
                                <div class="col-md-3 col-6">
                                    <p class="mb-1 font-weight-bold text-muted">Job Experience</p>
                                    <div class="form-group" style="display: inline-flex">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="job_experience" value="1" name="job_experience" class="custom-control-input">
                                            <label class="custom-control-label" for="job_experience">Yes &nbsp;</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="job_experience1" value="2" name="job_experience" class="custom-control-input">
                                            <label class="custom-control-label" for="job_experience1">  No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <p class="mb-1 font-weight-bold text-muted">Portfolio</p>
                                    <div class="form-group" style="display: inline-flex">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="portfolio" value="1" name="portfolio" class="custom-control-input">
                                            <label class="custom-control-label" for="portfolio">Yes &nbsp;</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="portfolio1" value="2" name="portfolio" class="custom-control-input">
                                            <label class="custom-control-label" for="portfolio1">  No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <p class="mb-1 font-weight-bold text-muted">Training</p>
                                    <div class="form-group" style="display: inline-flex">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="training" value="1" name="training" class="custom-control-input">
                                            <label class="custom-control-label" for="training">Yes &nbsp;</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="training1" value="2" name="training" class="custom-control-input">
                                            <label class="custom-control-label" for="training1">  No</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-6">
                                    <p class="mb-1 font-weight-bold text-muted">Approx. Salary</p>
                                    <div class="form-group">
                                        <input type="text" name="expected_salary" placeholder="Ex: 10000" class="form-control @error('expected_salary') is-invalid @enderror">
                                        @error('expected_salary')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row pd-4">
                                <div class="col-lg-2 col-4">
                                    <p class="mt-2 font-weight-bold text-muted text-center">Expected CV</p>
                                </div>
                                <div class="col-lg-2 col-8">
                                    <div class="form-group">
                                        <input type="text" name="expected_cv" placeholder="Ex: 10" class="form-control @error('expected_cv') is-invalid @enderror">
                                        @error('expected_cv')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-1 col-4">
                                    <p class="mt-2 font-weight-bold text-muted text-center">Vacancy</p>
                                </div>
                                <div class="col-lg-2 col-8">
                                    <div class="form-group">
                                        <input type="text" name="vacancy" placeholder="Ex: 3" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-1 col-4">
                                    <p class="mt-2 font-weight-bold text-muted text-center">Note</p>
                                </div>
                                <div class="col-lg-4 col-8">
                                    <div class="form-group">
                                        <input type="text" name="note" placeholder="Ex: Its Urgent." class="form-control">
                                    </div>
                                </div>

                            </div>
                            <div class="row pd-4 mt-2">
                                <div class="col-lg-12 col-12 text-center">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Send Request</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            @component('inc.footer') @endcomponent

        </div> <!-- container -->

    </div>
@endsection

@section('footer_js')
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>
@endsection
