@extends('layouts.login',['class' => 'reset'])
@section('title','Admin Reset Password')
@section('content')
    <div class="m-login__head">
        <h3 class="m-login__title">
            Reset Password
        </h3>
    </div>
    <form class="m-login__form m-form" role="form" method="POST" action="{{ route('admin.password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group m-form__group {{ $errors->has('email') ? 'has-danger' : '' }}">
            <input type="email" id="email" name="email" class="form-control placeholder-no-fix" value="{{ old('email') }}" placeholder="Email" required autofocus>
            @if ($errors->has('email'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group m-form__group {{ $errors->has('password') ? 'has-danger' : '' }}">
            <input type="password" id="password" name="password" class="form-control placeholder-no-fix" placeholder="Password" required autofocus>
            @if ($errors->has('password'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <div class="form-group m-form__group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control placeholder-no-fix" placeholder="Confirm Password" required autofocus>
            @if ($errors->has('password_confirmation'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>
        <div class="kt-login__actions">
            <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Reset Password</button>
        </div>

    </form>
@endsection
