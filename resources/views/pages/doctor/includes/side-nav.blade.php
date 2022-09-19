<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ DoctorHelper::getProfileImage(Auth::guard('doctor')->user()->id, Auth::guard('doctor')->user()->profile_image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('doctor.profile.index') }}" class="d-block">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR), 10) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('doctor.home') }}" class="nav-link {{ request()->is('doctor') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clinic-medical"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW REGISTERED PATIENTS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('doctor/user') || request()->is('doctor/user/*') ? 'active' : '' }}" href="{{ route('doctor.user.index') }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>{{ __('Patients') }}</p>
                </a>
            </li>

            <li class="nav-header">MANAGE YOUR BOOKING</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('doctor/booking') || request()->is('doctor/booking/*') ? 'active' : '' }}" href="{{ route('doctor.booking.index') }}">
                    <i class="nav-icon fas fa-table"></i>
                    <p>{{ __('Bookings') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW AVAILABLE APPOINTMENTS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('doctor/available-appointment') || request()->is('doctor/available-appointment/*') ? 'active' : '' }}" href="{{ route('doctor.available-appointment.index') }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>{{ Str::limit('Your Assigned Appointment Slots', 23) }}</p>
                </a>
            </li>

            <li class="nav-header">SITE SETTINGS</li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('doctor.logout') }}"
                   onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Sign out') }}</p>
                </a>
                <form id="logout-form" action="{{ route('doctor.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
