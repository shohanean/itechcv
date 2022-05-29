<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>iTechCV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/clock.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <script src="{{ asset('/') }}/assets/js/modernizr.min.js"></script>
    @yield('header_css')

</head>
<body>
<!-- Begin page -->
<div id="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="left side-menu">
        <div class="slimscroll-menu" id="remove-scroll">
        <!-- User box -->
        <div class="topbar-left pl-0 text-center">
            <a href="{{ url('/') }}" class="logo">
                <span>
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="iTechCV" height="90" width="120">
                </span>
                <i>
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="iTechCV" height="90" width="120">
                </i>
            </a>
        </div>

            <div class="user-box text-center">

                <div class="user-img imguser-35">
                    @php
                        $profile = App\PersonalInformation::where('user_id', Auth::id())->first();
                    @endphp
                    @isset($profile->user_profile)
                        <img src="{{ asset('images/profile'.'/'.$profile->user_profile) }}" alt="{{  Auth::user()->name ?? '' }}" title="{{  Auth::user()->name ?? '' }}" class="rounded-circle img-fluid">
                    @else
                        <img src="{{ url('/') }}/assets/images/users/avatar.png" alt="{{  Auth::user()->name ?? '' }}" title="{{  Auth::user()->name ?? '' }}" class="rounded-circle img-fluid">
                    @endisset
                </div>
                <h5>{{  Auth::user()->name ?? '' }}</h5>
                <p class="text-muted mb-1">{{  Auth::user()->email ?? '' }}</p>
                @if(Auth::user()->user_role == 1)
                <div class="list-group b-0 mail-list dropdown show">
                    <a href="#" id="dropdownMenuLink" data-toggle="dropdown" class="list-group-item border-0 dropdown-toggle" aria-haspopup="true" aria-expanded="false">
                        @if($profile->job_status == 1)
                            <span class="fa fa-circle text-success mr-2"></span>Available
                        @elseif($profile->job_status == 2)
                            <span class="fa fa-circle text-pink mr-2"></span>Not Now
                        @else
                            <span class="fa fa-circle text-purple mr-2"></span>In Job
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{ route('JobStatusChange', 1) }}"><i class="fa fa-circle text-success mr-2"></i>Available</a>
                        <a class="dropdown-item" href="{{ route('JobStatusChange', 2) }}"><i class="fa fa-circle text-pink mr-2"></i>Not Now</a>
                        <a class="dropdown-item" href="{{ route('JobStatusChange', 3) }}"><i class="fa fa-circle text-purple mr-2"></i>In Job</a>
                    </div>
                </div>
                @endif
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu" class="mm-active">
                <ul class="metismenu" id="side-menu">
                    <!--<li class="menu-title">Navigation</li>-->
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="fi-air-play"></i><span> Dashboard </span>
                        </a>
                    </li>
                    @if(Auth::user()->user_role == 1)
                        {{--Job Seeker--}}
                        <li>
                            <a href="{{ route('jobTopic') }}">
                                <i class="fa fa-list-alt "></i><span>Category </span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);"><i class="fi-briefcase"></i> <span> Your CV </span> <span class="menu-arrow"></span></a>
                            <ul class="nav-second-level" aria-expanded="false">
                                <li><a href="{{ route('CVUpdateForm') }}"><i class="fas fa-edit"></i> Update Your CV</a></li>
                                <li><a href="{{ route('CVPreview') }}"><i class="far fa-file-alt"></i> See Your CV</a></li>
                                <li><a target="_blank" href="{{ route('LivePreview') }}"><i class="fas fa-download"></i> Download Your CV</a></li>
                            </ul>
                        </li>
                    @elseif(Auth::user()->user_role == 2)
                        {{--Job Employer--}}
                        <li>
                            <a href="{{ route('employerRequested') }}">
                                <i class="fas fa-tasks"></i></i><span>CV Request</span>
                                <span class="badge badge-success float-right">{{ App\CvRequest::where('user_id', Auth::id())->count() }}</span>
                            </a>
                        </li>
                    @if(Auth::user()->email == 'career@softwareltd.com')
                        <li>
                            <a href="{{ route('CompanyProfile') }}">
                                <i class="fa fa-briefcase "></i><span>Company Profile </span>
                            </a>
                        </li>
                    @endif
                    @else
                        {{--Job Admin--}}
                        <li>
                            <a href="{{ route('SearchSeeker') }}">
                                <i class="fa fa-search"></i><span>Search CV</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('employerRequested') }}">
                                <i class="fas fa-tasks"></i></i><span>CV Request</span>
                                <span class="badge badge-success float-right">{{ App\CvRequest::count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('AllCVList') }}">
                                <i class="fas fa-clipboard-list"></i><span>All CV List</span>
                                <span class="badge badge-info float-right">{{ App\User::where('user_role', 1)->count() }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Skills') }}">
                                <i class="fa fa-bolt"></i><span>Skills</span>
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="javascript: void(0);"><i class="far fa-id-badge"></i><span> Profile </span> <span class="menu-arrow"></span></a>
                        <ul class="nav-second-level" aria-expanded="false">
                            @if(Auth::user()->user_role == 2)
                            <li><a href="{{ route('EmployerPhoto') }}"><i class="fas fa-image"></i> Profile Picture</a></li>
                            @else
                            <li><a href="{{ route('ProfilePhoto') }}"><i class="fas fa-image"></i> Profile Picture</a></li>
                            @endif
                            <li><a href="{{ route('PasswordChange') }}"><i class="fi-lock"></i> Change Password</a></li>
                        </ul>
                    </li>

                    <li>
                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fi-power"></i><span>{{ __('Logout') }}</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            <!-- Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <style>
        #clock .digits div.zero .d1,
        #clock .digits div.zero .d3,
        #clock .digits div.zero .d4,
        #clock .digits div.zero .d5,
        #clock .digits div.zero .d6,
        #clock .digits div.zero .d7{
            opacity:1;
        }
    </style>
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        <!-- Top Bar Start -->
        {{--                <div class="topbar">--}}
        <nav class="navbar-custom">
            <ul class="list-unstyled topbar-right-menu float-right mb-0">
                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="false" aria-expanded="false">
                        @isset($profile->user_profile)
                            <img src="{{ asset('images/profile'.'/'.$profile->user_profile) }}" alt="{{  Auth::user()->name ?? '' }}" class="rounded-circle"> <span class="ml-1">{{  Auth::user()->name ?? '' }} <i class="mdi mdi-chevron-down"></i> </span>
                        @else
                            <img src="{{ url('/') }}/assets/images/users/avatar.png" alt="{{  Auth::user()->name ?? '' }}" title="{{  Auth::user()->name ?? '' }}" class="rounded-circle img-fluid">
                        @endisset

                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown ">
                        <!-- item-->
                        <div class="dropdown-item noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>

                        <!-- item-->
                        <a href="{{ route('ProfilePhoto') }}" class="dropdown-item notify-item">
                            <i class="fa fa-image"></i> <span>Profile Image</span>
                        </a>

                        <!-- item-->
                        <a href="{{ route('PasswordChange') }}" class="dropdown-item notify-item">
                            <i class="fi-lock"></i> <span>Change Password</span>
                        </a>
                        <!-- item-->

                        <a class="dropdown-item notify-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="fi-power"></i>{{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>

            <ul class="list-inline menu-left mb-0">
                {{-- <li class="clockcenter">
                    <div id="clock" class="dark">
                        <div class="display">
                            <div class="weekdays"></div>
                            <div class="ampm"></div>
                            <div class="alarm"></div>
                            <div class="digits"></div>
                        </div>
                    </div>
                   <div class="clock" id="clock" style="left: 50%!important;"></div>
                </li> --}}
                <li class="float-left">
                    <button class="button-menu-mobile open-left disable-btn">
                        <i class="dripicons-menu"></i>
                    </button>
                </li>

                {{--  <li>
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard </h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Welcome to Highdmin admin panel !</li>
                        </ol>
                    </div>
                </li>  --}}
            </ul>
        </nav>
        {{--                </div>--}}
    <!-- Top Bar End -->

        <!-- Start Page content -->
        @yield('content')

    </div>


    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- jQuery  -->
<script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
<script src="{{ url('/') }}/assets/js/popper.min.js"></script>
<script src="{{ url('/') }}/assets/js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/assets/js/metisMenu.min.js"></script>
<script src="{{ url('/') }}/assets/js/waves.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.slimscroll.js"></script>

<!-- App js -->
<script src="{{ url('/') }}/assets/js/jquery.core.js"></script>
<script src="{{ url('/') }}/assets/js/jquery.app.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('footer_js')
<script>
    // var div = document.getElementById ( "clock" ), // Get DIV
    //     st = div.style, // style DIV
    //     d = new Date (), // Get Date
    //     size = [80, 80], // Size Width,Height
    //     bg = 'transparent',
    //     i;
    //
    // // Styling
    //
    // st.width = size [0] + 'px';
    // st.height = size [1] + 'px';
    // st.backgroundColor = bg;
    // st.position = 'relative';
    // // st.top = '0';
    // // st.left = '0';
    //
    // // Construct
    //
    // // Clock
    //
    // var Draw = { // Draw Var Function
    //
    //     clock : function ( rx, ry, cw ) { // Build Clock
    //
    //         this.hours ( 12, rx, ry, 0, cw );
    //         this.nums ( 12, rx * 0.8, ry * 0.8, 1, cw );
    //         this.seconds ( 60, rx, ry, 0, cw );
    //
    //         circle = document.createElement ( 'span' );
    //         circle.style.backgroundColor = '#000';
    //         circle.style.position = 'absolute';
    //         circle.style.top = '50%';
    //         circle.style.left = '50%';
    //         circle.style.width = ( rx / 4 ) + 'px';
    //         circle.style.height = ( ry / 4 ) + 'px';
    //         circle.style.borderRadius = '50%';
    //         circle.style.transform = 'translate(-50%, -50%)';
    //
    //         div.appendChild ( circle );
    //
    //         this.needle ( rx, ry );
    //
    //         circle = document.createElement ( 'span' );
    //         circle.style.backgroundColor = '#FFF';
    //         circle.style.position = 'absolute';
    //         circle.style.top = '50%';
    //         circle.style.left = '50%';
    //         circle.style.width = ( rx / 8 ) + 'px';
    //         circle.style.height = ( ry / 8 ) + 'px';
    //         circle.style.borderRadius = '50%';
    //         circle.style.transform = 'translate(-50%, -50%)';
    //
    //         div.appendChild ( circle );
    //
    //         this.start ();
    //
    //     },
    //
    //     hours : function ( n, rx, ry, so, cw ) { // Build Hour Stick
    //
    //         hDegree = 360 / n;
    //
    //         for ( var i = 0; i < n; i++ ) {
    //
    //             h = document.createElement ( 'span' );
    //             h.style.position = 'absolute';
    //             h.style.backgroundColor = '#000';
    //             h.style.width = ( size [0] * 0.005 ) + 'px';
    //             h.style.height = ( size [1] * 0.06 ) + 'px';
    //             h.style.top = String ( ry + -ry * Math.cos ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) + 'px';
    //             h.style.left = String ( rx + rx * ( cw ? Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) : -Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) ) + 'px';
    //             h.style.transformOrigin = '0% 0%';
    //             h.style.transform = 'rotate(' + ( hDegree * i ) + 'deg)';
    //
    //             div.appendChild ( h );
    //
    //         }
    //
    //     },
    //
    //     nums : function ( n, rx, ry, so, cw ) { // Build Numbers
    //
    //         for ( var i = 0; i < n; i++ ) {
    //
    //             t = document.createElement ( 'span' );
    //             t.style.position = 'absolute';
    //             t.style.fontSize = size [0] * 0.06 + 'px';
    //             t.style.fontColor = '#000';
    //             h.style.transformOrigin = '0% 0%';
    //             t.style.top = String ( ( ry * 0.15 ) + ry + -ry * Math.cos ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) + 'px';
    //             t.style.left = String ( ( rx * 0.225 ) + rx + rx * ( cw ? Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) : -Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) ) + 'px';
    //             t.innerHTML = ( i + 1 );
    //
    //             div.appendChild ( t );
    //
    //         }
    //
    //     },
    //
    //     seconds : function ( n, rx, ry, so, cw ) { // Build Seconds
    //
    //         sDegree = 360 / n;
    //
    //         for ( var i = 0; i < n; i++ ) {
    //
    //             s = document.createElement ( 'span' );
    //             s.style.position = 'absolute';
    //             s.style.backgroundColor = '#000';
    //             s.style.width = ( size [0] * 0.0025 ) + 'px';
    //             s.style.height = ( size [1] * 0.03 ) + 'px';
    //             s.style.top = String ( ry + -ry * Math.cos ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) + 'px';
    //             s.style.left = String ( rx + rx * ( cw ? Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) : -Math.sin ( ( 360 / n / 180 ) * ( i + so ) * Math.PI ) ) ) + 'px';
    //             s.style.transformOrigin = '0% 0%';
    //             s.style.transform = 'rotate(' + ( sDegree * i ) + 'deg)';
    //
    //             div.appendChild ( s );
    //
    //         }
    //
    //     },
    //
    //     needle : function ( rx, ry ) { // Build Needle
    //
    //         second = document.createElement ( 'span' );
    //         second.style.position = 'absolute';
    //         second.style.width = ( rx * 2 ) * 0.005 + 'px';
    //         second.style.height = ( ry * 2 ) * 0.5 + 'px';
    //         second.style.backgroundColor = '#F00';
    //         second.style.top = '0px';
    //         second.style.left = '50%';
    //         second.style.transform = 'rotate(0deg) translateX(-50%)';
    //         second.style.transformOrigin = '0% 100%';
    //         second.style.transform = 'rotate(0deg)';
    //         second.style.opacity = '0.5';
    //         second.className = 'sec';
    //
    //         div.appendChild ( second );
    //
    //         minut = document.createElement ( 'span' );
    //         minut.style.position = 'absolute';
    //         minut.style.top = '0px';
    //         minut.style.left = '50%';
    //         minut.style.transform = 'rotate(0deg) translateX(-50%)';
    //         minut.style.backgroundColor = '#00F';
    //         minut.style.transformOrigin = '0% 100%';
    //         minut.style.width = ( rx * 2 ) * 0.01 + 'px';
    //         minut.style.height = ( ry * 2 ) * 0.5 + 'px';
    //         minut.style.opacity = '0.5';
    //         minut.className = 'min';
    //
    //         div.appendChild ( minut );
    //
    //         hour = document.createElement ( 'span' );
    //         hour.style.position = 'absolute';
    //         hour.style.top = '0px';
    //         hour.style.left = '50%';
    //         hour.style.transform = 'rotate(0deg) translateX(-50%)';
    //         hour.style.backgroundColor = '#000';
    //         hour.style.transformOrigin = '0% 100%';
    //         hour.style.width = ( rx * 2 ) * 0.02 + 'px';
    //         hour.style.height = ( ry * 2 ) * 0.5 + 'px';
    //         hour.style.opacity = '0.5';
    //         hour.className = 'hour';
    //
    //         div.appendChild ( hour );
    //
    //     },
    //
    //     start : function () { // Start Anim
    //
    //         sec = document.querySelectorAll ( '.sec' ) [0];
    //         min = document.querySelectorAll ( '.min' ) [0];
    //         hour = document.querySelectorAll ( '.hour' ) [0];
    //
    //         setInterval ( function () {
    //
    //             d = new Date ();
    //
    //             secRot = d.getSeconds () * ( 360 / 60 );
    //             minRot =  d.getMinutes () * ( 360 / 60 );
    //             houRot = d.getHours () * ( 360 / 12 );
    //             sec.style.transform = 'rotate(' + secRot + 'deg)';
    //             min.style.transform = 'rotate(' + minRot + 'deg)';
    //             hour.style.transform = 'rotate(' + houRot + 'deg)';
    //
    //         }, 500 );
    //
    //     }
    //
    // };
    //
    // // Call Clock
    //
    // Draw.clock ( size [0] / 2, size [1] / 2, 1 );

</script>
</body>
</html>
