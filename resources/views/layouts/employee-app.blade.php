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

            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <div id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </div>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('employee.logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            Одјави се
                        </a>

                        <form id="logout-form" action="{{ route('employee.logout') }}" method="POST" style="display: none;">
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
</main>
<footer>
    <div class="text-center mb-1 text-muted">Copyright 2021 © Урош Динић</div>
</footer>

@if(Session::has('createProgram_success'))
    <script>
        $(function() {
            $('#createProgram_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createProgram_failed'))
    <script>
        $(function() {
            $('#createProgram_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateProgram_success'))
    <script>
        $(function() {
            $('#updateProgram_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateProgram_failed'))
    <script>
        $(function() {
            $('#updateProgram_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteProgram_success'))
    <script>
        $(function() {
            $('#deleteProgram_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteProgram_failed'))
    <script>
        $(function() {
            $('#deleteProgram_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('createInformation_success'))
    <script>
        $(function() {
            $('#createInformation_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createInformation_failed'))
    <script>
        $(function() {
            $('#createInformation_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteInformation_success'))
    <script>
        $(function() {
            $('#deleteInformation_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteInformation_failed'))
    <script>
        $(function() {
            $('#deleteInformation_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateInformation_success'))
    <script>
        $(function() {
            $('#updateInformation_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateInformation_failed'))
    <script>
        $(function() {
            $('#updateInformation_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('createSubject_success'))
    <script>
        $(function() {
            $('#createSubject_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createSubject_failed'))
    <script>
        $(function() {
            $('#createSubject_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateSubject_success'))
    <script>
        $(function() {
            $('#updateSubject_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateSubject_failed'))
    <script>
        $(function() {
            $('#updateSubject_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteSubject_success'))
    <script>
        $(function() {
            $('#deleteSubject_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteSubject_failed'))
    <script>
        $(function() {
            $('#deleteSubject_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('createUser_success'))
    <script>
        $(function() {
            $('#createUser_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createUser_failed'))
    <script>
        $(function() {
            $('#createUser_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateUser_success'))
    <script>
        $(function() {
            $('#updateUser_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateUser_failed'))
    <script>
        $(function() {
            $('#updateUser_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteUser_success'))
    <script>
        $(function() {
            $('#deleteUser_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteUser_failed'))
    <script>
        $(function() {
            $('#deleteUser_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('createSchedule_success'))
    <script>
        $(function() {
            $('#createSchedule_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createSchedule_failed'))
    <script>
        $(function() {
            $('#createSchedule_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteSchedule_success'))
    <script>
        $(function() {
            $('#deleteSchedule_success').modal('show');
        });
    </script>
@endif

@if(Session::has('deleteSchedule_failed'))
    <script>
        $(function() {
            $('#deleteSchedule_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('createExam_success'))
    <script>
        $(function() {
            $('#createExam_success').modal('show');
        });
    </script>
@endif

@if(Session::has('createExam_failed'))
    <script>
        $(function() {
            $('#createExam_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateExam_success'))
    <script>
        $(function() {
            $('#updateExam_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateExam_failed'))
    <script>
        $(function() {
            $('#updateExam_failed').modal('show');
        });
    </script>
@endif

@if(Session::has('updateResult_success'))
    <script>
        $(function() {
            $('#updateResult_success').modal('show');
        });
    </script>
@endif

@if(Session::has('updateResult_failed'))
    <script>
        $(function() {
            $('#updateResult_failed').modal('show');
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
