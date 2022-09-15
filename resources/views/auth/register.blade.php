@extends('layouts.app')

@section('content')
    {{--    pr-1 pl-1--}}
    <div class="card-box pr-5 pl-5 pb-5">
        <h2 class="text-uppercase text-center mt-0 pb-2">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('assets/images/logo.png') }}" alt="iTechCV" width="150"></span>
            </a>
        </h2>

        <div class="row" id="rowId">
            <div class="col-sm-6 pl-0 pr-0">
                <div class="card card-body">
                    <h5 class="card-title brdrbtm text-info"><i class="fa fa-users mr-1"></i> <span>Job Seeker</span></h5>
                    <p> <i class="dripicons-arrow-right text-info"></i> Create Account for free</p>
                    <p> <i class="dripicons-arrow-right text-info"></i> Make CV & Get Job</p>
                    <p> <i class="dripicons-arrow-right text-info"></i> Automatic CV Format</p>
                    <p> <i class="dripicons-arrow-right text-info"></i> CV Live Preview</p>
                    <p> <i class="dripicons-arrow-right text-info"></i> Download CV</p>
                    <button id="SkrBtn" type="button" class="btn btn-info waves-effect waves-light"> <i class="fa fa-users mr-1"></i> <span>Sign Up</span> </button>
                </div>
            </div>
            <div class="col-sm-6 pr-0 pl-0">
                <div class="card card-body">
                    <h5 class="card-title brdrbtm text-primary"><i class="fa fa-briefcase mr-1"></i><span>Employer</span></h5>
                    <p> <i class="dripicons-arrow-right text-primary"></i> Create Account for free</p>
                    <p> <i class="dripicons-arrow-right text-primary"></i> Find Skill People</p>
                    <p> <i class="dripicons-arrow-right text-primary"></i> Find Experienced People</p>
                    <p> <i class="dripicons-arrow-right text-primary"></i> Quick Access</p>
                    <p> <i class="dripicons-arrow-right text-primary"></i> Quick Response with CV</p>
                    <button id="EmpBtn" type="button" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-briefcase mr-1"></i> <span>Sign Up</span> </button>
                </div>
            </div>
        </div>

        <form id="EmpForm" class="form-horizontal" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="username">Full Name <span class="starred">*</span></label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                           id="username"
                           placeholder="Enter Name">
                    @error('name')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="eusername_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="emailaddress">Email address <span class="starred">*</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                           id="emailaddress" placeholder="Enter Email">
                    @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="emailaddress_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label for="password">Password <span class="starred">*</span></label>
                    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password"
                           id="password"
                           placeholder="Enter Your Password">
                    @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="password_err"></span>
                </div>
                <div class="col-6">
                    <label for="password_confirmation">Confirm Password <span class="starred">*</span></label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" type="password" id="password_confirmation"
                           placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="password_confirmation_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-10">
                <div class="col-6">
                    <label for="phone">Phone <span class="starred">*</span></label>
                    <div class="form-group">
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text"
                               id="phone"
                               placeholder="Enter Phone">

                        @error('phone')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span id="phone_err"></span>
                    </div>
                </div>
                <div class="col-6">
                    <label>Gender</label>
                    <div class="form-group">
                        <input type="radio" id="male" name="gender" class="@error('gender') is-invalid @enderror"
                               value="1"><label for="male">&nbsp;Male</label>
                        <input type="radio" id="female" name="gender" class="@error('gender') is-invalid @enderror"
                               value="2"><label for="female">&nbsp;Female</label>
                        <br>
                        @error('gender')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label for="company">Company Name <span class="starred">*</span></label>
                    <div class="form-group">
                        <input type="text" id="company" name="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="ABC Software Ltd">
                        @error('company_name')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span id="company_err"></span>
                    </div>
                </div>
                <div class="col-6">
                    <label for="trade">Company Trade License <span class="starred">*</span></label>
                    <div class="form-group">
                        <input type="text" id="trade" name="company_trade_license" class="form-control @error('company_trade_license') is-invalid @enderror" placeholder="Ex: 0524587">
                        @error('company_trade_license')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span id="trade_err"></span>
                    </div>
                </div>
            </div>
            <div class="form-group row text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-block btn-custom waves-effect waves-light" onclick="return eform_validation()" type="submit">Employer Sign Up</button>
                </div>
            </div>
            <input type="hidden" name="looking" value="employer">
        </form>

        <form id="SkrForm" class="form-horizontal" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="susername">Full Name <span class="starred">*</span></label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                           id="susername"
                           placeholder="Enter Name">
                    @error('name')
                    <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <span id="sname_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="semailaddress">Email address <span class="starred">*</span></label>
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                           id="semailaddress" placeholder="Enter Email">
                    @error('email')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="semail_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label for="spassword">Password <span class="starred">*</span></label>
                    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password"
                           id="spassword"
                           placeholder="Enter Your Password">
                    @error('password')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="spassword_err"></span>
                </div>
                <div class="col-6">
                    <label for="spassword_confirmation">Confirm Password <span class="starred">*</span></label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror"
                           name="password_confirmation" type="password" id="spassword_confirmation"
                           placeholder="Enter Confirm Password">
                    @error('password_confirmation')
                    <span class="invalid-feedback text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <span id="spassword_confirmation_err"></span>
                </div>
            </div>
            <div class="form-group row m-b-10">
                <div class="col-6">
                    <label for="sphone">Phone</label>
                    <div class="form-group">
                        <input required class="form-control @error('phone') is-invalid @enderror" name="phone" type="text"
                               id="sphone"
                               placeholder="Enter Phone">

                        @error('phone')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for="snid">NID/Birth Certificate</label>
                    <div class="form-group">
                        <input class="form-control @error('nid') is-invalid @enderror" name="nid" type="text"
                               id="snid"
                               placeholder="Ex: 9523652255892555">

                        @error('nid')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="form-group row m-b-20">
                <div class="col-6">
                    <label>Are you student of CIT? <span class="starred">*</span></label>
                    <div class="form-group">
                        <input type="radio" id="yes" name="is_student" class="@error('is_student') is-invalid @enderror"
                               checked value="1"><label for="yes">&nbsp;Yes</label>
                        <input type="radio" id="no" name="is_student" class="@error('is_student') is-invalid @enderror"
                               value="2"><label for="no">&nbsp;No</label>
                        <br>
                        @error('is_student')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span id="yes_err"></span>
                    </div>
                </div>
                <div class="col-6">
                    <label>Gender <span class="starred">*</span></label>
                    <div class="form-group">
                        <input type="radio" id="smale" name="gender" class="@error('gender') is-invalid @enderror"
                               value="1"><label for="smale">&nbsp;Male</label>
                        <input type="radio" id="sfemale" name="gender" class="@error('gender') is-invalid @enderror"
                               value="2"><label for="sfemale">&nbsp;Female</label>
                        <br>
                        @error('looking')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <span id="gender_err"></span>
                    </div>
                </div>
            </div>
            <div class="form-group row text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-block btn-custom waves-effect waves-light" onclick="return forn_validation()" type="submit">Seeker Sign Up</button>
                </div>
            </div>
            <input type="hidden" name="looking" value="user">
        </form>

        <div class="row m-t-20">
            <div class="col-sm-12 text-center">
                <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-dark m-l-5"><b>Sign In</b></a></p>
            </div>
        </div>

        <div class="row m-t-20">
            <div class="col-sm-12 text-center">
                <button id="Back2Employer" type="button" class="btn btn-primary waves-effect waves-light"> <i class="fa fa-arrow-left mr-1"></i> <span>Employer Form</span> </button>
                <button id="Back2Seeker" type="button" class="btn btn-info waves-effect waves-light"> <i class="fa fa-arrow-left mr-1"></i> <span>Seeker Form</span> </button>
            </div>
        </div>

        <div class="row mt-5 w-100 text-center" style="position:absolute;bottom:-20%;">
            <div class="col-sm-12">
                <p>Copyright © {{ date('Y')}}<a href="{{ url('/') }}"> iTechCV</a> All Rights Reserved</p>
            </div>
        </div>

    </div>

@endsection

@section('optional')
    <div class="card-box pr-5 pl-5 pb-5">
        <h2 class="text-uppercase text-center mt-0 pb-2">
            <a href="{{ url('/') }}" class="text-success">
                <span><img src="{{ asset('assets/images/logo.png') }}" alt="" height="110"></span>
            </a>
        </h2>

        <form class="form-horizontal" action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group row m-b-20">
                <div class="col-12">
                    <label for="username">Full Name</label>
                    <input name="name" class="form-control @error('name') is-invalid @enderror" type="text"
                           id="username"
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
                    <input name="password" class="form-control @error('password') is-invalid @enderror" type="password"
                           id="password"
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
            <div class="form-group row m-b-10">
                <div class="col-6">
                    <label>Phone</label>
                    <div class="form-group">
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="text"
                               id="phone"
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
            {{--    </div>--}}
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

@section('footer_js')
    <script>
        $(document).ready(function(){
            // do your checks of the radio buttons here and show/hide what you want to
            $("#EmpForm").hide();
            $("#SkrForm").hide();
            $("#Back2Employer").hide();
            $("#Back2Seeker").hide();

            $('#EmpBtn').click(function (){
                $("#EmpForm").show();
                $("#rowId").hide();
                $("#Back2Seeker").show();
            })
            $('#SkrBtn').click(function (){
                $("#SkrForm").show();
                $("#rowId").hide();
                $("#Back2Employer").show();
            })

            $('#Back2Employer').click(function (){
                $("#rowId").hide();
                $("#EmpForm").show();
                $("#SkrForm").hide();
                $("#Back2Employer").hide();
                $("#Back2Seeker").show();
            })

            $('#Back2Seeker').click(function (){
                $("#rowId").hide();
                $("#EmpForm").hide();
                $("#SkrForm").show();
                $("#Back2Seeker").hide();
                $("#Back2Employer").show();
            })

        });

        // Form Validation

        var fname = document.querySelector('#susername');
        var fname_err = document.querySelector('#sname_err');
        var email = document.querySelector('#semailaddress');
        var email_err = document.querySelector('#semail_err');
        var email_rgx = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var pass = document.querySelector('#spassword');
        var pass_err = document.querySelector('#spassword_err');
        var cpass = document.querySelector('#spassword_confirmation');
        var cpass_err = document.querySelector('#spassword_confirmation_err');
        var male = document.querySelector('#smale');
        var female = document.querySelector('#sfemale');
        var gender_err = document.querySelector('#gender_err');
        var yes = document.querySelector('#yes');
        var no = document.querySelector('#no');
        var yes_err = document.querySelector('#yes_err');

        // Employer
        var username = document.querySelector('#username');
        var eusername_err = document.querySelector('#eusername_err');
        var eemail = document.querySelector('#emailaddress');
        var eemail_err = document.querySelector('#emailaddress_err');
        var password = document.querySelector('#password');
        var password_err = document.querySelector('#password_err');
        var password_confirmation = document.querySelector('#password_confirmation');
        var password_confirmation_err = document.querySelector('#password_confirmation_err');
        var phone = document.querySelector('#phone');
        var phone_err = document.querySelector('#phone_err');
        var company = document.querySelector('#company');
        var company_err = document.querySelector('#company_err');
        var trade = document.querySelector('#trade');
        var trade_err = document.querySelector('#trade_err');


        function forn_validation() {
            if (fname.value == '') {
                fname_err.innerHTML  = 'Please enter your name!';
                fname_err.style = 'color: red;';
                fname.style = 'border: 1px solid red;';
                fname.focus();

                return false;
            } else if (email.value == '') {
                email_err.innerHTML = 'Please enter your email!';
                email_err.style = 'color: red;';
                email.style = 'border: 1px solid red;';
                email.focus();

                return false;
            } else if (!email_rgx.test(email.value)) {
                email_err.innerHTML = 'Must be Valid Email!. Ex: yello@gmail.com';
                email_err.style = 'color: red;';
                email.style = 'border: 1px solid red;';
                email.focus();

                return false;
            } else if (pass.value == '') {
                pass_err.innerHTML = 'Please enter your password!';
                pass_err.style = 'color: red;';
                pass.style = 'border: 1px solid red;';
                pass.focus();

                return false;
            } else if (pass.value.length < 8) {
                pass_err.innerHTML = 'Your password must be 8 character!';
                pass_err.style = 'color: red;';
                pass.style = 'border: 1px solid red;';
                pass.focus();

                return false;

            }
            else if (cpass.value == '') {
                cpass_err.innerHTML = 'Please enter confirm password!';
                cpass_err.style = 'color: red;';
                cpass.style = 'border: 1px solid red;';
                cpass.focus();

                return false;
            }
            else if (pass.value != cpass.value ) {
                cpass_err.innerHTML = 'Password & Confirm Password does not match!';
                cpass_err.style = 'color: red;';
                cpass.style = 'border: 1px solid red;';
                cpass.focus();

                return false;
            }
            else if (yes.checked == false && no.checked == false) {
                yes_err.innerHTML = 'Choose One!';
                yes_err.style = 'color: red;';

                return false;
            }
            else if (male.checked == false && female.checked == false) {
                gender_err.innerHTML = 'Choose your gender!';
                gender_err.style = 'color: red;';

                return false;
            }
        }

        function eform_validation() {
            if (username.value == '') {
                eusername_err.innerHTML  = 'Please enter your name!';
                eusername_err.style = 'color: red;';
                username.style = 'border: 1px solid red;';
                username.focus();
                return false;
            }
            else if (eemail.value == '') {
                eemail_err.innerHTML = 'Please enter confirm password!';
                eemail_err.style = 'color: red;';
                eemail.style = 'border: 1px solid red;';
                eemail.focus();

                return false;
            }
            else if (!email_rgx.test(eemail.value)) {
                eemail_err.innerHTML = 'Must be Valid Email!. Ex: yello@gmail.com';
                eemail_err.style = 'color: red;';
                eemail.style = 'border: 1px solid red;';
                eemail.focus();

                return false;
            }
            else if (password.value == '') {
                password_err.innerHTML = 'Please enter your password!';
                password_err.style = 'color: red;';
                password.style = 'border: 1px solid red;';
                password.focus();
                return false;
            }
            else if (password.value.length < 8) {
                password_err.innerHTML = 'Your password must be 8 character!';
                password_err.style = 'color: red;';
                password.style = 'border: 1px solid red;';
                password.focus();

                return false;

            }
            else if (password_confirmation.value == '') {
                password_confirmation_err.innerHTML = 'Please enter confirm password!';
                password_confirmation_err.style = 'color: red;';
                password_confirmation.style = 'border: 1px solid red;';
                password_confirmation.focus();
                return false;
            }
            else if (password.value != password_confirmation.value ) {
                password_confirmation_err.innerHTML = 'Password & Confirm Password does not match!';
                password_confirmation_err.style = 'color: red;';
                password_confirmation.style = 'border: 1px solid red;';
                password_confirmation.focus();

                return false;
            }
            else if (phone.value == '') {
                phone_err.innerHTML = 'Please Enter Phone Number!';
                phone_err.style = 'color: red;';
                phone.style = 'border: 1px solid red;';
                phone.focus();
                return false;
            }
            if (company.value == '') {
                company_err.innerHTML = 'Please enter Company Name!';
                company_err.style = 'color: red;';
                company.style = 'border: 1px solid red;';
                company.focus();
                return false;
            }

            if (trade.value == '') {
                trade_err.innerHTML = 'Please enter trade licence!';
                trade_err.style = 'color: red;';
                trade.style = 'border: 1px solid red;';
                trade.focus();
                return false;
            }
        }


        function remove() {
            if (fname.value != '') {
                fname_err.innerHTML = '';
                fname.style = 'border: 1px solid #000;';

            }
            if (email.value != '') {
                email_err.innerHTML = '';
                email.style = 'border: 1px solid #000;';
            }
            if (pass.value != '') {
                pass_err.innerHTML = '';
                pass.style = 'border: 1px solid #000;';
            }
            if (cpass.value != '') {
                cpass_err.innerHTML = '';
                cpass.style = 'border: 1px solid #000;';
            }
        }

        fname.addEventListener('blur', remove);
        email.addEventListener('blur', remove);
        pass.addEventListener('blur', remove);
        cpass.addEventListener('blur', remove);

        function eremove(){
            // Employer
            if (username.value != '') {
                eusername_err.innerHTML = '';
                username.style = 'border: 1px solid #000;';
            }
            if (eemail.value != '') {
                eemail_err.innerHTML = '';
                eemail.style = 'border: 1px solid #000;';
            }
            if (password.value != '') {
                password_err.innerHTML = '';
                password.style = 'border: 1px solid #000;';
            }
            if (password_confirmation.value != '') {
                password_confirmation_err.innerHTML = '';
                password_confirmation.style = 'border: 1px solid #000;';
            }
            if (phone.value != '') {
                phone_err.innerHTML = '';
                phone.style = 'border: 1px solid #000;';
            }
            if (company.value != '') {
                company_err.innerHTML = '';
                company.style = 'border: 1px solid #000;';
            }
            if (trade.value != '') {
                trade_err.innerHTML = '';
                trade.style = 'border: 1px solid #000;';
            }
        }
        username.addEventListener('blur', eremove);
        eemail.addEventListener('blur', eremove);
        password.addEventListener('blur', eremove);
        password_confirmation.addEventListener('blur', eremove);
        phone.addEventListener('blur', eremove);
        company.addEventListener('blur', eremove);
        trade.addEventListener('blur', eremove);

    </script>
@endsection
