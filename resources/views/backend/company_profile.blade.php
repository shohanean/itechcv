@extends('backend.master')
@section('header_css')
    <link href="{{ asset('assets/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('/') }}/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/datepicker.css') }}" rel="stylesheet" type="text/css"/>
     <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice{
            color: black!important;
        }
        .select2-results__message{
            color: red!important;
        }
    </style>
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-box task-detail">
                        <div class="media mt-0 m-b-30">
                            <img class="d-flex mr-3 rounded-circle" alt="64x64"
                                 src="@isset($company->company_logo){{ asset('images/company-profile/'. $company->company_logo)}} @else {{ asset('images/company-profile/default-avatar.png')}}@endisset"
                                 style="width: 60px; height: 60px;">
                            <div class="media-body">
                                <h5 class="media-heading mb-0 mt-0">{{ $company->company_name ?? ""}}</h5>
                                <p class="mb-1"><strong>Company
                                        Address:- </strong> {{ $company->company_address ?? '' }} {{ $company->upazila->name ?? "N/A"}}, {{ $company->district->name ?? "N/A"}}, {{ $company->country->name ?? "N/A"}}</p>
                                <strong>Company Founded:- </strong> {{ $company->company_founded ?? '' }}
                            </div>
                            <button type="button" class="btn btn-success waves-effect waves-light float-right" data-toggle="modal"
                                    data-target="#Company-modal">Update
                            </button>
                        </div>


                        <p class="text-muted">
                            {{ $company->company_description ?? "" }}
                        </p>
                        <div class="task-tags mt-4">
                            <h4 class="d-inline-block">Company Industry:-</h4>
                            <button type="button" class="btn btn-success waves-effect waves-light float-right" data-toggle="modal"
                                    data-target="#Industry-modal">Update
                            </button>
                            <hr>
                            <div class="bootstrap-tagsinput">
                                @foreach(json_decode($company->industry_id) as $industry)
                                    <span class="tag label label-info">
                                    {{ App\CompanyIndustry::findOrFail($industry)->industry_name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="task-dates mt-4">
                            <h4 class="d-inline-block">Contact Person:-</h4>
                            <button type="button" class="btn btn-success waves-effect waves-light float-right"
                                    data-toggle="modal" data-target="#Contact-modal">Update
                            </button>
                            <hr>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Company Trade License</h5>
                                        <p class="text-truncate"><small
                                                class="text-muted">{{ $company->company_trade_license ?? "N/A" }}</small>
                                        </p>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <h5>Contact Person</h5>
                                        <p class="text-truncate"><small
                                                class="text-muted">{{ $company->contact_person ?? "N/A" }}</small></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Person Designation</h5>
                                        <p class="text-truncate"><small
                                                class="text-muted">{{ $company->contact_person_designation ?? "N/A" }}</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Person Email</h5>
                                        <p class="text-truncate"><small
                                                class="text-muted">{{ $company->contact_person_email ?? "N/A" }}</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div>
                                        <h5>Person Phone</h5>
                                        <p class="text-truncate"><small
                                                class="text-muted">{{ $company->contact_person_phone ?? "N/A" }}</small>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div><!-- end col -->
            </div>
            <!-- end row -->
            <!-- Company modal content -->
            <div id="Company-modal" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="custom-width-modalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="text-capitalize text-center m-b-10">
                                Company Information
                            </h4>
                            <hr>
                            <form class="form-horizontal" action="{{ route('CompanyUpdate') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-12 text-center mb-2">
                                    <img id="blah" class="rounded-circle" alt="64x64" src="@isset($company->company_logo){{ asset('images/company-profile/'. $company->company_logo)}} @else {{ asset('images/company-profile/default-avatar.png')}}@endisset" style="width: 80px; height: 80px;">
                                    <input type="file" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" name="company_logo" class="filestyle" data-input="false" data-btnclass="btn-custom" id="filestyle-1" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
                                    <div class="bootstrap-filestyle"><div name="filedrag" style="position: absolute; width: 100%; height: 38px; z-index: -1;"></div><span class="group-span-filestyle " tabindex="0"><label for="filestyle-1" style="margin-bottom: 0;" class="btn btn-custom "><span class="buttonText">Choose file</span></label></span></div>

                                </div>
                            </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="company_name">Company Name</label>
                                        <input class="form-control" value="{{ $company->company_name ?? old('company_name') }}" type="text" name="company_name" id="company_name" placeholder="BBC Software Ltd">
                                    </div>
                                    <div class="col-6">
                                        <label for="company_address">Company Address</label>
                                        <input class="form-control" value="{{ $company->company_address ?? old('company_address') }}" type="text" name="company_address" id="company_address" placeholder="5/A West Dhanmondi">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="country_id">Country</label>
                                        <select id="country_id"  name="country_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach ($countries as $country)
                                                <option @if($company->country_id ?? '1' == $country->id) selected @endif value="{{ $country->id }}">{{ $country->name ?? "" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="district_id">District</label>
                                        <select id="district_id"  name="district_id" class="form-control">
                                            <option value="">Select One</option>
                                            @foreach ($districts as $district)
                                                <option @if($company->district_id == $district->id) selected @endif value="{{ $district->id }}">{{ $district->name ?? "" }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <label for="upazila_id">Upazila {{ $company->upazila->name }}</label>
                                        <select id="upazila_id" class="form-control" name="upazila_id">
                                            <option @isset($company->upazila_id) selected @endisset value="{{ $company->upazila_id ??"" }}">{{ $company->upazila->name ?? ""}}</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="company_founded">Company Founded</label>
                                        <input class="form-control" value="{{ $company->company_founded ?? old('company_founded') }}" type="text" name="company_founded" id="company_founded" placeholder="Ex: 2010">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-12">
                                        <label for="company_description">Company Overview</label>
                                        <textarea class="form-control" type="text" name="company_description" id="company_description" placeholder="Ex: BBC Software Ltd is the most Popular ...">{{ $company->company_description ?? old('company_description') }}</textarea>
                                    </div>
                                </div>
                                <div class="row account-btn text-center mt-3">
                                    <div class="col-12">
                                        <button class="btn w-lg btn-rounded btn-primary waves-effect waves-light"
                                                type="submit">Update
                                        </button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Company Industry content -->
            <div id="Industry-modal" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="text-capitalize text-center m-b-10">
                                Company Industry
                            </h4>
                            <hr>
                            <form class="form-horizontal" action="{{ route('IndustryUpdate') }}" method="post">
                                @csrf
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="industry_id">Company Industry</label>
                                        <select id="industry_id"  name="industry_id[]" multiple class="form-control">
                                            @foreach ($industries as $industry)
                                                <option
                                                    @isset($company->industry_id)
                                                    @foreach(json_decode($company->industry_id) as $val)
                                                    @if(json_decode($val) == $industry->id) selected @endif
                                                    @endforeach
                                                    @endisset
                                                    value="{{ $industry->id }}">{{ $industry->industry_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light"
                                                type="submit">Update
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <!-- Contact Person modal content -->
            <div id="Contact-modal" class="modal fade" tabindex="-1" role="dialog"
                 aria-labelledby="custom-width-modalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h4 class="text-capitalize text-center m-b-10">
                                Contact Person
                            </h4>
                            <hr>
                            <form class="form-horizontal" action="{{ route('ContactUpdate') }}" method="post">
                                @csrf
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="company_trade_license">Company Trade License</label>
                                        <input class="form-control" name="company_trade_license" value="{{ $company->company_trade_license ?? old('company_trade_license') }}" type="text" id="company_trade_license"
                                               placeholder="Ex: 05254789">
                                    </div>
                                </div>
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="contact_person">Contact Person Name</label>
                                        <input class="form-control"  name="contact_person" value="{{ $company->contact_person ?? old('contact_person') }}" type="text" id="contact_person"
                                               placeholder="Ex: Md Hasan">
                                    </div>
                                </div>
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="contact_person_designation">Contact Person Designation</label>
                                        <input class="form-control" name="contact_person_designation" value="{{ $company->contact_person_designation ?? old('contact_person_designation') }}" type="text" id="contact_person_designation"
                                               placeholder="Ex: HRM">
                                    </div>
                                </div>
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="contact_person_email">Contact Person Email</label>
                                        <input class="form-control" name="contact_person_email" value="{{ $company->contact_person_email ?? old('contact_person_email') }}" type="text" id="contact_person_email"
                                               placeholder="Ex: bbc@software.com">
                                    </div>
                                </div>
                                <div class="form-group m-b-25">
                                    <div class="col-12">
                                        <label for="contact_person_phone">Contact Person Phone</label>
                                        <input class="form-control" name="contact_person_phone" value="{{ $company->contact_person_phone ?? old('contact_person_phone') }}" type="text" id="contact_person_phone"
                                               placeholder="Ex: 012354789">
                                    </div>
                                </div>

                                <div class="form-group account-btn text-center m-t-10">
                                    <div class="col-12">
                                        <button class="btn w-lg btn-rounded btn-custom waves-effect waves-light"
                                                type="submit">Update
                                        </button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div>
    </div> <!-- container -->
@endsection
@section('footer_js')
    <script src="{{ url('/') }}/assets/plugins/select2/js/select2.min.js"></script>
    <script src="{{ asset('assets/plugins/custombox/js/custombox.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/custombox/js/legacy.min.js') }}"></script>
    <script>
        $("#industry_id").select2();
        $('#district_id').change(function(){
            var district_id = $(this).val();

            if(district_id){
                $.ajax({
                    type:"GET",
                    url:"{{url('company/api/get-upazila-list')}}/"+district_id,
                    success:function(res){
                        if(res){
                            $("#upazila_id").empty();
                            $("#upazila_id").append('<option>Select</option>');
                            $.each(res,function(key,value){

                                $("#upazila_id").append('<option value="'+ value.id +'">'+ value.name +'</option>');
                            });

                        }else{
                            $("#upazila_id").empty();
                        }
                    }
                });
            }else{
                $("#upazila_id").empty();

            }
        });
    </script>
@endsection
