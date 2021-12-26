<!DOCTYPE html>
<html lang="sr-rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('css/img/icon.ico') }}">
    <title>КПУ | Студентски веб сервис | Студентска служба</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrap-datepicker/css/bootstrap-datepicker.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
</head>
<body class="wrapper">
<header>
    <div class="flag-pattern"></div>

    <nav class="navbar navbar-expand-md navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex flex-row" href="{{ route('employee.dashboard') }}">
                <img src="{{ asset('css/img/logo50.png') }}" class="d-inline-block align-top" alt="">
                <div style="padding-top: 10px" class="pl-2">Криминалистичко-полицијски универзитет</div>
            </a>

            <ul class="navbar-nav mr-auto">
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </div>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <button class="dropdown-item" data-toggle="modal" data-target="#info">Моји подаци</button>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Одјави се
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main>
    <div>
        @yield('content')
    </div>
    <div class="modal fade" id="info" tabindex="-1" role="dialog" aria-labelledby="infoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document" style="max-width: 660px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoLabel">{{ Auth::user()->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col-md-4">Број индекса</div>

                        <div class="col-md-8 font-weight-bold">
                            {{ Auth::user()->username }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">Студијски програм</div>

                        <div class="col-md-8 font-weight-bold">
                            {{ Auth::user()->program->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">Начин финансирања</div>

                        <div class="col-md-8 font-weight-bold">
                            @if(Auth::user()->budget == "Б")
                                буџет
                            @else
                                самофинансирање
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">Година студија</div>

                        <div class="col-md-8 font-weight-bold">
                            {{ Auth::user()->grade }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-4">ЕСПБ</div>

                        <div class="col-md-8 font-weight-bold">
                            {{ Auth::user()->espb }}
                        </div>
                    </div>

                    @if(Auth::user()->budget == "С")
                        <div class="form-group row">
                            <div class="col-md-4">Новчана средства</div>

                            <div class="col-md-8 font-weight-bold">
                                {{ Auth::user()->money }} динара
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
<footer>
    <div class="text-center mb-1 text-muted">Copyright 2021 © Урош Динић</div>
</footer>

@if(Session::has('storeResult_success'))
    <script>
        $(function() {
            $('#storeResult_success').modal('show');
        });
    </script>
@endif

@if(Session::has('storeResult_failed'))
    <script>
        $(function() {
            $('#storeResult_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('storeResult_noMoney'))
    <script>
        $(function() {
            $('#storeResult_noMoney').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteResult_success'))
    <script>
        $(function() {
            $('#deleteResult_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteResult_failed'))
    <script>
        $(function() {
            $('#deleteResult_failed').modal('show');
        });
    </script>
@endif

<script>
    $(".datepicker").datepicker({
        format: "dd.mm.yyyy.",
        weekStart: 1,
        autoclose: true,
    })
</script>
</body>
</html>
