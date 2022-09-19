<div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ ProfileHelper::getProfileImage(AuthConstants::GUARD_ADMIN) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('admin.profile.index') }}" class="d-block">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN), 10) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clinic-medical"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>

            <li class="nav-header">USER AND DOCTOR MANAGEMENT</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/user') || request()->is('admin/user/*') ? 'active' : '' }}" href="{{ route('admin.user.index') }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>{{ __('Users') }}</p>
                </a>
                <a class="nav-link {{ request()->is('admin/doctor') || request()->is('admin/doctor/*') ? 'active' : '' }}" href="{{ route('admin.doctor.index') }}">
                    <i class="nav-icon fas fa-user-md"></i>
                    <p>{{ __('Doctors') }}</p>
                </a>
                
            </li>

            <li class="nav-header">MANAGE DOCTOR's BOOKING</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/booking') || request()->is('admin/booking/*') ? 'active' : '' }}" href="{{ route('admin.booking.index') }}">
                    <i class="nav-icon fas fa-table"></i>
                    <p>{{ __('Bookings') }}</p>
                </a>
            </li>

            <li class="nav-header">VIEW AVAILABLE APPOINTMENTS</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/available-appointment') || request()->is('admin/available-appointment/*') ? 'active' : '' }}" href="{{ route('admin.available-appointment.index') }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>{{ __('Available Appointment') }}</p>
                </a>
            </li>

            <li class="nav-header">SITE SETTINGS</li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt nav-icon"></i>
                    <p>{{ __('Sign out') }}</p>
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
</div>
