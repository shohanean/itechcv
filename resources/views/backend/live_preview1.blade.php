<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Creative IT CV Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    @yield('header_css')

</head>


<body>
<!-- Begin page -->
<div id="wrapper">
    <div class="content">
        <div class="container-fluid">

            <div class='col-lg-8 offset-2 mtop20'>
                <div class="row">
                    <div class="col-sm-12">
                        <!-- meta -->
                        <div class="profile-user-box card-box bg-custom">
                            <div class="row">
                                <div class="col-sm-6">
                                    <span class="pull-left mr-3"><img src="{{  $personal_info->user_profile != null ? asset('images/profile').'/'.$personal_info->user_profile :  url('assets/images/user-avatar.jpg') }}" alt="" class="thumb-lg rounded-circle"></span>
                                    <div class="media-body text-white">
                                        <h4 class="mt-1 mb-1 font-18">{{ $auth->name ?? ''}}</h4>
                                        <p class="font-13 text-light"> {{ $personal_info->designation ?? ''}}</p>
                                        <p class="text-light mb-0">{{ $personal_info->present_address ?? ''}} {{ $personal_info->upazila->name ?? ''}} {{ $personal_info->district->name ?? ''}}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--/ meta -->
                    </div>
                </div>
                <!-- end row -->


                <div class="row">
                    <div class="col-md-4">
                        <!-- Personal-Information -->
                        <div class="card-box">
                            <h4 class="header-title mt-0 m-b-20">Personal Information</h4>
                            <div class="panel-body">
                                <p class="text-muted font-13">
                                    {{ $Obj->job_objective ?? ''}}
                                </p>

                                <hr>

                                <div class="text-left">
                                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $auth->name ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Fathers Name :</strong> <span class="m-l-15">{{ $personal_info->father_name ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Mothers Name :</strong> <span class="m-l-15">{{ $personal_info->mother_name ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Date Of Birth :</strong> <span class="m-l-15">{{ $personal_info->dob ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Present Address :</strong> <span class="m-l-15">{{ $personal_info->present_address ?? ''}} {{ $personal_info->upazila->name ?? ''}} {{ $personal_info->district->name ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Permanent Address :</strong> <span class="m-l-15">{{ $personal_info->permanent_address ?? ''}} {{ $personal_info->pupazila->name ?? ''}} {{ $personal_info->pdistrict->name ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ $personal_info->phone ?? ''}}</span></p>
                                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $auth->email ?? ''}}</span></p>


                                </div>

                            </div>
                        </div>
                        <!-- Personal-Information -->

                        <div class="card-box ribbon-box">
                            <div class="ribbon ribbon-primary">Skills</div>
                            <div class="clearfix"></div>
                            <div class="inbox-widget">
                                @foreach($jskills as $jskill)
                                    <div class="inbox-item">
                                        <div class="skill_name">
                                            <p class="text-uppercase">{{ $jskill->skill->skill_name ?? ''}}</p>
                                        </div>
                                        <div class="progress mb-0">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $jskill->progress }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $jskill->progress ?? ''}}%</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card-box ribbon-box">
                            <div class="ribbon ribbon-primary">Marketplace</div>
                            <div class="clearfix"></div>
                            <div class="inbox-widget">
                                <div class="row">
                                    @foreach($marketplaces as $marketplace)
                                        <div class="inbox-item col-2">
                                            <a target="_blank" href="{{ $marketplace->marketplace_link ?? ''}}">
                                                <img src="{{ asset('images/marketplace/'.'/'.$marketplace->marketplace_icon) ?? ''}}" alt="Marketplace">
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-8">
                        <div class="card-box">
                            <h4 class="header-title mt-0 mb-3"><u>Job Experience</u></h4>
                            <div class="">

                                @forelse($job_experiences as $job_experience)
                                    <div class="">
                                        <h5 class="text-custom m-b-5 text-capitalize">{{ $job_experience->company_name ?? ''}}</h5>
                                        <p class="m-b-0 text-capitalize">{{ $job_experience->designation ?? ''}}</p>
                                        <p class="text-capitalize"><b>{{ $job_experience->job_from ?? ''}}-{{ $job_experience->job_to ?? ''}}</b></p>

                                        <p class="text-muted font-13 m-b-0">
                                            {{ $job_experience->job_summary ?? ''}}
                                        </p>
                                    </div>
                                @empty
                                    <div class="text-center">
                                        <strong>No Data Available</strong>
                                    </div>
                                @endforelse

                                <hr>

                            </div>
                        </div>

                        <div class="card-box">
                            <h4 class="header-title mb-3">Education's</h4>

                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Degree Title</th>
                                        <th>Board Name</th>
                                        <th>Passing Year</th>
                                        <th>Results</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($educations as $education)
                                        <tr>
                                            <td>{{ $loop->index +1 ?? ''}}</td>
                                            <td>{{ $education->degreeTitle->degree_title ?? ''}}</td>
                                            <td>{{ $education->board->board_name ?? ''}}</td>
                                            <td>{{ $education->passing_year ?? ''}}</td>
                                            <td>{{ $education->result_point ?? ''}}</td>

                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-box">
                            <h4 class="header-title mb-3">My Portfolio</h4>

                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Project Icon</th>
                                        <th>Project Link</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($portfolios as $portfolio)
                                        <tr>
                                            <td>{{ $loop->index +1 ?? ''}}</td>
                                            <td><img src="{{ asset('images/portfolio'.'/'.$portfolio->portfolio_icon) ?? ''}}" alt="icon"></td>
                                            <td><a target="_blank" href="{{ $portfolio->portfolio_link ?? ''}}">{{ $portfolio->portfolio_link ?? ''}}</a></td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>

        </div> <!-- container -->

    </div>
    @if (Auth::id() == 1 && Auth::id() == 5)
        <a href="{{ route('pdfDownload') }}">Download</a>
    @endif

</div>


<!-- jQuery  -->
<script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
<script src="{{ url('/') }}/assets/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/assets/js/metisMenu.min.js"></script>
<script src="{{ url('/') }}/assets/js/waves.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.slimscroll.js"></script>

<!-- Flot chart -->
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.time.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.resize.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.pie.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.crosshair.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/curvedLines.js"></script>
<script src="{{ url('/') }}/assets/plugins/flot-chart/jquery.flot.axislabels.js"></script>

<!-- KNOB JS -->
<!--[if IE]>
        <script type="text/javascript" src="{{ url('/') }}/plugins/jquery-knob/excanvas.js"></script>
        <![endif]-->
<script src="{{ url('/') }}/assets/plugins/jquery-knob/jquery.knob.js"></script>

<!-- Dashboard Init -->
<script src="{{ url('/') }}/assets/pages/jquery.dashboard.init.js"></script>
<script src="{{ url('/') }}/assets/js/modernizr.min.js"></script>
@yield('footer_js')
<!-- App js -->
<script src="{{ url('/') }}/assets/js/jquery.core.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.app.js"></script>

</body>
</html>
