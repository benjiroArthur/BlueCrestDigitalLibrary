@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center pt-5">
        <div class="col-md-6 col-sm-12 mt-5">
            <div class="loginBox">
                <img src="{{asset('/images/assets/user.png')}}" alt="user" class="user">
                <h2>Reset Password</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <p><span class="ti ti-envelop"></span>  Email</p>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                           <strong class="bg-light">{{ $message }}</strong>
                    </span>
                    @enderror

                    <p><span class="ti ti-lock"></span>  New Password</p>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong class="bg-light">{{ $message }}</strong>
                                    </span>
                    @enderror

                    <p><span class="ti ti-lock"></span>  Confirm Password</p>
                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">

                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                                        <strong class="bg-light">{{ $message }}</strong>
                                    </span>
                    @enderror

                    <input type="submit" value="Reset Password">

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
