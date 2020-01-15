@extends('layouts.register-login')

@section('content')
<section class="login-sec">
    <div class="container">
        <div class="login-form-pg forgot-reset">
            @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
            @endif
            <h3>{{ __('Reset Password') }}</h3>
            <br>
            <form class="form-horizontal" method="POST" action="{{ route('profile.changePass') }}">
                @csrf
                <div class="form-inputs">
                    <div class="row">
                        <div class="col-12 mb-4 col-md-6 login-field">
                            <label>Current Password</label>
                            <input id="current-password" type="password" class="form-control @error('current-password') is-invalid @enderror" name="current-password">

                            @error('current-password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-4 col-md-6 login-field">
                            <label>New Password</label>
                            <input id="new-password" type="password" class="form-control @error('new-password') is-invalid @enderror" name="new-password">

                            @error('new-password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-1 col-md-6 login-field">
                            <label for="new-password-confirm">Confirm New Password</label>
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="Reset Password" class="btn-typo">
                </div>
                <br>
                <div class="text-center">
                    <a href="{{ route('profile.create') }}">Go Back</a>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
