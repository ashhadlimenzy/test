<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('doctor.home') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ DoctorHelper::getProfileImage(Auth::guard('doctor')->user()->id, Auth::guard('doctor')->user()->profile_image) }}" class="user-image img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR) }}">
                <span class="d-none d-md-inline">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR), 10) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ DoctorHelper::getProfileImage(Auth::guard('doctor')->user()->id, Auth::guard('doctor')->user()->profile_image) }}" class="img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR) }}">

                    <p>
                        {{ ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR) }}
                        <small>Member since {{ ProfileHelper::getMemberSince(AuthConstants::GUARD_DOCTOR) }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('doctor.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a class="btn btn-default btn-flat float-right" href="{{ route('doctor.logout') }}"
                       onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                        <p>{{ __('Sign out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
