@extends('layouts.admin-dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form method="POST" action="{{ route('admin.doctor.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name') }}"  placeholder="Enter First Name"
                                           @error('first_name')aria-describedby="first_name-error" aria-invalid="true" @enderror required>
                                    @error('first_name')
                                    <span id="first_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name </label>
                                    <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name') }}"  placeholder="Enter Last Name"
                                           @error('last_name')aria-describedby="last_name-error" aria-invalid="true" @enderror>
                                    @error('last_name')
                                    <span id="last_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address <span class="text-danger">*</span></label>
                                    <textarea id="address" name="address" rows="4" cols="50" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" placeholder="Enter Address"
                                    @error('address')aria-describedby="address-error" aria-invalid="true" @enderror>
                                    </textarea>
                                    {{-- <input type="text" class="form-control @error('address')is-invalid @enderror" id="address" name="address" value="{{ old('address') }}"  placeholder="Enter Address"
                                           @error('address')aria-describedby="address-error" aria-invalid="true" @enderror> --}}
                                    @error('address')
                                    <span id="address-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mobile')is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile') }}"  placeholder="Enter Mobile"
                                           @error('mobile')aria-describedby="mobile-error" aria-invalid="true" @enderror required>
                                    @error('mobile')
                                    <span id="mobile-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Expertise <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('expertise')is-invalid @enderror" id="expertise" name="expertise" value="{{ old('expertise') }}"  placeholder="Enter Expertised Feild"
                                           @error('expertise')aria-describedby="expertise-error" aria-invalid="true" @enderror>
                                    @error('expertise')
                                    <span id="expertise-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email') }}"  placeholder="Enter Email"
                                           @error('email')aria-describedby="email-error" aria-invalid="true" @enderror required>
                                    @error('email')
                                    <span id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password')is-invalid @enderror" id="password" name="password" value="{{ old('password') }}"  placeholder="Enter Password"
                                           @error('password')aria-describedby="password-error" aria-invalid="true" @enderror required>
                                    @error('password')
                                    <span id="password-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password')is-invalid @enderror" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"  placeholder="Re-enter Password"
                                           @error('password_confirmation')aria-describedby="password_confirmation-error" aria-invalid="true" @enderror required>
                                    @error('password')
                                    <span id="password_confirmation-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {
            var App = {
                initialize: function () {

                }
            };
            App.initialize();
        })
    </script>
@endsection
