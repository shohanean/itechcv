@extends('backend.master')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row text-center">
      <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-custom bg-custom text-white">
          <i class="fa fa-list"></i>
          <h3 class="m-b-10">{{ $ctotal ?? ''}}</h3>
          <p class="text-uppercase m-b-5 font-13 font-600">Job Category</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box bg-primary widget-flat border-primary text-white">
          <i class="fa fa-puzzle-piece"></i>
          <h3 class="m-b-10">{{ $stotal ?? ''}}</h3>
          <p class="text-uppercase m-b-5 font-13 font-600">Skill</p>
        </div>
      </div>
      <div class="col-sm-6 col-lg-6 col-xl-3">
        <div class="card-box widget-flat border-success bg-success text-white">
          <i class="fa fa-file-text"></i>
          <h3 class="m-b-10">{{ $cvtotal ?? ""}}</h3>
          <p class="text-uppercase m-b-5 font-13 font-600">Total CV</p>
        </div>
      </div>
{{--      <div class="col-sm-6 col-lg-6 col-xl-3">--}}
{{--        <div class="card-box bg-danger widget-flat border-danger text-white">--}}
{{--          <i class="fa fa-users"></i>--}}
{{--          <h3 class="m-b-10">{{ $jstotal ?? ''}}</h3>--}}
{{--          <p class="text-uppercase m-b-5 font-13 font-600">Skilled People</p>--}}
{{--        </div>--}}
{{--      </div>--}}
      <div class="col-sm-6 col-lg-6 col-xl-3">
          <div class="card-box bg-success widget-flat border-success text-white">
              <i class="fa fa-check"></i>
              <h3 class="m-b-10">{{ $Seeker_Available ?? ''}}</h3>
              <p class="text-uppercase m-b-5 font-13 font-600">Seeker Available</p>
          </div>
      </div>
      <div class="col-sm-6 col-lg-6 col-xl-3">
          <div class="card-box bg-danger widget-flat border-danger text-white">
              <i class="fa fa-exclamation-triangle"></i>
              <h3 class="m-b-10">{{ $Seeker_NotAvailable ?? ''}}</h3>
              <p class="text-uppercase m-b-5 font-13 font-600">Seeker Not Available</p>
          </div>
      </div>
      <div class="col-sm-6 col-lg-6 col-xl-3">
          <div class="card-box bg-info widget-flat border-info text-white">
              <i class="fa fa-briefcase"></i>
              <h3 class="m-b-10">{{ $Seeker_InJob ?? ''}}</h3>
              <p class="text-uppercase m-b-5 font-13 font-600">Seeker In Job</p>
          </div>
      </div>
    </div>
      <div class="row">
          <div class="col-lg-6">
              <div class="card-box"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <h4 class="header-title">Male/Female Ratio</h4>
                  <canvas id="male_female_ratio" width="400" height="400"></canvas>
              </div>
          </div>
          <div class="col-lg-6">
              <div class="card-box"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <h4 class="header-title">CIT Student/Out Student Ratio</h4>
                  <canvas id="CIT_student_out_student_ratio" width="400" height="400"></canvas>
              </div>
          </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <div class="card-box"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="header-title">Last 7 days CV Request</h4>
                <canvas id="7_days_CV_request" width="400" height="400"></canvas>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card-box"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="header-title">Last 7 days New CV</h4>
                <canvas id="7_days_CV_new" width="400" height="400"></canvas>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12">
            <div class="card-box"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                <h4 class="header-title">Skill wise CV</h4>
                <canvas id="skill_wise_cv" width="400" height="200"></canvas>
            </div>
        </div>
      </div>
    @include('inc.footer')
  </div>
</div>
@endsection

@section('footer_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js" charset="utf-8"></script>
    <script>
        var ctx = document.getElementById('male_female_ratio');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: '# of Amount',
                    data: [{{ $total_male }}, {{ $total_female }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx1 = document.getElementById('CIT_student_out_student_ratio');
        var myChart = new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['CIT Student', 'Out Student'],
                datasets: [{
                    label: '# of Amount',
                    data: [{{ $cit_in_student }}, {{ $cit_out_student }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx1 = document.getElementById('7_days_CV_request');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($seven_days_CV_request_date) !!},
                datasets: [{
                    label: '# of Amount',
                    data: {{ json_encode($seven_days_CV_request_data) }},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx1 = document.getElementById('7_days_CV_new');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($seven_days_CV_new_date) !!},
                datasets: [{
                    label: '# of Amount',
                    data: {{ json_encode($seven_days_CV_new_data) }},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var ctx1 = document.getElementById('skill_wise_cv');
        var myChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: {!! json_encode($skill_name_for_chart) !!},
                datasets: [{
                    label: '# of Amount',
                    data: {{ json_encode($skill_amount_for_chart) }},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(153, 102, 255, 0.5)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
