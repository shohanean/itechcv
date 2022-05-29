@extends('backend.master')

@section('content')
<div class="content">
  <!-- Start Content-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 pl-0 pr-0">
        <div class="card-box">
          @if (Auth::user()->user_role == 2)
            <h4 class="header-title">
              CV Requested By You
            </h4>
            <p class="sub-header">
              Here is a list of CV Request By You
            </p>
          @else
            <h4 class="header-title">
              CV Requested From Employer
            </h4>
            <p class="sub-header">
              Here is a list of CV Request from various employer
            </p>
          @endif

          <div class="table-responsive">
            <table class="table table-bordered mb-0">
              <thead class="thead-light">
                <tr>
                  <th>Request ID</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Job Location</th>
                  <th>CV Wanted</th>
                  <th>Vacancy</th>
                  <th>Approx. Salary</th>
                  <th>Request Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cvrequests as $cvr)
                <tr>
                  <td>CR - {{ $cvr->id }}</td>
                  <td>{{ $cvr->user->name ?? "N/A"}}</td>
                  <td>{{ $cvr->category->subject_name ?? "N/A"}}</td>
                  <td>{{ $cvr->district->name ?? "N/A"}}</td>
                  <td>{{ $cvr->expected_cv ?? "N/A"}}</td>
                  <td>{{ $cvr->vacancy ?? "N/A"}}</td>
                  <td>{{ $cvr->expected_salary ?? "N/A"}}</td>
                  <td>{{ $cvr->created_at ?? "N/A"}}</td>
                  <td>
                    <a href="{{ route('employerRequestedDetails', $cvr->id) }}" class="btn btn-success"><i class="fas fa-receipt"></i> Details</a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
