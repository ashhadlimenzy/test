<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('user.home') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- SEARCH FORM -->
{{--    <form class="form-inline ml-3">--}}
{{--        <div class="input-group input-group-sm">--}}
{{--            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">--}}
{{--            <div class="input-group-append">--}}
{{--                <button class="btn btn-navbar" type="submit">--}}
{{--                    <i class="fas fa-search"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </form>--}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="javascript:;" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ UserHelper::getProfileImage(Auth::guard('user')->user()->id, Auth::guard('user')->user()->profile_image) }}" class="user-image img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_USER) }}">
                <span class="d-none d-md-inline">{{ Str::limit(ProfileHelper::getFullName(AuthConstants::GUARD_USER), 10) }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ UserHelper::getProfileImage(Auth::guard('user')->user()->id, Auth::guard('user')->user()->profile_image) }}" class="img-circle elevation-2" alt="{{ ProfileHelper::getFullName(AuthConstants::GUARD_USER) }}">

                    <p>
                        {{ ProfileHelper::getFullName(AuthConstants::GUARD_USER) }}
                        <small>Member since {{ ProfileHelper::getMemberSince(AuthConstants::GUARD_USER) }}</small>
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="{{ route('user.profile.index') }}" class="btn btn-default btn-flat">Profile</a>
                    <a class="btn btn-default btn-flat float-right" href="{{ route('user.logout') }}"
                       onclick="event.preventDefault(); if( confirm('Are you sure you want to Sign out?')) document.getElementById('logout-form').submit();">
                        <p>{{ __('Sign out') }}</p>
                    </a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
