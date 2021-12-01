@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Прикажи обавештења</a>
                <a class="dropdown-item" href="#">Креирај обавештење</a>
                <a class="dropdown-item disabled" href="#">Измени обавештење</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студијски програми</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showPrograms') }}">Прикажи студијске програме</a>
                <a class="dropdown-item" href="{{ route('employee.createProgram') }}">Креирај студијски програм</a>
                <a class="dropdown-item active disabled" href="#">Измени студијски програм</a>
            </div>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Предмети</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Студенти</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Распоред наставе</a>
        </li>
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <div class="row pl-3">
                <a class="card-navigation-1" href="{{ route('employee.showPrograms') }}">Студијски програми&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Измени студијски програм</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employee.updateProgram', $program->id) }}" method="POST">
                @csrf

                <div class="form-group row pt-3">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Назив студијског програма</label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control @error('program-name') is-invalid @enderror" name="name" value="{{ $program->name }}" required oninvalid="this.setCustomValidity('Унесите назив студијског програма!')" oninput="setCustomValidity('')" autofocus>

                        @error('program-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right">Шифра студијског програма</div>
                    <div class="ml-3 form-control" style="width: 38px">{{ $program->code }}</div>
                </div>

                <div class="row pt-2 pb-3">
                    <div class="offset-md-4 col-md-8">
                        <button type="submit" class="btn btn-primary">Потврди</button>
                        <a href="{{ route('employee.showPrograms') }}" class="btn btn-danger">Одустани</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Program Failed Message -->
<div class="modal" id="updateProgram_failed" tabindex="-1" aria-labelledby="updateProgram_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно ажурирање података о студијском програму. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
