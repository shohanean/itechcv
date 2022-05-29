@extends('backend.master')
@section('header_css')
    <link href="{{ url('/') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
{{--    <link href="{{ url('/') }}/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>--}}
{{--    <link href="//code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>--}}
    <link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet" type="text/css"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.default.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/ion-rangeslider/ion.rangeSlider.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/plugins/ion-rangeslider/ion.rangeSlider.skinModern.css') }}" rel="stylesheet" type="text/css"/>
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            color: black!important;
        }
        .select2-results__message{
            color: red!important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title m-t-0 m-b-30">
                          CV Update
                        </h4>
                        @if (session('category_add_success'))
                          <div class="alert alert-success">
                            {{ session('category_add_success') }}
                          </div>
                        @endif

                        <ul class="nav nav-pills navtab-bg nav-justified pull-in ">
                            <li class="nav-item">
                                <a href="#profile" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                    <i class="fas fa-user mr-2"></i> Personal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#eduinfo" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fas fa-graduation-cap mr-2"></i>Education
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#trainingInfos" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fas fa-hiking mr-2"></i> Training
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#careerInfos" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fi-cog mr-2"></i> Career
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#skillinfo" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fas fa-wrench mr-2"></i> Skills
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#experienceInfo" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fa fa-address-book mr-2"></i> Experience
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#portfolios" data-toggle="tab" aria-expanded="true" class="nav-link">
                                    <i class="fa fa-image mr-2"></i> Portfolios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#marketplace" data-toggle="tab" aria-expanded="true" class="nav-link ">
                                    <i class="fa fa-magnet mr-2"></i> Market
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="profile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Personal Information</h4>
                                            @if (session('personsuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('personsuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('PersonalInfoUpdate') }}" method="post">
                                                @csrf
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="name" class="col-form-label">Name <span class="text-danger">*</span></label>
                                                        <input type="text" value="{{ $auth->name ?? "N/A"}}" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                                                               placeholder="Enter Name">
                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                                                        <input type="email" value="{{ $auth->email ?? "N/A"}}" name="email" class="form-control @error('email') is-invalid @enderror" id="inputPassword4"
                                                               placeholder="Enter Email">
                                                        @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="fname" class="col-form-label">Father Name</label>
                                                        <input type="text" value="{{ $personal_info->father_name ?? '' }}" name="father_name" class="form-control @error('father_name') is-invalid @enderror" id="fname"
                                                               placeholder="Enter Father Name">
                                                        @error('father_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="mname" class="col-form-label">Mother Name</label>
                                                        <input type="text" value="{{ $personal_info->mother_name ?? '' }}" name="mother_name" class="form-control @error('mother_name') is-invalid @enderror" id="mname"
                                                               placeholder="Enter Mother Name">
                                                        @error('mother_name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row" style="border: 1px solid #02c0ce">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity" class="col-form-label">Present Address <span class="text-danger">*</span></label>
                                                        <input type="text" value="{{ $personal_info->present_address ?? '' }}" name="present_address" class="form-control @error('present_address') is-invalid @enderror" id="inputCity">
                                                        @error('present_address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="district_id" class="col-form-label">District <span class="text-danger">*</span></label>
                                                        <select id="district_id"  name="district_id" class="form-control @error('district_id') is-invalid @enderror">
                                                            <option value="">Select One</option>
                                                            @foreach ($districts as $district)
                                                                <option @if($personal_info->district_id == $district->id) selected @endif value="{{ $district->id }}">{{ $district->name ?? "" }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('district_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="upazila_id" class="col-form-label">Upazila <span class="text-danger">*</span></label>
                                                        <select id="upazila_id" class="form-control @error('upazila_id') is-invalid @enderror" name="upazila_id">
                                                            <option @isset($personal_info->upazila_id) selected @endisset value="{{ $personal_info->upazila_id ??"" }}">{{ $personal_info->upazila->name ?? ""}}</option>
                                                        </select>
                                                        @error('upazila_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-row" style="border: 1px solid #02c0ce">
                                                    <div class="form-group col-md-6">
                                                        <label for="inputCity" class="col-form-label">Permanent Address <span class="text-danger">*</span></label>
                                                        <input type="text" value="{{ $personal_info->permanent_address ?? '' }}" name="permanent_address" class="form-control @error('permanent_address') is-invalid @enderror" id="inputCity">
                                                        @error('permanent_address')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="pdistrict_id" class="col-form-label">District <span class="text-danger">*</span></label>
                                                        <select id="pdistrict_id" name="pdistrict_id" class="form-control @error('pdistrict_id') is-invalid @enderror">
                                                            <option value="">Select One</option>
                                                            @foreach ($districts as $district)
                                                                <option @if($personal_info->pdistrict_id == $district->id) selected @endif value="{{ $district->id }}">{{ $district->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('pdistrict_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="pupazila_id" class="col-form-label">Upazila <span class="text-danger">*</span></label>
                                                        <select id="pupazila_id" name="pupazila_id" class="form-control @error('pupazila_id') is-invalid @enderror">
                                                            <option @isset($personal_info->pupazila_id) selected @endisset value="{{ $personal_info->pupazila_id ??"" }}">{{ $personal_info->pupazila->name ?? ""}}</option>
                                                        </select>
                                                        @error('pupazila_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="phone" class="col-form-label">Phone</label>
                                                        <input type="text" value="{{ $personal_info->phone ?? '' }}" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                                               placeholder="Ex: 0123456789">
                                                        @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="nid" class="col-form-label">NID/Birth Certificate No</label>
                                                        <input type="text" value="{{ $personal_info->nid ?? '' }}" name="nid" class="form-control @error('nid') is-invalid @enderror" id="nid"
                                                               placeholder="Ex: 1254789254789">
                                                        @error('nid')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Gender</label><br>
                                                        <input id="male" type="radio" name="gender" @if($personal_info->gender == 1) checked @endif value="1">
                                                        <label for="male">Male</label>
                                                        <input id="female" type="radio" name="gender" @if($personal_info->gender == 2) checked @endif value="2">
                                                        <label for="female">Female</label>
                                                        <input id="others" type="radio" name="gender" @if($personal_info->gender == 3) checked @endif value="3">
                                                        <label for="others">Others</label>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="col-form-label">Marital Status</label><br>
                                                        <input type="radio" id="single" name="marital_status" @if($personal_info->marital_status == 1) checked @endif value="1" >
                                                        <label for="single">Single</label>
                                                        <input type="radio" id="married" name="marital_status" @if($personal_info->marital_status == 2) checked @endif value="2">
                                                        <label for="married">Married</label>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="dob" class="col-form-label">Date of Birth</label><br>
                                                        <input type="text" class="form-control col-md-6" value="{{ $personal_info->dob ?? old('dob') }}" name="dob" id="dob" >
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="interested_location" class="col-form-label">Preferred Job Location(Max 3)</label><br>
                                                        <select id="interested_location" name="interested_location[]" multiple class="form-control">
                                                            <option value="">Select One</option>
                                                            @foreach ($districts as $district)
                                                                <option
                                                                    @isset($personal_info->interested_location)
                                                                @foreach(json_decode($personal_info->interested_location) as $val)
                                                                    @if(json_decode($val) == $district->id) selected @endif
                                                                @endforeach
                                                                    @endisset
                                                                value="{{ $district->id }}">{{ $district->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="designation" class="col-form-label">Designation</label><br>
                                                        <input id="designation" value="{{ $personal_info->designation ?? '' }}" name="designation" type="text" class="form-control" placeholder="Ex: Software Engineer">
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="expected_salary" class="col-form-label">Expected Salary</label><br>
                                                        <input id="expected_salary" value="{{ $personal_info->expected_salary ?? '' }}" name="expected_salary" type="text" class="form-control @error('expected_salary') is-invalid @enderror" placeholder="Ex: 10000">
                                                        @error('expected_salary')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <ul class="pager wizard wizardlist">
                                                    <li class="next text-center">
                                                        <button type="submit" class="btn btn-success">Update Information</button>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="eduinfo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Educational Information</h4>
                                            @if (session('edusuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('edusuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('AddEducation') }}" method="post">
                                                @csrf
                                                <div class="cloneDiv">
                                                    <div class="addField">
                                                        <div class="row">
                                                            <div class="form-group col-md-3">
                                                                <label for="degree">Degree</label>
                                                                <select name="degree_name[]" id="degree_id" class="form-control @error('degree_name') is-invalid @enderror degreeList" style=" width: 100%">
                                                                    @foreach ($degrees as $degree)
                                                                        <option value="{{ $degree->id }}">{{ $degree->degree_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('degree_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group  col-md-3">
                                                                <label for="degree_title">Title</label>
                                                                <select name="degree_title[]" id="degree_title" class="form-control @error('degree_title') is-invalid @enderror degreeTitle" style=" width: 100%">

                                                                </select>
                                                                @error('degree_title')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                <label for="results">Results</label>
                                                                <input type="text" class="form-control @error('results') is-invalid @enderror" name="results[]" id="results" placeholder="Ex:- 3.5" >
                                                                @error('results')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group  col-md-3">
                                                                <label for="passing_year">Passing Year</label>
                                                                <input type="text" class="form-control @error('passing_year') is-invalid @enderror col-md-6" name="passing_year[]" id="passing_year" placeholder="Passing Year" >
                                                                @error('passing_year')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group  col-md-3">
                                                                <label for="major_study)">Field of study (Major)</label>
                                                                <input type="text" class="form-control @error('major_study') is-invalid @enderror col-md-6" name="major_study[]" id="major_study" placeholder="Ex:-English, Studies" >
                                                                @error('major_study')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group  col-md-3">
                                                                <label for="edu_duration">Duration</label>
                                                                <input type="text" class="form-control @error('edu_duration') is-invalid @enderror col-md-6" name="edu_duration[]" id="edu_duration" placeholder="Ex:- 2 Years" >
                                                                @error('edu_duration')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group  col-md-3">
                                                                <label for="edu_institute">Institute</label>
                                                                <input type="text" class="form-control @error('edu_institute') is-invalid @enderror col-md-6" name="edu_institute[]" id="edu_institute" placeholder="Institute">
                                                                @error('edu_institute')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group  col-md-3">
                                                                <label for="board_id">Board</label>
                                                                <select name="board_name[]" id="board_id" class="form-control @error('board_name') is-invalid @enderror col-md-6 boardList" style=" width: 100%">
                                                                    @foreach ($boards as $board)
                                                                        <option value="{{ $board->id }}">{{ $board->board_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('board_name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="addMore" class="add_field_button btn btn-primary">Add More</span>
                                                <ul class="pager wizard wizardlist">
                                                    <li class="next text-center">
                                                        <button type="submit" class="btn btn-success">Save Education</button>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            @if (session('EduDelete'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ session('EduDelete') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                                @if (session('EduUpdate'))
                                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        {{ session('EduUpdate') }}.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Education of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Degree</th>
                                                    <th>Title</th>
                                                    <th>Board</th>
                                                    <th>Year</th>
                                                    <th>Results</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($educations as $education)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 ?? "N/A"}}</th>
                                                        <td>{{ $education->degree->degree_name}}</td>
                                                        <td>{{ $education->degreeTitle->degree_title ?? "N/A"}}</td>
                                                        <td>{{ $education->board->board_name ?? "N/A"}}</td>
                                                        <td>{{ $education->passing_year ?? "N/A"}}</td>
                                                        <td>{{ $education->result_point ?? "N/A" }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal{{ $education->id }}">Edit</button>
                                                            <a class="btn btn-danger" href="{{ route('EducationDelete', $education->id) }}" >Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div id="myModal{{ $education->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Education</h4>
                                                                </div>
                                                                <form action="{{ route('EducationUpdate') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="edu_id" value="{{ $education->id }}">
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="form-group  col-md-6">
                                                                            <label for="degreet{{ $education->id }}">Title</label>
                                                                            <select name="degree_title" id="degreet{{ $education->id }}" class="form-control @error('degree_title') is-invalid @enderror degreeTitle" style=" width: 100%">
                                                                                @foreach ($degree_title as $dt)
                                                                                    <option @if($education->degree_title_id == $dt->id) selected @endif value="{{ $dt->id }}">{{ $dt->degree_title }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('degree_title')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="result{{ $education->id }}">Results</label>
                                                                            <input type="text" value="{{ $education->result_point ?? "N/A" }}" class="form-control @error('results') is-invalid @enderror" name="results" id="result{{ $education->id }}" placeholder="Ex:- 3.5" >
                                                                            @error('results')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group  col-md-3">
                                                                            <label for="passing{{ $education->id }}">Passing Year</label>
                                                                            <input type="text" value="{{ $education->passing_year ?? "N/A"}}" class="form-control @error('passing_year') is-invalid @enderror col-md-6" name="passing_year" id="passing{{ $education->id }}" placeholder="Passing Year" >
                                                                            @error('passing_year')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group  col-md-3">
                                                                            <label for="major{{ $education->id }}">Field of study (Major)</label>
                                                                            <input type="text" value="{{ $education->major_field }}" class="form-control @error('major_study') is-invalid @enderror col-md-6" name="major_study" id="major{{ $education->id }}" placeholder="Ex:-English, Studies" >
                                                                            @error('major_study')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group  col-md-3">
                                                                            <label for="duration{{ $education->id }}">Duration</label>
                                                                            <input type="text" value="{{ $education->duration }}" class="form-control @error('edu_duration') is-invalid @enderror col-md-6" name="edu_duration" id="duration{{ $education->id }}" placeholder="Ex:- 2 Years" >
                                                                            @error('edu_duration')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group  col-md-3">
                                                                            <label for="institute{{ $education->id }}">Institute</label>
                                                                            <input type="text" value="{{ $education->institute }}" class="form-control @error('edu_institute') is-invalid @enderror col-md-6" name="edu_institute" id="institute{{ $education->id }}" placeholder="Institute">
                                                                            @error('edu_institute')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group  col-md-3">
                                                                            <label for="board{{ $education->id }}">Board</label>
                                                                            <select name="board_name" id="board{{ $education->id }}" class="form-control @error('board_name') is-invalid @enderror col-md-6 boardList" style=" width: 100%">
                                                                                @foreach ($boards as $board)
                                                                                    <option @if($education->board_id == $board->id) selected @endif value="{{ $board->id }}">{{ $board->board_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @error('board_name')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="trainingInfos">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Training Information <span class="text-danger">*</span></h4>
                                            @if (session('trainsuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('trainsuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('AddTraining') }}" method="post" >
                                                @csrf
                                                <div class="cloneDivTraining">
                                                    <div class="row addFieldTraining">
                                                        <div class="form-group col-md-6">
                                                            <label for="training_name">Title <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control  @error('training_name') is-invalid @enderror" name="training_name[]" id="training_name" placeholder="Ex: Web Developer">
                                                            @error('training_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="trainingCountry">Country <span class="text-danger">*</span></label>
                                                            <select class="country form-control  @error('trainingCountry') is-invalid @enderror" id="trainingCountry" name="trainingCountry[]" tabindex="-1" style="width: 100%">
                                                                <option>Select One</option>
                                                                @foreach ($countries as $country)
                                                                    <option  value="{{ $country->id }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('trainingCountry')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="topic_cover">Topic Cover <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control col-md-6  @error('topic_cover') is-invalid @enderror" name="topic_cover[]" id="topic_cover" placeholder="Ex:- HTML, CSS, PHP" >
                                                            @error('topic_cover')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="training_year">Training Year <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control col-md-6  @error('training_year') is-invalid @enderror" name="training_year[]" id="training_year" placeholder="Training Year" >
                                                            @error('training_year')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="trainingInstitute">Institute <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control col-md-6  @error('trainingInstitute') is-invalid @enderror" name="trainingInstitute[]" id="institute" placeholder="Ex: Creative IT Institute" >
                                                            @error('trainingInstitute')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="trainingduration">Duration <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control col-md-6  @error('trainingduration') is-invalid @enderror" name="trainingduration[]" id="duration" placeholder="Ex: 6 Months" >
                                                            @error('trainingduration')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group  col-md-6">
                                                            <label for="traininglocation">Location <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control col-md-6  @error('traininglocation') is-invalid @enderror" name="traininglocation[]" id="location" placeholder="Ex: Dhanmondi, Dhaka">
                                                            @error('traininglocation')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="addMoreTraining" class="add_field_button btn btn-primary">Add More</span>
                                                <ul class="pager wizard wizardlist">
                                                    <li class="next text-center">
                                                        <button class="btn btn-success">Save Training</button>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            @if (session('TrainingUpdate'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    {{ session('EduUpdate') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if (session('TrainingDelete'))
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    {{ session('TrainingDelete') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                         <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Training of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Name of Course</th>
                                                    <th>Topic</th>
                                                    <th>Year</th>
                                                    <th>Duration</th>
                                                    <th>Institute</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($trainings as $training)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td>{{ $training->training_name }}</td>
                                                        <td>{{ $training->topic_cover }}</td>
                                                        <td>{{ $training->training_year }}</td>
                                                        <td>{{ $training->training_duration }}</td>
                                                        <td>{{ $training->training_institute }}</td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myTraining{{ $training->id }}">Edit</button>
                                                            <a class="btn btn-danger" href="{{ route('TrainingDelete', $training->id) }}" >Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div id="myTraining{{ $training->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Training</h4>
                                                                </div>
                                                                <form action="{{ route('TrainingUpdate') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="training_id" value="{{ $training->id }}">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="training_name">Title</label>
                                                                                <input type="text" class="form-control" value="{{ $training->training_name }}" name="training_name" id="training_name" placeholder="Ex: Web Developer">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="trainingCountry">Country</label>
                                                                                <select class="country form-control" id="trainingCountry" name="trainingCountry" tabindex="-1" style="width: 100%">
                                                                                    <option>Select One</option>
                                                                                    @foreach ($countries as $country)
                                                                                        <option @if($training->country_id == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group  col-md-6">
                                                                                <label for="topic_cover">Topic Cover</label>
                                                                                <input type="text" class="form-control col-md-6" value="{{ $training->topic_cover }}"name="topic_cover" id="topic_cover" placeholder="Ex:- HTML, CSS, PHP" >
                                                                            </div>
                                                                            <div class="form-group  col-md-6">
                                                                                <label for="training_year">Training Year</label>
                                                                                <input type="text" class="form-control col-md-6" value="{{ $training->training_year }}" name="training_year" id="training_year" placeholder="Training Year" >
                                                                            </div>
                                                                            <div class="form-group  col-md-6">
                                                                                <label for="trainingInstitute">Institute</label>
                                                                                <input type="text" class="form-control col-md-6" value="{{ $training->training_institute }}" name="trainingInstitute" id="institute" placeholder="Ex: Creative IT Institute" >
                                                                            </div>
                                                                            <div class="form-group  col-md-6">
                                                                                <label for="trainingduration">Duration</label>
                                                                                <input type="text" class="form-control col-md-6" value="{{ $training->training_duration }}" name="trainingduration" id="duration" placeholder="Ex: 6 Months" >
                                                                            </div>
                                                                            <div class="form-group  col-md-6">
                                                                                <label for="traininglocation">Location</label>
                                                                                <input type="text" class="form-control col-md-6" value="{{ $training->training_location }}" name="traininglocation" id="location" placeholder="Ex: Dhanmondi, Dhaka">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->

                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="careerInfos">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            @if($totalObj > 0)
                                                <form action="{{ route('JobObjectiveUpdate') }}" method="post">
                                                    @csrf
                                                    <div class="form-group col-md-12">
                                                        <label for="objects">Career Objective</label>
                                                        @if (session('objectsuccess'))
                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <strong>{{ Auth::user()->name }}!</strong> {{ session('objectsuccess') }}.
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <textarea name="objects" id="objects" rows="5" cols="50" class="form-control objects @error('objects') is-invalid @enderror" minlength="200" maxlength="500">{{ $Obj->job_objective }}</textarea>
                                                        @error('objects')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                    <ul class="pager wizard wizardlist fpad">
                                                        <li class="next text-center"><button class="btn btn-success">Update Objective</button></li>
                                                    </ul>
                                                </form>
                                            @else
                                                <form action="{{ route('JobObjectivePost') }}" method="post">
                                                    @csrf
                                                    <div class="form-group col-md-12">
                                                        <label for="objects">CV Objective</label>
                                                        @if (session('success'))
                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <strong>{{ Auth::user()->name }}!</strong> {{ session('success') }}.
                                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <textarea  name="objects" id="objects" class="form-control objects @error('objects') is-invalid @enderror" id="objects" rows="5" cols="50" minlength="200" maxlength="500">{{ old('objects') }}</textarea>
                                                        @error('objects')
                                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                        @enderror
                                                    </div>
                                                    <ul class="pager wizard wizardlist fpad">
                                                        <li class="next text-center">
                                                            <button class="btn btn-success">Save Objective</button>
                                                        </li>
                                                    </ul>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="skillinfo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Skill Information</h4>
                                            @if (session('duplicateSkill'))
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('duplicateSkill') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if (session('skillsuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('skillsuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('JobSkillPost') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="skills">Skill</label>
                                                        <select class="form-control @error('skills') is-invalid @enderror" name="skills" id="skills" style="width: 100%">
                                                            <option value="">Select One</option>
                                                            @foreach($skills as $skill)
                                                                <option value="{{ $skill->id }}">{{ strtoupper($skill->skill_name) }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('skills')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <div class="col-sm-10 col-xs-12">
                                                            <label for="progress">Progress</label>
                                                                <span class="irs-bar" style="left: 0.670055%; width: 0%;"></span>
                                                                <span class="irs-shadow shadow-single" style="display: none;"></span>
                                                            <input type="hidden" id="range_01" name="progress" class="irs-hidden-input">
                                                        </div>
                                                        @error('progress')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                        @enderror
                                                        <span>Minimum 10 and Maximum 100</span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <ul class="pager wizard wizardlist wizardtop fpad2">
                                                            <li class="next text-center"><button class="btn btn-success">Save Skill</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Skill of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Name of Skill</th>
                                                    <th>Progress</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($JobSkill as $js)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td class="text-uppercase">{{ $js->skill->skill_name }}</td>
                                                        <td>
                                                            <div class="progress mb-0">
                                                                <div class="progress-bar" role="progressbar" style="width: {{ $js->progress }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $js->progress }}%</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('JobSkillDelete', $js->id) }}" class="btn btn-outline-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="experienceInfo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Job Experience Information</h4>
                                            @if (session('expersuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('expersuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('JobExperiencePost') }}" method="post">
                                                @csrf
                                                <div class="cloneDivExperience">
                                                    <div class="row addFieldExperience">
                                                        <div class="form-group col-md-6">
                                                            <label for="company_name">Company Name</label>
                                                            <input type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name[]" id="company_name" placeholder="Company Name">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="job_designation">Designation</label>
                                                            <input type="text" class="form-control @error('job_designation') is-invalid @enderror col-md-6" name="job_designation[]" id="job_designation" placeholder="Ex:- Software Engineer" >
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <div class="row">
                                                                <div class="form-group col-md-5">
                                                                    <label for="job_from">From</label>
                                                                    <input type="text" class="form-control @error('job_from') is-invalid @enderror col-md-6 date-picker" name="job_from[]" id="job_from" placeholder="Ex:- 10/15/2016" >
                                                                </div>
                                                                <div class="form-group col-md-2">
                                                                    <label for="job_to">Present</label>
                                                                    <input type="checkbox" class="form-control @error('job_to') is-invalid @enderror col-md-6 present" name="job_to[]" id="job_present" value="present">
                                                                </div>
                                                                <div class="form-group col-md-5">
                                                                    <label for="job_to">To</label>
                                                                    <input type="text" class="form-control @error('job_to') is-invalid @enderror col-md-6 date-picker" name="job_to[]" id="job_to" placeholder="Ex:- 05/30/2017" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="job_summary">Summary</label>
                                                            <textarea type="text" class="form-control @error('job_summary') is-invalid @enderror col-md-6" name="job_summary[]" id="job_summary" placeholder="Job Summary" ></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span id="addMoreExperience" class="add_field_button btn btn-primary text-center">Add More</span>
                                                <ul class="pager wizard wizardlist">
                                                    <li class="next text-center"><button class="btn btn-success">Save Experience</button></li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            @if (session('ExUpdate'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('ExUpdate') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                                @if (session('Exdelete'))
                                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>{{ Auth::user()->name }}!</strong> {{ session('Exdelete') }}.
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                @endif
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Experience of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Name of Company</th>
                                                    <th>Designation</th>
                                                    <th>From</th>
                                                    <th>To</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($experience as $e)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td class="text-capitalize">{{ $e->company_name }}</td>
                                                        <td class="text-capitalize">{{ $e->designation }}</td>
                                                        <td>{{ $e->job_from }}</td>
                                                        <td class="text-capitalize">                                                          
                                                          @if($e->job_to == 'present')
                                                            Continuing
                                                          @else
                                                            {{ $e->job_to }}
                                                          @endif
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myex{{ $e->id }}">Edit</button>
                                                            <a class="btn btn-danger" href="{{ route('ExperienceDelete', $e->id) }}" >Delete</a>
                                                        </td>
                                                    </tr>
                                                    <div id="myex{{ $e->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title" id="myModalLabel">Edit Experience</h4>
                                                                </div>
                                                                <form action="{{ route('JobExperienceUpdate') }}" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="ex_id" value="{{ $e->id }}">
                                                                    <div class="modal-body">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-6">
                                                                                <label for="company_name">Company Name</label>
                                                                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" value="{{ $e->company_name }}" name="company_name" id="company_name" placeholder="Company Name">
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="job_designation">Designation</label>
                                                                                <input type="text" class="form-control @error('job_designation') is-invalid @enderror col-md-6" value="{{ $e->designation }}" name="job_designation" id="job_designation" placeholder="Ex:- Software Engineer" >
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-5">
                                                                                        <label for="job_from">From</label>
                                                                                        <input type="text" class="form-control @error('job_from') is-invalid @enderror col-md-6" value="{{ $e->job_from }}" name="job_from" placeholder="Ex:- 10/15/2016" >
                                                                                    </div>
                                                                                    <div class="form-group col-md-2">
                                                                                        <label for="job_to">Present</label>
                                                                                        <input type="checkbox" class="form-control @error('job_to') is-invalid @enderror col-md-6 present" value="{{ $e->job_to ?? 'present'}}" name="job_to">
                                                                                    </div>
                                                                                    <div class="form-group col-md-5">
                                                                                        <label for="job_to">To</label>
                                                                                        <input type="text" class="form-control @error('job_to') is-invalid @enderror col-md-6" value="{{ $e->job_to }}" name="job_to" placeholder="Ex:- 05/30/2017" >
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group col-md-6">
                                                                                <label for="job_summary">Summary</label>
                                                                                <textarea type="text" class="form-control @error('job_summary') is-invalid @enderror col-md-6" name="job_summary" placeholder="Job Summary" >{{ $e->job_summary }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div><!-- /.modal-content -->
                                                        </div><!-- /.modal-dialog -->
                                                    </div><!-- /.modal -->
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="portfolios">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Portfolios Information</h4>
                                            @if (session('portsuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('portsuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            @if (session('delete'))
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('delete') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('PortfolioPost') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="portfolio_icon">Portfolio Name</label>
                                                        <select class="form-control @error('portfolio_icon') is-invalid @enderror" name="portfolio_icon" id="portfolio_icon" style="width: 100%">
                                                            <option value="">Select One</option>
                                                            <option value="fab fa-github">Github</option>
                                                            <option value="fab fa-behance">Behance</option>
                                                            <option value="fab fa-dribbble">Dribbble</option>
                                                            <option value="fab fa-linkedin">LinkedIn</option>
                                                            <option value="fab fa-twitter">Twitter</option>
                                                            <option value="fas fa-globe">Website</option>
                                                            <option value="fas fa-link">Other</option>
                                                        </select>
                                                        @error('portfolio_icon')
                                                        <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $message }}</strong>
                                                       </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="portfolio_link">Link</label>
                                                        <input type="text" class="form-control @error('portfolio_link') is-invalid @enderror col-md-6" name="portfolio_link" id="portfolio_link" placeholder="Ex:- https://github.com/laravel" >
                                                        @error('portfolio_link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <ul class="pager wizard wizardlist wizardtop">
                                                            <li class="next text-center"><button class="btn btn-success">Save Portfolio</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Portfolio of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Icon Name</th>
                                                    <th>Live URL</th>
                                                    <th>Action</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($portfolio_links as $port_link)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td><i class="{{ $port_link->portfolio_icon }}"></i></td>
                                                        <td><a target="_blank" href="//{{ $port_link->portfolio_link }}">{{ $port_link->portfolio_link }}</a></td>
                                                        <td>
                                                            <a target="_blank" href="//{{ $port_link->portfolio_link }}" class="btn btn-outline-purple">View</a>
                                                            <a href="{{ route('PortfolioDelete', $port_link->id ) }}" class="btn btn-outline-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="marketplace">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title">Marketplace Information</h4>
                                            @if (session('marketsuccess'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('marketsuccess') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <form action="{{ route('MarketplacePost') }}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="marketplace_icon">Marketplace Name</label>
                                                        <select class="form-control @error('marketplace_icon') is-invalid @enderror" name="marketplace_icon" id="marketplace_icon" style="width: 100%">
                                                            <option value="">Select One</option>
                                                            <option value="upwork.png">Upwork</option>
                                                            <option value="fiverr.png">Fiverr</option>
                                                            <option value="freelancer.png">Freelancer</option>
                                                            <option value="pph.png">PeoplePerHour</option>
                                                            <option value="codecanyon.png">Codecanyon</option>
                                                            <option value="themeforest.png">Themeforest</option>
                                                            <option value="graphicriver.png">Graphicriver</option>
                                                            <option value="freepik.png">Freepik</option>
                                                        </select>
                                                        @error('marketplace_icon')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="marketplace_link">Link</label>
                                                        <input type="text" class="form-control @error('marketplace_link') is-invalid @enderror col-md-6" name="marketplace_link" id="marketplace_link" placeholder="Ex:- https://upwork.com/test" >
                                                        @error('marketplace_link')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <ul class="pager wizard wizardlist wizardtop">
                                                            <li class="next text-center"><button class="btn btn-success">Save Marketplace</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-box">
                                            @if (session('MarketDelete'))
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <strong>{{ Auth::user()->name }}!</strong> {{ session('MarketDelete') }}.
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            @endif
                                            <div class="alert alert-dark bg-dark text-white border-0 text-center" role="alert">
                                                <strong>Marketplace of {{ $auth->name ?? "You" }}</strong>
                                            </div>
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                <tr class="text-center">
                                                    <th>SL</th>
                                                    <th>Market Name</th>
                                                    <th>Profile URL</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse($marketplaces as $marketplace)
                                                    <tr class="text-center">
                                                        <th>{{ $loop->index + 1 }}</th>
                                                        <td><img width="@if($marketplace->marketplace_icon == 'upwork.png') 50 @else 70 @endif" src="{{ asset('/images/marketplace'.'/'.$marketplace->marketplace_icon) }}" alt=""></td>
                                                        <td><a target="_blank" href="//{{ $marketplace->marketplace_link }}">{{ $marketplace->marketplace_link }}</a></td>
                                                        <td>
                                                            <a target="_blank" href="//{{ $marketplace->marketplace_link }}" class="btn btn-outline-purple">View</a>
                                                            <a class="btn btn-danger" href="{{ route('MarketplaceDelete', $marketplace->id) }}" >Delete</a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr class="text-center">
                                                        <td colspan="50">No Data Available</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div>
@endsection

@section('footer_js')
    <script src="{{ url('/') }}/assets/plugins/select2/js/select2.min.js"></script>
{{--    <script src="{{ url('/') }}/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>--}}
{{--    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>--}}
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('assets/plugins/ion-rangeslider/ion.rangeSlider.min.js')  }}"></script>
    <script src="{{ asset('assets/pages/jquery.range-sliders.js')  }}"></script>

    <script>

        // $(function() {
            $( "#dob, .date-picker" ).datepicker();
        //     $( "#dob" ).datepicker("show");
        // });

        $(document).ready(function(){
            $('#job_present').click(function(){

                if(this.checked)
                    $('.job_to').attr("disabled", true);
                else
                    $('.job_to').removeAttr("disabled");


            });
            $('#district_id, #pdistrict_id, #upazila_id, #pupazila_id').select2();
            $("#interested_location").select2({
                maximumSelectionLength: 3
            });
        });


        var x = 1;

        $('#addMore').on('click', function (e) {
            // var max_fields      = 1; //maximum input boxes allowed
            var addField = '<div class="addField" style="border-top: 1px dotted rgba(0,0,0,0.91); padding-top: 20px;">\n' +
                '  <div class="row">\n'+
                '    <div class="form-group col-md-3">\n' +
                '        <label for="degree'+x+'">Degree</label>\n' +
                '        <select class="degreeList form-control col-md-6" id="degree'+x+'" name="degree_name[]" tabindex="-1" style=" width: 100%">\n' +
                '            <option value="">Select One</option>\n' +
                '                @foreach ($degrees as $degree)\n' +
                '                    <option  value="{{ $degree->id }}">{{ $degree->degree_name }}</option>\n' +
                '                @endforeach\n' +
                '        </select>\n' +
                '    </div>\n' +
                '    <div class="form-group  col-md-3">\n' +
                '        <label for="edu_title'+x+'">Title</label>\n' +
                '       <select name="degree_title[]" id="degree_title" class="form-control col-md-6 degreeTitle" style=" width: 100%">\n'+
                '       @foreach ($degree_title as $title)\n'+
                '       <option value="{{ $title->id }}">{{ $title->degree_title }}</option>\n'+
                '       @endforeach\n'+
                '       </select>\n'+
                '    </div>\n' +
                '    <div class="form-group col-md-3">\n' +
                '        <label for="results'+x+'">Results</label>\n' +
                '        <input type="text" class="form-control col-md-6" name="results[]" id="results'+x+'" placeholder="Ex:- 3.5" >\n' +
                '    </div>\n' +
                '    <div class="form-group  col-md-2">\n' +
                '        <label for="passing_year'+x+'">Passing Year</label>\n' +
                '        <input type="text" class="form-control col-md-6" name="passing_year[]" id="passing_year'+x+'" placeholder="Passing Year" >\n' +
                '    </div>\n' +
                '</div>\n'+
                '<div class="row">\n'+
                '     <div class="form-group  col-md-3">\n' +
                '         <label for="major_study'+x+'">Field of study (Major)</label>\n' +
                '         <input type="text" class="form-control col-md-6" name="major_study[]" id="major_study'+x+'" placeholder="Ex:-English, Studies" >\n' +
                '     </div>\n' +
                '     <div class="form-group  col-md-3">\n' +
                '         <label for="edu_duration'+x+'">Duration</label>\n' +
                '         <input type="text" class="form-control col-md-6" name="edu_duration[]" id="edu_duration'+x+'" placeholder="Ex:- 2 Years" >\n' +
                '     </div>\n' +
                '     <div class="form-group  col-md-3">\n' +
                '         <label for="edu_institute'+x+'">Institute</label>\n' +
                '         <input type="text" class="form-control col-md-6" name="edu_institute[]" id="edu_institute'+x+'" placeholder="Institute">\n' +
                '     </div>\n' +

                '     <div class="form-group  col-md-2">\n' +
                '         <label for="board'+x+'">Board</label>\n' +
                '        <select name="board_name[]" id="board_id" class="form-control col-md-6 boardList" style=" width: 100%">\n'+
                '        @foreach ($boards as $board)\n'+
                '        <option value="{{ $board->id }}">{{ $board->board_name }}</option>\n'+
                '        @endforeach\n'+
                '        </select>\n'+
                '     </div>\n' +
                '        <div class="col-md-1 cross text-danger">\n' +
                '        <label><i class="fa fa-trash removebtn"> Remove</i></label>\n' +
                '    </div>'
            '</div>'
            $(".cloneDiv").append(addField); //add input box
            x++;
            $('.degreeList, .boardList, .degreeTitle').select2();
            $("body").on("click", ".cross", function () {
                $(this).closest(".addField").remove();
            });
        });

        var tr = 1;

        var addFieldTraining = '<div class="row addFieldTraining" style="border-top: 1px dotted rgba(0,0,0,0.91); padding-top: 20px;">\n' +
            ' <div class="form-group col-md-6">\n' +
            '       <label for="training_name'+tr+'">Title</label>\n' +
            '        <input type="text" class="form-control" name="training_name[]" id="training_name'+tr+'" placeholder="Title">\n' +
            ' </div>\n' +
            ' <div class="form-group col-md-6">\n' +
            '      <label for="trainingCountry'+tr+'">Country</label>\n' +
            '      <select class="countryList form-control" id="trainingCountry'+tr+'" name="trainingCountry[]" tabindex="-1" >\n' +
            '             <option value="">Select One</option>\n' +
            '             @foreach ($countries as $country)\n' +
            '              <option  value="{{ $country->id }}">{{ $country->name }}</option>\n' +
            '             @endforeach\n' +
            '      </select>\n' +
            '  </div>\n' +
            '  <div class="form-group  col-md-6">\n' +
            '       <label for="topic_cover'+tr+'">Topic Cover</label>\n' +
            '       <input type="text" class="form-control col-md-6" name="topic_cover[]" id="topic_cover'+tr+'" placeholder="Ex:- HTML, CSS, PHP" >\n' +
            '  </div>\n' +
            '  <div class="form-group  col-md-6">\n' +
            '       <label for="training_year'+tr+'">Training Year</label>\n' +
            '       <input type="text" class="form-control col-md-6" name="training_year[]" id="training_year'+tr+'" placeholder="Training Year" >\n' +
            '   </div>\n' +
            '   <div class="form-group  col-md-6">\n' +
            '         <label for="trainingInstitute'+tr+'">Institute</label>\n' +
            '          <input type="text" class="form-control col-md-6" name="trainingInstitute[]" id="trainingInstitute'+tr+'" placeholder="Institute Name" >\n' +
            '    </div>\n' +
            '    <div class="form-group  col-md-6">\n' +
            '         <label for="trainingduration'+tr+'">Duration</label>\n' +
            '         <input type="text" class="form-control col-md-6" name="trainingduration[]" id="trainingduration'+tr+'" placeholder="Course Duration" >\n' +
            '     </div>\n' +
            '      <div class="form-group  col-md-6">\n' +
            '          <label for="traininglocation'+tr+'">Location</label>\n' +
            '          <input type="text" class="form-control col-md-6" name="traininglocation[]" id="traininglocation'+tr+'" placeholder="Institute Address">\n' +
            '      </div>\n' +
            '        <div class="col-md-1 crossTraining text-danger">\n' +
            '            <label><i class="fa fa-trash removebtn"> Remove</i></label>\n' +

            '      </div>'
        '</div>'

        $('#addMoreTraining').on('click', function (e) {

            $(".cloneDivTraining").append(addFieldTraining); //add input box
            tr++;
            $('.countryList').select2();

            $("body").on("click", ".crossTraining", function () {
                $(this).closest(".addFieldTraining").remove();
            });
        });



        var te = 1;

        $('#addMoreExperience').on('click', function (e) {

            te++;

            var addFieldExperience = '<div class="row addFieldExperience" style="border-top: 1px dotted rgba(0,0,0,0.91); padding-top: 20px;">\n' +

                '<div class="form-group col-md-6">\n'+
                '     <label for="company_name'+te+'">Company Name</label>\n'+
                '     <input type="text" class="form-control" name="company_name[]" id="company_name'+te+'" placeholder="Company Name">\n'+
                '</div>\n'+
                '<div class="form-group col-md-6">\n'+
                '      <label for="job_designation'+te+'">Designation</label>\n'+
                '      <input type="text" class="form-control col-md-6" name="job_designation[]" id="job_designation'+te+'" placeholder="Ex:- Software Engineer" >\n'+
                '</div>\n'+

                '<div class="form-group col-md-6">\n'+
                '    <div class="row">\n'+
                '       <div class="form-group col-md-5">\n'+
                '            <label for="job_from'+te+'">From</label>\n'+
                '            <input type="text" class="form-control col-md-6 job_from'+te+' picker'+te+'" name="job_from[]" id="job_from'+te+'" placeholder="Ex:- 10/15/2016" >\n'+
                '       </div>\n'+
                '       <div class="form-group col-md-2">\n'+
                '            <label for="job_present">Present</label>\n'+
                '            <input  type="checkbox" class="form-control col-md-6 present" name="job_to" id="job_present'+te+'" >\n'+
                '       </div>\n'+
                '       <div class="form-group col-md-5">\n'+
                '            <label for="job_to'+te+'">To</label>\n'+
                '            <input type="text" class="form-control col-md-6 tmi job_to date-pickerl'+te+'" name="job_to[]" id="job_to'+te+'" placeholder="Ex:- 05/30/2017" >\n'+
                '       </div>\n'+
                '    </div>\n'+
                '</div>\n'+
                '<div class="form-group col-md-6">\n'+
                '    <label for="job_summary'+te+'">Summary</label>\n'+
                '    <textarea type="text" class="form-control col-md-6" name="job_summary[]" id="job_summary'+te+'" placeholder="Job Summary" ></textarea>\n'+
                '</div>\n'+
                // '<div class="form-group col-md-12 text-right">\n'+
                '     <div class="crossExperience cross text-danger row">\n' +
                '          <label><i class="fa fa-trash removebtn"> Remove</i></label>\n' +
                // '     </div>\n'+
                '</div>'

            '</div>';


            $(".cloneDivExperience").append(addFieldExperience); //add input box

            let datep = '.picker' + te;
            let datel = '.date-pickerl' + te;

            $(datep).datepicker();
            $(datel).datepicker();

            let jp = '#job_present' + te;
            let jt = '#job_to' + te;

            $(jp).click(function(){
                if(this.checked)
                    $(jt).attr("disabled", true);
                else
                    $(jt).removeAttr("disabled");

            });

            // $(job_from).datepicker();
            // $(job_to).datepicker();
            // $('.date-picker').datepicker();

            $("body").on("click", ".crossExperience", function () {
                $(this).closest(".addFieldExperience").remove();
            });

        })


        $(document).ready(function() {
            $('.country, #degree_id,.boardList, .degreeList, .degreeTitle, #skills').select2();

        });

        $('.degreeList').change(function(){
            var degreeID = $(this).val();
            if(degreeID){
                $.ajax({
                    type:"GET",
                    url:"{{ url('api/get-title-list') }}/"+degreeID,
                    success:function(res){
                        if(res){
                            $(".degreeTitle").empty();
                            $(".degreeTitle").append('<option>Select One</option>');
                            $.each(res,function(key,value){
                                $(".degreeTitle").append('<option value="'+ value.id +'">'+ value.degree_title +'</option>');
                            });

                        }else{
                            $(".degreeTitle").empty();
                        }
                    }
                });
            }else{
                $(".degreeTitle").empty();
            }
        });

        $('#district_id').change(function(){
            var district_id = $(this).val();

            if(district_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('api/get-upazila-list')}}/"+district_id,
                    success:function(res){
                        if(res){
                            $("#upazila_id").empty();
                            $("#upazila_id").append('<option>Select</option>');
                            $.each(res,function(key,value){

                                $("#upazila_id").append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });

                        }else{
                            $("#upazila_id").empty();
                        }
                    }
                });
            }else{
                $("#upazila_id").empty();

            }
        });
        $('#pdistrict_id').change(function(){
            var pdistrict_id = $(this).val();

            if(pdistrict_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('api/get-pupazila-list')}}/"+pdistrict_id,
                    success:function(res){
                        if(res){
                            $("#pupazila_id").empty();
                            $("#pupazila_id").append('<option>Select</option>');
                            $.each(res,function(key,value){

                                $("#pupazila_id").append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });

                        }else{
                            $("#pupazila_id").empty();
                        }
                    }
                });
            }else{
                $("#pdistrict_id").empty();

            }
        });

    </script>
{{--    <script>--}}
{{--        $('.eduedit').click(function(){--}}
{{--            let eduid = $(this).attr("data-eid");--}}
{{--            alert(eduid);--}}
{{--        });--}}
{{--    </script>--}}
@endsection
