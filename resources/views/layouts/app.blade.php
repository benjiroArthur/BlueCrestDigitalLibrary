<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    @auth
        <meta name="user-id" content="{{ Auth::user()->id }}">
    @else
        <meta name="user-id" content="0">
    @endauth

    <title>{{ config('app.name', 'E-LIBRARY') }}</title>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('icon.png')}}" />

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/mdi/css/materialdesignicons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/iconfonts/themify-icons/themify-icons.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            @include('includes.navbar')
        </div>

        <main class="py-4">
            <div class="container-fluid page-body-wrapper">
                @include('includes.messages')
                @yield('content')
            </div>
        </main>
        @include('includes.footer')
    </div>

    <!-- Scripts -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/navbar_script.js')}}"></script>
    @yield('script')
    <script>
        $('document').ready(function(){
            setTimeout(function()
            {
                $('.alert').fadeOut('fast');
            },3000);

        });
    </script>
</body>
</html>
