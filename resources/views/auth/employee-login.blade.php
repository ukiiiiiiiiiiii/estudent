<!DOCTYPE html>
<html lang="sr-rs">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('css/img/icon.ico') }}">
    <title>КПУ | Студентски веб сервис</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="wrapper background" style="overflow: hidden">
<header></header>

<main>
    <div id="app">
        <div class="container">
            <div class="pb-4 text-center" style="padding-top: 170px">
                <div class="pb-4 h2 font-weight-bold">СТУДЕНТСКА СЛУЖБА</div>
                <img src="{{ asset('css/img/logo180.png') }}" alt="КПУ">
            </div>

            <div class="pt-2 d-flex justify-content-center">
                <form method="POST" action="{{ route('employee.login.submit') }}">
                    @csrf

                    <div class="form-group mb-0">
                        <label for="username" class="sr-only">Корисничко име</label>
                        <input id="username" placeholder="Корисничко име" type="text" class="text-center form-control @error('username') is-invalid @enderror @error('password') is-invalid @enderror" name="username" required oninvalid="this.setCustomValidity('Унесите корисничко име!')" oninput="setCustomValidity('')" autofocus>

                        <div class="py-2"></div>

                        <label for="password" class="sr-only">Лозинка</label>
                        <input id="password" placeholder="Лозинка" type="password" class="text-center form-control @error('username') is-invalid @enderror @error('password') is-invalid @enderror" name="password" required oninvalid="this.setCustomValidity('Унесите лозинку!')"  oninput="setCustomValidity('')">

                        <div class="py-1"></div>

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-0 pt-2 mx-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Запамти ме на овом уређају') }}
                            </label>
                        </div>
                    </div>

                    <div class="pt-3 form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Пријави се') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<footer>
    <div class="text-center mb-2 mt-5 text-muted">Copyright 2021 © Урош Динић</div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>

<script>
    $(document).ready(function(){
        $("#popup").popover({
            html:!0,content:
                "<strong>Пример 1:</strong> 1Д1/0004/19<br>" +
                "<strong>Пример 2:</strong> 1Б1/0003/15",
            placement:"bottom",offset:"60px 0px"
        });
    });
</script>
</body>
</html>
