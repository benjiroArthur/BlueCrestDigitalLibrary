@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-6 offset-md-3 col-sm-12">
            <div class="loginBox">
                <img src="{{asset('/images/assets/user.png')}}" alt="user" class="user">
                <h2>USER LOGIN</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <p><span class="ti ti-user"></span>  USERNAME</p>
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                    @endif

                    <p><span class="ti ti-lock"></span>  PASSWORD</p>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif


                    <div class="form-group row">
                        <div class="col-md-12 col-lg-12 col-sm-12">
                            <div class="form-check-inline">

                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="" for="remember" style="color: white">Remember Me</label>
                            </div>
                        </div>
                    </div>

                    <input type="submit" value="Login">



                    <a class="btn btn-link text-center" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a> <br>

                </form>

            </div>
        </div>
    </div>

    <br><br>
</div>
@endsection
