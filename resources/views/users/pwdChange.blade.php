@extends('layouts.app')
@section('content')
    <div class="container mb-5">
        {{--//{{auth()->user()->role->id}}--}}
        <br><br>
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-12">
                <div class="loginBox">
                    <img src="{{asset('/images/assets/user.png')}}" alt="user" class="user">
                    <h2>CHANGE PASSWORD</h2>
                    <form method="POST" action="{{ route('pwdChange', auth()->user()->id) }}">
                        @method('PUT')
                        @csrf

                        <p><span class="mdi mdi-account"></span>  USERNAME</p>
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} text-center" name="username" value="{{ $user->username }}" required autofocus>

                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif

                        <p><span class="mdi mdi-lock"></span>  OLD PASSWORD</p>
                        <input  id="old-password" type="password" class="form-control{{ $errors->has('old-password') ? ' is-invalid' : '' }} text-center" name="old-password" required>

                        @if ($errors->has('old-password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('old-password') }}</strong>
                                    </span>
                        @endif

                        <p><span class="mdi mdi-lock"></span>  NEW PASSWORD</p>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} text-center" name="password" required>

                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif

                        <p><span class="mdi mdi-lock"></span>  CONFIRM PASSWORD</p>
                        <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} text-center" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif



                        <input type="submit" value="Submit">

                    </form>

                </div>
            </div>
        </div>


    </div>

    <style type="text/css">
        {{--body{--}}
            {{--background: url("{{asset('assets/images/dashboard/img_2.jpg')}}")center center no-repeat !important;--}}
        {{--}--}}
        h2
        {
            margin: 0;
            padding: 0 0 20px;
            color: #4b5320;
            text-align: center;
            font-size: 28px;
            font-weight: bolder;
        }

    </style>
@endsection