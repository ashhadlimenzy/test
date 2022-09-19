@extends('layouts.login',['class' => 'reset'])
@section('title','Admin Reset Password')
@section('content')
    <div class="kt-login__forgot">
        <div class="kt-login__head">
            <h3 class="kt-login__title">Forgotten Password ?</h3>
            <div class="kt-login__desc">Enter your email to reset your password:</div>
        </div>
    </div>
    <form class="m-login__form m-form" role="form" method="POST" action="{{ route('admin.password.email') }}">
        {{ csrf_field() }}
        <div class="form-group m-form__group {{ $errors->has('email') ? 'has-danger' : '' }}">
            <input type="email" id="email" name="email" class="form-control placeholder-no-fix" value="{{ old('email') }}" placeholder="Email" required autofocus>
            @if ($errors->has('email'))
                <div id="email-error" class="form-control-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="row m-login__form-sub">
            <div class="col m--align-right m-login__form-right">
                <a href="{{ route('admin.login') }}" id="m_login_forget_password" class="m-link">Back to Sign In</a><br>
            </div>
        </div>
        <div class="kt-login__actions">
            <button id="kt_login_forgot_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">Send Password Reset Link</button>
        </div>
    </form>
    <div class="kt-login__account">
								<span class="kt-login__account-msg">
									Don't have an account yet ?
								</span>
        &nbsp;&nbsp;
        <a href="javascript:;" id="kt_login_signup" class="kt-login__account-link">Sign Up!</a>
    </div>
    </div>

@endsection