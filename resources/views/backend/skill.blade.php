@extends('backend.master')

@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-box">
                        <h4 class="header-title">All Skills</h4>
                        @if(session('delete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>{{ session('delete') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('update'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('update') }}</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th>Skill Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($skills as $key => $skill)
                                <tr>
                                    <td>{{ $skills->firstItem() + $key }}</td>
                                    <td class="text-uppercase">{{ $skill->skill_name }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary skillID" data-value="{{ $skill->skill_name }}" data-id="{{ $skill->id }}" data-toggle="modal" data-target="#SkillEdit">
                                            Edit
                                        </button>
                                        <a class="btn btn-danger" href="{{ route('SkillDelete', $skill->id) }}">Delete</a>
                                    </td>
                                </tr>
                                 @endforeach
                                </tbody>
                            </table>
                            {{ $skills->links() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-box">
                        <h4 class="header-title mb-4">Add Skill</h4>
                        <form class="form-horizontal" role="form" action="{{ route('SkillPost') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="skill_name">Skill Name</label>
                                <input type="text" class="form-control @error('skill_name') is-invalid @enderror" name="skill_name" id="skill_name" aria-describedby="emailHelp" placeholder="Ex: Laravel">
                                @error('skill_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end container-fluid -->
    </div>

{{--    Modal--}}
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="SkillEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{ route('SkillUpdate') }}" method="post">
                        @csrf
                        <input type="hidden" class="skill_value" name="skill_id">
                        <div class="form-group">
                            <label for="skill_name">Skill Name</label>
                            <input type="text" class="form-control @error('skill_name') is-invalid @enderror skill_name" name="skill_name" id="skill_name" aria-describedby="emailHelp" placeholder="Ex: Laravel">
                            @error('skill_name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_js')
    <script>
        $(document).ready(function () {
            $('.skillID').click(function () {
                var skill_id = $(this).data("id");
                var s_name = $(this).data("value");

                $('.skill_value').val(skill_id);
                $('.skill_name').val(s_name);
            })
        })
    </script>
@endsection
