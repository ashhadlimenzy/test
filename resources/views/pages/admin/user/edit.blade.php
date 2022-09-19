@extends('layouts.admin-dashboard')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form method="POST" action="{{ route('admin.user.update', $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('first_name')is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"  placeholder="Enter First Name"
                                           @error('first_name')aria-describedby="first_name-error" aria-invalid="true" @enderror required>
                                    @error('first_name')
                                    <span id="first_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name </label>
                                    <input type="text" class="form-control @error('last_name')is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"  placeholder="Enter Last Name"
                                           @error('last_name')aria-describedby="last_name-error" aria-invalid="true" @enderror>
                                    @error('last_name')
                                    <span id="last_name-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('mobile')is-invalid @enderror" id="mobile" name="mobile" value="{{ old('mobile', $user->mobile) }}"  placeholder="Enter Mobile"
                                           @error('mobile')aria-describedby="mobile-error" aria-invalid="true" @enderror required>
                                    @error('mobile')
                                    <span id="mobile-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}"  placeholder="Enter Email"
                                           @error('email')aria-describedby="email-error" aria-invalid="true" @enderror required>
                                    @error('email')
                                    <span id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
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
