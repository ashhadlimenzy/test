@extends('layouts.admin-dashboard')

@section('content')
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{url('images/HOSAPP.png')}}" alt="AdminLTELogo" height="300" width="300">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $registeredActiveDoctors }}</h3>
                        <p>Active Doctors</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-md"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $registeredInActiveDoctors }}</h3>
                        <p>In Active Doctors</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-md"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $registeredActiveUsers }}</h3>
                        <p>Active Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $registeredInActiveUsers }}</h3>
                        <p>In Active Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->

        </div>
        <!-- /.row -->
        <div class="row">
            <livewire:counter/>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Doctor's Registrations</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="text-bold text-lg">{{ $totalDoctors }}</span>
                                <span>Doctor's Registrations Over Time</span>
                            </p>
                            <p class="ml-auto d-flex flex-column text-right">
                                <span class="text-success">
                                  <i class="fas fa-arrow-up"></i> {{ $doctorregistrationGrowthRate }}%
                                </span>
                                <span class="text-muted">Since this year</span>
                            </p>
                        </div>
                        <div class="position-relative mb-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="registrationChart" height="652" width="1064" class="chartjs-render-monitor" style="display: block; height: 200px; width: 532px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-md-6 latest-member">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Registered Doctors</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">{{ count($registeredDoctorsList) }} New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($registeredDoctorsList as $doctors)
                            <li>
                                <img src="{{ ProfileHelper::getProfileImageFromFile($doctors->profile_image,FileDestinations::DOCTOR . $doctors->id. '/profile/') }}" alt="{{ $doctors->first_name }}">
                                {{ Str::limit(ucfirst($doctors->first_name . ' ' . $doctors->last_name), 10) }}
                                <span class="users-list-date">{{DateHelper::format($doctors->created_at, DateHelper::DEFAULT_DATE_TIME_FORMAT) }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.doctor.index') }}">View All Doctors</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 latest-member">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Registered Users</h3>

                        <div class="card-tools">
                            <span class="badge badge-danger">{{ count($registeredUsersList) }} New Members</span>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <ul class="users-list clearfix">
                            @foreach($registeredUsersList as $users)
                            <li>
                                <img src="{{ ProfileHelper::getProfileImageFromFile($users->profile_image,FileDestinations::USER . $users->id. '/profile/') }}" alt="{{ $users->first_name }}">
                                {{--<a class="users-list-name" href="#">{{ $users->first_name . ' ' . $users->last_name }}</a>--}}
                                {{ Str::limit(ucfirst($users->first_name . ' ' . $users->last_name), 10) }}
                                {{--<span class="users-list-date">{{ DateHelper::getCurrentHumanReadableTime($users->created_at) }}</span>--}}
                                <span class="users-list-date">{{DateHelper::format($users->created_at, DateHelper::DEFAULT_DATE_TIME_FORMAT) }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('admin.user.index') }}">View All Users</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Recent Logins</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                <tr>
                                    <th>IP</th>
                                    <th>Logged Time</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($adminLoginLogs as $item)
                                <tr>
                                    <td>{{ $item->remote_address }}</td>
                                    {{--<td>{{ DateHelper::getCurrentHumanReadableTimeFromDate($item->created_at) }}</td>--}}
                                    {{-- <td>{{DateHelper::format($item->logged_at, DateHelper::DEFAULT_DATE_TIME_FORMAT) }}</td>
                                    <td>{!! AuthMessages::getLoginStatus($item->status) !!}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">View All Login Attempts</a>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../js/adminlte.min.js"></script>
    <script src="{{ asset('bower_components/admin-lte/plugins/chart.js/Chart.min.js') }}"></script>
    <script>
        var color = Chart.helpers.color;
        var barChartData = {
            labels: [{!! '\'' . implode("','", $doctorRegistrationGraphData['item']) . '\''  !!}],
            datasets: [{
                label: 'Services',
                backgroundColor: color('rgb(255, 99, 132)').alpha(0.5).rgbString(),
                borderColor: 'rgb(255, 99, 132)',
                borderWidth: 1,
                data: [
                    {{ implode(',', $doctorRegistrationGraphData['data']) }}
                ]
            }, ]

        };

        window.onload = function() {
            var ctx = document.getElementById('registrationChart').getContext('2d');
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    },

                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },

                    title: {
                        display: true,
                        text: 'Doctor`s Registrations done in ' + '{{ date('Y')  }}'
                    }
                }
            });

        };

    </script>
    
@endpush
