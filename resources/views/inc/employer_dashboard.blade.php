<form action="{{ route('SearchSeeker') }}" method="get">
    <div class="row">
        <div class="col-lg-12">
            <div class="card-box">
                <h1 class="text-center">Request for CV</h1>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Skills</p>
                            <select name="skill" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select</option>
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Category</p>
                            <select name="category" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                @endforeach

                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Location</p>
                            <select name="skill" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option>Select</option>
                                @foreach($upazilas as $upazila)
                                    <option value="{{ $upazila->id }}">{{ $upazila->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Education</p>
                            <select name="education" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option value="">Select</option>
{{--                                @foreach($degreetitle as $edu)--}}
{{--                                    <option value="{{ $edu->id }}">{{ $edu->degree_title }}</option>--}}
{{--                                @endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <div class="card-box">
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
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
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
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Training</p>
                            <div class="form-group" style="display: inline-flex">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" value="1" name="training" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Yes &nbsp;</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" value="2" name="training" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">  No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <p class="mb-1 font-weight-bold text-muted">Expected Salary</p>
                            <div class="form-group">
                                <input type="text" name="expected_salary" placeholder="Ex: 10000" class="form-control">
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-7">
                        <div class="form-group">
                            <input type="text" placeholder="Search Keyword" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success form-control" >Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
