@extends('layouts.doctor-dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profile Image -->
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ DoctorHelper::getProfileImage(Auth::guard('doctor')->user()->id, Auth::guard('doctor')->user()->profile_image) }}"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ ProfileHelper::getFullName(AuthConstants::GUARD_DOCTOR) }}</h3>
                        </div>
                    </div>
                </div>
                <!--End Profile Image -->

                <!-- Reset Password -->
                <div class="col-md-9">
                    <form class="form-horizontal" action="{{route('doctor.profile.update-password')}}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a class="nav-link" href="{{route('doctor.profile.index')}}">Update Profile</a></li>
                                    <li class="nav-item"><a class="nav-link active" href="{{route('doctor.profile.change-password')}}">Change Password</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="reset-password">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="inputName" class="col-form-label">Enter Current Password<span class="required"> *</span></label></label>

                                                <input type="password" name="current_password" class="form-control" id="inputName" placeholder="Enter Current Password" required="">
                                                @error('current_password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="inputName" class="col-form-label">Enter New Password<span class="required"> *</span></label></label>

                                                <input type="password" name="password" class="form-control" id="inputName" placeholder="Enter New Password" required="">
                                                @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="inputEmail" class="col-form-label">Re-enter Password<span class="required"> *</span></label></label>

                                                <input type="password" name="password_confirmation" class="form-control" id="inputEmail" placeholder="Re-enter Password" required="">
                                                @error('password_confirmation')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
