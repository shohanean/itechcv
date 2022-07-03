@extends('backend.master')

@section('content')
    <div class="content">
      @if (Auth::user()->user_role == 3)
        <hr>
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 mt-3">
                @if (session('cv_send_sucess'))
                  <div class="alert alert-success">
                    {{ session('cv_send_sucess') }}
                  </div>
                @endif
                <form method="post" action="{{ route('AddToCVRequest') }}">
                  <input type="hidden" name="user_id" value="{{ $personal_info->user_id }}">
                  @csrf
                  <select class="custom-select" onchange="this.form.submit()" required name="cv_request_id">
                      <option value="">Send This CV To</option>
                      @foreach (App\CvRequest::all() as $cv_request)
                        <option class="{{ (App\CvRequestCandidate::where('user_id', $personal_info->user_id)->where('cv_request_id', $cv_request->id)->exists())?"text-success":"" }}" {{ (App\CvRequestCandidate::where('user_id', $personal_info->user_id)->where('cv_request_id', $cv_request->id)->exists())?"disabled":"" }} value="{{ $cv_request->id }}">CR - {{ $cv_request->id }} ({{ App\User::find($cv_request->user_id)->name ?? "N/A" }}){{ (App\CvRequestCandidate::where('user_id', $personal_info->user_id)->where('cv_request_id', $cv_request->id)->exists())?" - Already Sent":"" }}</option>
                      @endforeach
                  </select>
                </form>
              </div>
              <div class="col-md-6 mt-3">
                @if (session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                @endif
                <div class="text-center">
                    <a onclick="generatePDF()" class="btn btn-success waves-effect">
                        <i class="fa fa-download mr-1"></i> Download CV
                    </a>
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
                                          <input class="form-control" type="email" id="emailaddress1" value="{{ $personal_info->user->email }}" disabled>
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <div class="col-12">
                                          <label for="message1">Your Message</label>
                                          <input type="hidden" name="email" value="{{ $personal_info->user->email }}">
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
        </div>
      @endif
      <div class="container-fluid mt-3" id="download_this_part">

          <div class="row">
              <div class="col-sm-12">
                  <!-- meta -->
                  <div class="profile-user-box card-box bg-custom">
                      <div class="row">
                          <div class="col-sm-12">
                              <span class="pull-left mr-3"><img src="{{  $personal_info->user_profile != null ? asset('images/profile').'/'.$personal_info->user_profile :  url('assets/images/user-avatar.jpg') }}" alt="" class="thumb-lg rounded-circle"></span>
                              <div class="media-body text-white">
                                  <h4 class="mt-1 mb-1 font-18">{{ $personal_info->user->name ?? ""}}</h4>
                                  <p class="font-13 text-light"> {{ $personal_info->designation ?? '' }}</p>
                                  <p class="text-light mb-0">{{ $personal_info->present_address ?? '' }} {{ $personal_info->upazila->name ?? '' }} {{ $personal_info->district->name ?? ''}}</p>
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
                        @isset($Obj)
                            @if ($Obj->career_summary)
                                <h6>Career Summary</h6>
                                <p class="text-muted font-13">
                                    {{ $Obj->career_summary ?? '' }}
                                </p>
                            @endif
                            <h6>Career Objective</h6>
                            <p class="text-muted font-13">
                                {{ $Obj->job_objective ?? '' }}
                            </p>
                        @endisset
                        <hr>

                          <div class="text-left">
                              <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $personal_info->user->name ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Fathers Name :</strong> <span class="m-l-15">{{ $personal_info->father_name ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Mothers Name :</strong> <span class="m-l-15">{{ $personal_info->mother_name ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Date Of Birth :</strong> <span class="m-l-15">{{ $personal_info->dob ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Present Address :</strong> <span class="m-l-15">{{ $personal_info->present_address ?? ''}} {{ $personal_info->upazila->name ?? ''}} {{ $personal_info->district->name ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Permanent Address :</strong> <span class="m-l-15">{{ $personal_info->permanent_address ?? ''}} {{ $personal_info->pupazila->name ?? ''}} {{ $personal_info->pdistrict->name ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">{{ $personal_info->phone ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $auth->email ?? ''}}</span></p>
                              <p class="text-muted font-13"><strong>Interested Location :</strong>
                                  <span class="m-l-15">
                                            <?php
                                                $jony = json_decode($personal_info->interested_location);
                                             ?>
                                          @isset($jony)
                                              @foreach(json_decode($personal_info->interested_location) as $locate)
                                                  {{ App\District::findOrFail($locate)->name ?? ""}} @if (!$loop->last),@endif
                                              @endforeach
                                          @else
                                           N/A
                                          @endisset

                                  </span>
                              </p>
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
                                      <div class="progress-bar" role="progressbar" style="width: {{ $jskill->progress }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ $jskill->progress ?? '' }}%</div>
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
                                          <img src="{{ asset('images/marketplace/'.'/'.$marketplace->marketplace_icon) ?? '' }}" alt="Marketplace">
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
                                  <p class="text-capitalize"><b>{{ $job_experience->job_from ?? '' }}-{{ $job_experience->job_to ?? ''}}</b></p>

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
                                  <th>Institute</th>
                                  <th>Title</th>
                                  <th>Board Name</th>
                                  <th>Passing Year</th>
                                  <th>Results</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($educations as $education)
                                  <tr>
                                      <td>{{ $loop->index +1 ?? ''}}</td>
                                      <td>{{ $education->degree->degree_name ?? ''}}</td>
                                      <td>{{ $education->institute ?? '' }}</td>
                                      <td>{{ $education->degreeTitle->degree_title ?? ''}}</td>
                                      <td>{{ $education->board->board_name ?? ''}}</td>
                                      <td>{{ $education->passing_year ?? ''}}</td>
                                      <td>{{ $education->result_point ?? '' }}</td>

                                  </tr>
                              @endforeach

                              </tbody>
                          </table>
                      </div>
                  </div>

                  <div class="card-box">
                      <h4 class="header-title mb-3">Trainings</h4>

                      <div class="table-responsive">
                          <table class="table m-b-0">
                              <thead>
                              <tr>
                                  <th>SL</th>
                                  <th>Training Title</th>
                                  <th>Country</th>
                                  <th>Training Institute</th>
                                  <th>Year</th>
                                  <th>Duration</th>
                                  <th>Topic Covered</th>
                              </tr>
                              </thead>
                              <tbody>
                                @foreach($trainings as $training)
                                    <tr>
                                        <td>{{ $loop->index +1 ?? ''}}</td>
                                        <td>{{ $training->training_name ?? '' }}</td>
                                        <td>{{ $training->country->name ?? '' }}</td>
                                        <td>{{ $training->training_institute ?? '' }}</td>
                                        <td>{{ $training->training_year ?? '' }}</td>
                                        <td>{{ $training->training_duration ?? '' }}</td>
                                        <td>{{ $training->topic_cover ?? '' }}</td>
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
                                      <td>{{ $loop->index +1 }}</td>
                                      <td><i class="{{ $portfolio->portfolio_icon }}"></i></td>
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
      </div> <!-- container -->
    </div>
@endsection
@section('footer_js')
  <script src="{{ url('/') }}/assets/js/html2pdf.bundle.min.js"></script>

  <script>
    function generatePDF() {
      const element = document.getElementById("download_this_part");
      // Choose the element and save the PDF for our user.
      var opt = {
          filename:     '{{ $auth->name  ?? ''}} - {{ \Carbon\Carbon::now()->format('d_m_Y') }}.pdf'
      };
      html2pdf()
        .set(opt)
        .from(element)
        .save();
    }
  </script>
@endsection
