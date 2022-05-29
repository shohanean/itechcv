<div class="col-12 mb-3">
  <ul class="nav nav-tabs tabs-bordered">
      <li class="nav-item">
          <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
              Search results <span class="badge badge-success ml-1">{{ count($final_search) }}</span>
          </a>
      </li>
  </ul>
</div>

@foreach ($final_search as $user_id => $rank)
  @php
    $user_information = App\User::find($user_id);
    $personal_information = App\PersonalInformation::where('user_id', $user_id)->first();
    $portfolio_information = App\Portfolio::where('user_id', $user_id)->take(3)->get();
    $portfolio_amount = App\Portfolio::where('user_id', $user_id)->count();
    $training_amount = App\Training::where('user_id', $user_id)->count();
    $job_experience_amount = App\JobExperience::where('user_id', $user_id)->count();
  @endphp
  <div class="col-lg-4">
    <div class="text-center card-box ribbon-box">
      <div class="ribbon ribbon-success">Matched: {{ $rank }}</div>
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

        <a href="{{ route('IndividualCV', $user_information->id) }}" target="_blank" type="button" class="btn btn-rounded btn-info mt-3 waves-effect width-md waves-light">
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
