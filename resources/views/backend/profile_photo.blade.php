@extends('backend.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="m-t-0 header-title">Change Profile Photo</h4>
                        <hr>

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('ProfileImagePost') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pp" class="col-form-label">Profile Photo <span class="text-danger">*</span></label>
                                    <input type="file" name="pp" class="form-control @error('pp') is-invalid @enderror" id="pp" onchange="document.getElementById('usrprofile').src = window.URL.createObjectURL(this.files[0])">
                                    @error('pp')
                                    <span class="invalid-feedback text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="usrprofile" class="col-form-label">Preview Photo</label>
                                    <img style="border-radius: 50%" id="usrprofile" width="150" height="150" class="usrprofile" src="@isset($personal_info->user_profile){{ asset('images/profile/'. $personal_info->user_profile)}} @else {{ asset('assets/images/user-avatar.jpg')}}@endisset " alt="Image">
                                </div>

                            </div>

                            <ul class="pager wizard wizardlist">
                                <li class="next text-center">
                                    <button type="submit" class="btn btn-success">Update Image</button>
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

