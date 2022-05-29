@extends('backend.master')

@section('header_css')
    <link href="{{ url('/') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="search-result-box card-box">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pt-3 pb-4">
                                    <form action="{{ route('SearchResult') }}">
                                        <div class="input-group">
                                            <div class="col-md-3">
                                                <select class="form-control select2" name="skill[]" id="skill" multiple>
                                                    @foreach($skills as $skill)
                                                        <option
                                                            value="{{ $skill->id }}">{{ $skill->skill_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2" name="category"
                                                        id="category_id">
                                                    @foreach($subjects as $subject)
                                                        <option
                                                            value="{{ $subject->id }}">{{ $subject->subject_name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select class="form-control select2" name="upazila" id="upazila_id">
                                                    @foreach($districts as $district)
                                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="input-group-append">
                                                    <button type="submit"
                                                            class="btn waves-effect waves-light btn-primary"><i
                                                            class="fa fa-search mr-1"></i> Search
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mt-4 text-center">
                                    <h4>Search Results For "Web Design"</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                        <ul class="nav nav-tabs tabs-bordered">
                            <li class="nav-item">
                                <a href="#home" data-toggle="tab" aria-expanded="true" class="nav-link active">
                                    All results <span class="badge badge-success ml-1">25</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane show active" id="home">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="search-item">
                                            <h4 class="mb-1"><a href="#">Zircos - Responsive Admin Template</a></h4>
                                            <div class="font-13 text-success mb-3">
                                                http://coderthemes.com/zircos/index.html
                                            </div>
                                            <p class="mb-0 text-muted">
                                                Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare
                                                laoreet adipiscing luctus mauris adipiscing pretium eget fermentum,
                                                tristique lobortis est ut metus lobortis tortor tincidunt himenaeos
                                                habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                                vestibulum quis in sit varius lorem sit metus mi.
                                            </p>
                                        </div>

                                        <ul class="pagination justify-content-end pagination-split mt-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item active"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <div class="clearfix"></div>
                                    </div>
                                </div>

                            </div>
                            <!-- end All results tab -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->


        </div> <!-- end container-fluid -->

    </div>
@endsection

@section('footer_js')
    <script src="{{ url('/') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#category_id, #upazila_id, #skill').select2();
        })

    </script>
@endsection
