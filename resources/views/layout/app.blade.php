<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'LaravelApp') }}</title>

        <script type="text/javascript" src="{{ asset('js/app.js')}}"></script>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            
        </style>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
                <a class="navbar-brand" href="#">Laravel App</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/') }}">Lazy Loading </a>
                        </li>
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/eager-loading') }}">Eager Loading </a>
                        </li>
                        <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/telescope/queries') }}" target="_blank">Telescope (Monitor App) </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container py-4">
                @yield('content')
            </div>
        </div>
    </body>
</html>
