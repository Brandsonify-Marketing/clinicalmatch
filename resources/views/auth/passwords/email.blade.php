@extends('layouts.register-login')

@section('content')
<section class="login-sec">
    <div class="container">
        <div class="login-form-pg forgot-password">
            <h3>{{ __('Reset Password') }}</h3>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <br>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-inputs">
                    <div class="row">
                        <div class="col-12 col-md-6 login-field">
                            <label>Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <input type="submit" value="Send Password Reset Link" class="btn-typo">
                </div>
            </form>
        </div>
    </div>
</section>

@endsection



