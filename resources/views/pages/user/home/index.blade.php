@extends('layouts.user-dashboard')

@section('content')
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{url('images/HOSAPP.png')}}" alt="AdminLTELogo" height="300" width="300">
</div>
<div class="container-fluid">
    <div class="row">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
        </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ Auth::guard('user')->user()->id }}</h3>
                    <p>Your Customer ID</p>
                </div>
                <div class="icon">
                    <i class="fa fa-ticket-alt"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="alert alert-danger alert-dismissible">
                                <h3><i class="icon fas fa-check"></i>Hello {{ Auth::guard('user')->user()->first_name }}, Our Guest!!</h3>
                                <br><center><img src = "{{url('images/WhatsApp-Image-2021-12-13-at-3.14.30-PM.jpeg')}}" alt = "CAPP Logo"  style = "opacity: .8" width="600px" height="450px"></center>
                            </div>
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <!-- /.row -->
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
                            @foreach($userLoginLogs as $item)
                                <tr>
                                    <td>{{ $item->remote_address }}</td>
                                    <td>{{ DateHelper::getCurrentHumanReadableTimeFromDate($item->created_at) }}</td>
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
@endpush
