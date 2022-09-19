@extends('layouts.admin-login')

@section('content')

    @error('email') @enderror

    <div class="login-box">
        <center><img src = "{{url('images/HOSAPP.png')}}" alt = "CAPP Logo" class = "brand-image img-circle elevation-3" style = "opacity: .8" width="80px"></center>
        <div class="login-logo">
            <a href="{{ route('home') }}"><b>{{ env('APP_NAME') }}</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your admin session</p>

                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">{{ __('Remember Me') }}</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Sign In') }}</button>
                        </div>
                        <livewire:counter/>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
