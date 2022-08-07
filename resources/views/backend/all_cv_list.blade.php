@extends('backend.master')

@section('header_css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid" style="padding-left: 0!important; padding-right: 0!important;">
            <div class="row">
              <div class="col-12">
                <div class="card-box">
                  <h4 class="header-title">
                    <i class="fa fa-search"></i>
                    Search
                  </h4>
                    <form action="" method="GET">
                        <div class="row">
                            <input class="col-4 form-control" type="text" name="p_n" placeholder="Search by Phone Number" value="@isset($_GET['p_n']){{$_GET['p_n']}}@endisset">
                            <input disabled class="col-4 form-control" type="text" name="e_a" placeholder="Search by Email Address">
                            <div class="col-4">
                            <button type="submit" class="btn btn-success form-control">Search Now</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h4 class="header-title">All Resume</h4>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>SL</th>
                              <th>Seeker Name</th>
                              <th>Skills</th>
                              <th >Location</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($allcvs as $key => $allcv)
                                <tr>
                                    <td class="text-center"><b>{{ $allcvs->firstItem() + $key }}</b></td>
                                    <td>
                                        <a href="javascript: void(0);" class="text-body">
                                            <img src="{{ $allcv->user_profile != null ? asset('images/profile/'.$allcv->user_profile) : asset('images/profile/default-avatar.png') }}" alt="{{ $allcv->user->name }}"
                                                 title="contact-img" class="rounded-circle avatar-sm" width="40">
                                            <span class="ml-2">{{ $allcv->user->name }}</span>
                                        </a>
                                    </td>

                                    <td class="sorting_1">
                                        @foreach(App\JobSkill::where('user_id', $allcv->user_id)->limit(4)->get() as $keys =>$skills)
                                            <span class="text-uppercase">
                                            {{ $skills->skill->skill_name }}@if (!$loop->last),@endif
                                        </span>
                                        @endforeach
                                    </td>

                                    <td class="text-center">
                                        @isset($allcv->district_id)
                                            <span class="badge badge-success">{{ $allcv->district->name }}</span>
                                        @else
                                            <span class="badge badge-danger">Not Yet</span>
                                        @endisset
                                    </td>

                                    <td>
                                        @isset($allcv->phone)
                                            <span class="badge badge-success">{{ $allcv->phone }}</span>
                                        @else
                                            <span class="badge badge-danger">Not Yet</span>
                                        @endisset
                                    </td>
                                    <td>
                                        <span class="badge badge-success">{{ $allcv->user->email }}</span>
                                    </td>

                                    <td class="text-center">
                                        <a class="btn btn-outline-purple" target="_blank" href="{{ route('IndividualCV', $allcv->user_id) }}">View</a>
                                    </td>
                                </tr>
                            @endforeach
                          </tbody>
                        </table>
                        <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
                                        {{ $allcvs->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end container-fluid -->
    </div>
@endsection

@section('footer_js')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
@endsection
