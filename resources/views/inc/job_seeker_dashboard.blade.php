<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h1 class="text-center">Welcome To iTechCV</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">
                        <h4 class="header-title">
                            Check List
                        </h4>
                        <p class="sub-header">
                            @auth
                                @php
                                    $personal = App\PersonalInformation::where('user_id', Auth::id())->first()->user_profile;
                                    $edu = App\Education::where('user_id', Auth::id())->count();
                                    $train = App\Training::where('user_id', Auth::id())->count();
                                    $cobj = App\CareerObjective::where('user_id', Auth::id())->count();
                                    $jskill = App\JobSkill::where('user_id', Auth::id())->count();
                                    $ex = App\JobExperience::where('user_id', Auth::id())->count();
                                    $port = App\Portfolio::where('user_id', Auth::id())->count();
                                    $market = App\Marketplace::where('user_id', Auth::id())->count();

                                    $profile_photo = $personal != null ? 10 : 0;
                                    $education = $edu > 0 ? 10 : 0;
                                    $training = $train > 0 ? 15 : 0;
                                    $careerObjective = $cobj > 0 ? 10 : 0;
                                    $jobSkill = $jskill > 0 ? 10 : 0;
                                    $jobExperience = $ex > 0 ? 10 : 0;
                                    $portfolio = $port > 0 ? 15 : 0;
                                    $marketplace = $market > 0 ? 10 : 0;

                                    $auto = 10 + $education + $training + $careerObjective +$jobSkill + $jobExperience + $portfolio + $marketplace + $profile_photo;
                                @endphp
                                Your cv completion is {{ $auto }}%
                            @endauth
                        </p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                 style="width: {{ $auto }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <ul class="list-unstyled transaction-list slimscroll mb-0">
                    @if (App\PersonalInformation::where('user_id', Auth::id())->first()->user_profile == null)
                        <li>
                            <i class="dripicons-arrow-up text-success"></i>
                            <span class="text-capitalize marginleft-25">Add Photo for +10</span>
                            <span class="float-right text-success tran-price">+10</span>
                            <span class="float-right text-muted">
                                <a href="{{ route('ProfilePhoto') }}">Click Here</a>
                            </span>
                            <span class="clearfix"></span>
                        </li>
                    @endif
                    @if (!App\Education::where('user_id', Auth::id())->exists())
                        <li>
                            <i class="dripicons-arrow-up text-success"></i>
                            <span class="text-capitalize marginleft-25">Add Education for +10</span>
                            <span class="float-right text-success tran-price">+10</span>
                            <span class="float-right text-muted">
                                <a href="{{ route('CVUpdateForm').'#eduinfo' }}">Click Here</a>
                            </span>
                            <span class="clearfix"></span>
                        </li>
                    @endif
                    @if (!App\Training::where('user_id', Auth::id())->exists())
                        <li>
                            <i class="dripicons-arrow-up text-success"></i>
                            <span class="text-capitalize marginleft-25">Add Training for +15</span>
                            <span class="float-right text-success tran-price">+15</span>
                            <span class="float-right text-muted">
                                <a href="{{ route('CVUpdateForm').'#trainingInfos' }}">Click Here</a>
                            </span>
                            <span class="clearfix"></span>
                        </li>
                    @endif
                    @if (!App\CareerObjective::where('user_id', Auth::id())->exists())
                        <li>
                            <i class="dripicons-arrow-up text-success"></i>
                            <span class="text-capitalize marginleft-25">Add Career Objective for +10</span>
                            <span class="float-right text-success tran-price">+10</span>
                            <span class="float-right text-muted">
                                 <a href="{{ route('CVUpdateForm').'#careerInfos' }}">Click Here</a>
                            </span>
                            <span class="clearfix"></span>
                        </li>
                    @endif
                    @if (!App\JobSkill::where('user_id', Auth::id())->exists())
                         <li>
                             <i class="dripicons-arrow-up text-success"></i>
                             <span class="text-capitalize marginleft-25">Add Skill for +10</span>
                             <span class="float-right text-success tran-price">+10</span>
                             <span class="float-right text-muted">
                                  <a href="{{ route('CVUpdateForm').'#skillinfo' }}">Click Here</a>
                             </span>
                             <span class="clearfix"></span>
                         </li>
                    @endif
                    @if (!App\JobExperience::where('user_id', Auth::id())->exists())
                         <li>
                             <i class="dripicons-arrow-up text-success"></i>
                             <span class="text-capitalize marginleft-25">Add Job Experience for +10</span>
                             <span class="float-right text-success tran-price">+10</span>
                             <span class="float-right text-muted">
                                 <a href="{{ route('CVUpdateForm').'#experienceInfo' }}">Click Here</a>
                             </span>
                             <span class="clearfix"></span>
                         </li>
                    @endif
                    @if (!App\Portfolio::where('user_id', Auth::id())->exists())
                         <li>
                             <i class="dripicons-arrow-up text-success"></i>
                             <span class="text-capitalize marginleft-25">Add Portfolio for +15</span>
                             <span class="float-right text-success tran-price">+15</span>
                             <span class="float-right text-muted">
                                 <a href="{{ route('CVUpdateForm').'#portfolios' }}">Click Here</a>
                             </span>
                             <span class="clearfix"></span>
                         </li>
                    @endif
                    @if (!App\Marketplace::where('user_id', Auth::id())->exists())
                         <li>
                             <i class="dripicons-arrow-up text-success"></i>
                             <span class="text-capitalize marginleft-25">Add Marketplace for +10</span>
                             <span class="float-right text-success tran-price">+10</span>
                             <span class="float-right text-muted">
                                 <a href="{{ route('CVUpdateForm').'#marketplace' }}">Click Here</a>
                             </span>
                             <span class="clearfix"></span>
                         </li>
                    @endif
                </ul>
            </div>
        </div>

    </div>
</div>
