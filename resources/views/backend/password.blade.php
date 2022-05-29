@extends('backend.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title ">Change Password</h4>
                        <hr>
                        @if (session('danger2'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('danger2') }}
                            </div>
                        @endif
                        @if (session('danger'))
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('danger') }}
                            </div>
                        @endif
                        @if (session('message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('message') }}
                            </div>
                        @endif

                        <form action="{{ route('PasswordUpdate') }}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="old_password" class="col-form-label">Old Password <span class="text-danger">*</span></label>
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="old_password"
                                           placeholder="Enter Old Password">
                                    @error('old_password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password" class="col-form-label">New Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                           placeholder="Enter New Password">
                                    @error('password')
                                    <span class="invalid-feedback text-danger" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="password_confirmation" class="col-form-label">Repeat Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                                           placeholder="Enter Confirm Password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback text-danger" role="alert">
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
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div>
@endsection
