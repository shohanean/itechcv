@extends('backend.master')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card-box">
                        <h3>
                          Choose Your Interested Category
                        </h3>
                        <p class="text-muted">
                          You should choose 1 but not more than 3 categories
                        </p>
                        @if (session('not_select_error') || session('more_than_3_error'))
                          <div class="alert alert-danger">
                            {{ session('not_select_error') ?? session('more_than_3_error') }}
                          </div>
                        @endif
                        <form action="{{ route('subjectUpdate') }}" method="post">
                            @csrf
                            <div class="row">
                                @foreach($subjects as $subject)
                                <div class="col-sm-6 col-lg-6 col-xl-3">
                                    <div class="card-box mb-0 widget-chart-two text-center mb-2" id="slctID{{ $subject->id }}">
                                        <label for="subject_ami{{ $subject->id }}" style="width: 100%" >
                                            <input id="subject_ami{{ $subject->id }}" style="display: block; opacity: 0"
                                                   @isset($job->job_category)
                                                       @foreach(json_decode($job->job_category) as $value)
                                                       @if($value == $subject->id)
                                                       checked
                                                       @endif
                                                       @endforeach
                                                   @endisset
                                                   type="checkbox" name="subject_id[]" value="{{ $subject->id }}">
                                            <img width="50" src="{{ asset('images/icons').'/'.$subject->subject_icon }}" alt="{{ $subject->subject_name }}">
                                            <h4 id="txtcolor{{ $subject->id }}" class="no-m">{{ $subject->subject_name }}</h4>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center pb50">
                                <input type="submit" class="btn btn-success">
                                <a style="float: right; margin-right: 20px" class="btn btn-info" href="{{ route('dashboard') }}"><i class="fa fa-arrow-left"></i> Back to Home</a>
                            </div>
                        </form>
                        <!-- end row -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container -->

    </div>
@endsection

@section('footer_js')
    <script>
        @foreach ($subjects as $subject)
            if($("#subject_ami{{ $subject->id }}").attr('checked')){
                $('#slctID{{ $subject->id }}').css("background-color", "#30B19B");
                $('#txtcolor{{ $subject->id }}').css("color", "#fff");
            }
        $('#slctID{{ $subject->id }}').click(function(){
            let check = $("#subject_ami{{ $subject->id }}").is(":checked");

            if(check === true){
                $('#slctID{{ $subject->id }}').css("background-color", "#30B19B");
                $('#txtcolor{{ $subject->id }}').css("color", "#fff");
            }
            else{
                $('#slctID{{ $subject->id }}').css("background-color", "#fff");
                $('#txtcolor{{ $subject->id }}').css("color", "black");
            }
        });

        @endforeach

    </script>
@endsection
