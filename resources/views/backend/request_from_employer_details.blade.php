@extends('backend.master')

@section('content')
<div class="content">
  <div class="container-fluid">
    <hr>
    <div class="row">
      <div class="col-md-12 mb-3">
        @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
        @endif
        <div class="text-center">
            <a type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#login-modal">
              Send Mail
              <i class="fa fa-envelope mr-1"></i>
            </a>
        </div>
        {{-- Email Modal Start --}}
        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="mySmallModalLabel">Send a mail</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form class="form-horizontal" action="{{ route('MailJobSeeker') }}" method="post">
                        @csrf
                          <div class="form-group">
                              <div class="col-12">
                                  <label for="emailaddress1">Email address</label>
                                  <input class="form-control" type="email" id="emailaddress1" value="{{ App\User::find($cvrequestinfo->user_id)->email }}" disabled>
                              </div>
                          </div>

                          <div class="form-group">
                              <div class="col-12">
                                  <label for="message1">Your Message</label>
                                  <input type="hidden" name="email" value="{{ App\User::find($cvrequestinfo->user_id)->email }}">
                                  <textarea class="form-control" id="message1" name="message" rows="6" required="" placeholder="Enter your message here"></textarea>
                              </div>
                          </div>

                          <div class="form-group account-btn text-center mt-2">
                              <div class="col-12">
                                  <button class="btn width-lg btn-rounded btn-primary waves-effect waves-light" type="submit">Send</button>
                              </div>
                          </div>

                      </form>

                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        {{-- Email Modal end --}}
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card-box">
          <div class="row">
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Sent By</h4>
              <h5>Name: {{ App\User::find($cvrequestinfo->user_id)->name }}</h5>
              <h6>Company: {{$company->company_name ?? 'N/A'}}</h6>
              <h6>Phone: {{$company->phone ?? "N/A"}}</h6>
              <p class="text-muted m-b-20 font-14">
                Email: {{ App\User::find($cvrequestinfo->user_id)->email }}
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Skill</h4>
              <p class="text-muted m-b-20 font-14">
                @if ($cvrequestinfo->skill_id == 'null')
                  <span class="badge badge-danger">No Skill Requested</span>
                @else
                  @foreach (json_decode($cvrequestinfo->skill_id) as $skill)
                    <span class="badge badge-info">{{ App\Skill::find($skill)->skill_name }}</span>
                  @endforeach
                @endif
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Category</h4>
              <p class="text-muted m-b-20 font-14">
                <span class="badge badge-success">{{ App\Subject::find($cvrequestinfo->category_id)->subject_name }}</span>
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Location</h4>
              <p class="text-muted m-b-20 font-14">
                {{ App\District::find($cvrequestinfo->location_id)->name }}
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Education</h4>
              <p class="text-muted m-b-20 font-14">
                {{ App\DegreeTitle::find($cvrequestinfo->education_id)->degree_title }}
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Job Experience</h4>
              <p class="text-muted m-b-20 font-14">
                @if ($cvrequestinfo->job_experience == 1)
                  <span class="badge badge-success">Yes</span>
                @else
                  <span class="badge badge-danger">No</span>
                @endif
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Portfolio</h4>
              <p class="text-muted m-b-20 font-14">
                @if ($cvrequestinfo->portfolio == 1)
                  <span class="badge badge-success">Yes</span>
                @else
                  <span class="badge badge-danger">No</span>
                @endif
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Training</h4>
              <p class="text-muted m-b-20 font-14">
                @if ($cvrequestinfo->training == 1)
                  <span class="badge badge-success">Yes</span>
                @else
                  <span class="badge badge-danger">No</span>
                @endif
              </p>
            </div>
            <div class="col-sm-4">
              <h4 class="header-title m-t-0">Note</h4>
              <p class="text-muted m-b-20 font-14">
                {{ $cvrequestinfo->note ?? "---"}}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 mb-3">
        <ul class="nav nav-tabs tabs-bordered">
            <li class="nav-item mr-2">
                <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    Total CV Sent <span class="badge badge-success ml-1">{{ $cvrequestcandidates->count() }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    Wanted CV <span class="badge badge-info ml-1">{{ $cvrequestinfo->expected_cv ?? "N/A" }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    Vacancy <span class="badge badge-warning ml-1">{{ $cvrequestinfo->vacancy ?? "N/A" }}</span>
                </a>
            </li>
        </ul>
      </div>
      @if ($cvrequestcandidates->count() == 0)
      <div class="col-12 mb-3">
        <div class="alert alert-danger bg-danger text-white border-0" role="alert">
          <h4 class="text-center">No CV Added Yet!</h4>
        </div>
      </div>
      @endif
      @foreach ($cvrequestcandidates as $cvrequestcandidate)
        @php
          $user_information = App\User::find($cvrequestcandidate->user_id);
          $personal_information = App\PersonalInformation::where('user_id', $cvrequestcandidate->user_id)->first();
          $portfolio_information = App\Portfolio::where('user_id', $cvrequestcandidate->user_id)->take(3)->get();
          $portfolio_amount = App\Portfolio::where('user_id', $cvrequestcandidate->user_id)->count();
          $training_amount = App\Training::where('user_id', $cvrequestcandidate->user_id)->count();
          $job_experience_amount = App\JobExperience::where('user_id', $cvrequestcandidate->user_id)->count();
        @endphp
        <div class="col-lg-4">
          <div class="text-center card-box ribbon-box">
            @if ($personal_information->job_status == 1)
              <div class="ribbon ribbon-success">Available</div>
            @elseif ($personal_information->job_status == 2)
              <div class="ribbon ribbon-danger">Not Now</div>
            @elseif ($personal_information->job_status == 3)
              <div class="ribbon ribbon-purple">In Job</div>
            @else
              <div class="ribbon ribbon-info">!</div>
            @endif
            <div class="member-card">
              <div class="thumb-lg member-thumb mx-auto">
                <img src="{{ asset('images/profile') }}/{{ $personal_information->user_profile ?? 'default-avatar.png' }}" class="rounded-circle avatar-xl img-thumbnail" alt="profile-image">
              </div>

              <div class="">
                <h4>{{ $user_information->name }}</h4>
                <p class="text-muted">
                   <span> <a href="mailto:{{ $user_information->email }}" class="text-pink">{{ $user_information->email }}</a> </span>
                 </p>
              </div>

              <ul class="social-links list-inline">
                @forelse ($portfolio_information as $portfolio_info)
                  @php
                    $ae = explode('-', $portfolio_info->portfolio_icon);
                  @endphp
                  <li class="list-inline-item">
                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" target="_blank" href="//{{ $portfolio_info->portfolio_link }}" data-original-title="{{ studly_case(last($ae)) }}"><i class="{{ $portfolio_info->portfolio_icon }}"></i></a>
                  </li>
                @empty
                  <li class="list-inline-item">
                    <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" data-original-title="No Portfolio Links Yet"><i class="fas fa-times"></i></a>
                  </li>
                @endforelse
              </ul>

              <a href="{{ route('IndividualCV', $cvrequestcandidate->user_id) }}" target="_blank" type="button" class="btn btn-rounded btn-info mt-3 waves-effect width-md waves-light">
                <i class="fa fa-eye mr-1"></i>
                View CV
              </a>
              <div class="mt-3">
                <div class="row">
                  <div class="col-4">
                    <div class="mt-3">
                      <h4>{{ $portfolio_amount }}</h4>
                      <p class="mb-0 text-muted">Portfolio</p>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mt-3">
                      <h4>{{ $training_amount }}</h4>
                      <p class="mb-0 text-muted">Training</p>
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="mt-3">
                      <h4>{{ $job_experience_amount }}</h4>
                      <p class="mb-0 text-muted">Experience</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
