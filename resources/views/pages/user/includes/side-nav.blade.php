<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ UserHelper::getProfileImage(Auth::guard('user')->user()->id, Auth::guard('user')->user()->profile_image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('user.profile.index') }}" class="d-block">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_USER), 10) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('user.home') }}" class="nav-link {{ request()->is('user') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clinic-medical"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW AVAILABLE DOCTOR</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('user/doctor') || request()->is('user/doctor/*') ? 'active' : '' }}" href="{{ route('user.doctor.index') }}">
                    <i class="nav-icon fas fa-user-md"></i>
                    <p>{{ __('Doctors') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW YOUR APPOINTMENT BOOKINGS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('user/booking') || request()->is('user/booking/*') ? 'active' : '' }}" href="{{ route('user.booking.index') }}">
                    <i class="nav-icon fas fa-table"></i>
                    <p>{{ __('Appointment') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW AVAILABLE APPOINTMENTS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('user/available-appointment') || request()->is('user/available-appointment/*') ? 'active' : '' }}" href="{{ route('user.available-appointment.index') }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>{{ __('Available Appointment') }}</p>
                </a>
            </li>

            <li class="nav-header">SITE SETTINGS</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}"
                   onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Sign out') }}</p>
                </a>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
