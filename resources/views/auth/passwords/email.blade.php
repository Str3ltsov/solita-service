@extends('layouts.app')

@section('content')
<div class="auth-form container pt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}" class="auth-form-container">
                <h4 class="form-title">{{ __('auth.resetPassword') }}</h4>
                @csrf
                <div class="row mb-5">
                    <div class="form-group col">
                        <label class="form-label text-color-dark text-3">
                            {{ __('auth.email') }}
                        </label>
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col">
                        <button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3 auth-button mb-3" data-loading-text="Loading...">
                            {{ __('auth.sendResetPasswordLink') }}
                        </button>
                        @if (Route::has('login'))
                            <div class="d-flex justify-content-center align-items-center">
                                <span class="me-2">{{ __('auth.resetPasswordParagraph') }}</span>
                                <a class="login-link" href="{{ route('login') }}">
                                    {{ __('buttons.login') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
