<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ ProfileHelper::getProfileImage(AuthConstants::GUARD_ADMIN) }}" class="user-image img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN) }}">
                <span class="d-none d-md-inline">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN), 10) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ ProfileHelper::getProfileImage(AuthConstants::GUARD_ADMIN) }}" class="img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN) }}">

                    <p>
                        {{ ProfileHelper::getFullName(AuthConstants::GUARD_ADMIN) }}
                        <small>Member since {{ ProfileHelper::getMemberSince(AuthConstants::GUARD_ADMIN) }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('admin.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a class="btn btn-default btn-flat float-right" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                        <p>{{ __('Sign out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
