<!DOCTYPE html>
<html lang="sr-rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('css/img/icon.ico') }}">
    <title>КПУ | Студентски веб сервис | Администратор</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
</head>
<body class="wrapper">
<header>
    <div class="flag-pattern"></div>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex flex-row" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('css/img/logo50.png') }}" class="d-inline-block align-top" alt="">
                <div style="padding-top: 10px" class="pl-2">Криминалистичко-полицијски универзитет</div>
            </a>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <div id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </div>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Одјави се
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>
<main>
    <div id="app">
        @yield('content')
    </div>
</main>
<footer>
    <div class="text-center mb-2 text-muted">Copyright 2021 © Урош Динић</div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/search.js') }}"></script>

@if(Session::has('addEmployee_success'))
    <script>
        $(function() {
            $('#addEmployee_success').modal('show');
        });
    </script>
@endif

@if(Session::has('addEmployee_failed'))
    <script>
        $(function() {
            $('#addEmployee_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateEmployee_success'))
    <script>
        $(function() {
            $('#updateEmployee_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateEmployee_failed'))
    <script>
        $(function() {
            $('#updateEmployee_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteEmployee_success'))
    <script>
        $(function() {
            $('#deleteEmployee_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteEmployee_failed'))
    <script>
        $(function() {
            $('#deleteEmployee_failed').modal('show');
        });
    </script>
@endif
</body>
</html>
