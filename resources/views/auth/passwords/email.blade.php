@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center pt-5">
        <div class="col-md-6 col-sm-12 mt-5">
            <div class="loginBox">
                <img src="{{asset('/images/assets/user.png')}}" alt="user" class="user">
                <h2>Reset Password</h2>
                @if (session('status'))
                    <div class="alert alert-success text-white" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <p><span class="ti ti-envelop"></span>  Email</p>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif

                    <input type="submit" value="Send Password Reset Link">

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
