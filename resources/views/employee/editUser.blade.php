@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.dashboard') }}">Прикажи обавештења</a>
                <a class="dropdown-item" href="{{ route('employee.createInformation') }}">Креирај обавештење</a>
                <a class="dropdown-item disabled" href="#">Измени обавештење</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студијски програми</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showPrograms') }}">Прикажи студијске програме</a>
                <a class="dropdown-item" href="{{ route('employee.createProgram') }}">Креирај студијски програм</a>
                <a class="dropdown-item disabled" href="#">Измени студијски програм</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Предмети</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showSubjects') }}">Прикажи предмете</a>
                <a class="dropdown-item" href="{{ route('employee.createSubject') }}">Креирај предмет</a>
                <a class="dropdown-item disabled" href="#">Измени предмет</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студенти</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showUsers') }}">Прикажи студенте</a>
                <a class="dropdown-item" href="{{ route('employee.createUser') }}">Додај студента</a>
                <a class="dropdown-item active disabled" href="#">Измени податке о студенту</a>
            </div>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('employee.showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showExams') }}">Распоред испита</a>
                <a class="dropdown-item" href="{{ route('employee.showRegisteredExams') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('employee.showPassedExams') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('employee.showUnsuccessfullyExams') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <div class="row pl-3">
                <a class="card-navigation-1" href="{{ route('employee.showUsers') }}">Студенти&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Измени податке о студенту</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employee.updateUser', $user->id) }}" method="POST">
                @csrf

                <div>
                    <div class="form-group row mb-2">
                        <label class="col-md-4 text-md-right">Студијски програм</label>

                        <div class="col-md-6 pl-0">
                            {{ $user->program->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Име и презиме</label>

                        <input id="name" type="text" class="col-md-6 form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required oninvalid="this.setCustomValidity('Унесите име и презиме студента!')" oninput="setCustomValidity('')" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-md-4 col-form-label text-md-right">Година студија</label>
                        <select class="col-md-3 form-control  @error('grade') is-invalid @enderror" name="grade" id="grade">
                            <option value="1" @if($user->grade == "1")selected @endif>I година</option>
                            <option value="2" @if($user->grade == "2")selected @endif>II година</option>
                            <option value="3" @if($user->grade == "3")selected @endif>III година</option>
                            <option value="4" @if($user->grade == "4")selected @endif>IV година</option>
                        </select>
                        @error('grade')
                        <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="budget" class="col-md-4 col-form-label text-md-right">Начин финансирања</label>

                        <select class="col-md-4 form-control  @error('budget') is-invalid @enderror" name="budget" id="budget">
                            <option value="Б" @if($user->budget == 'Б') selected @endif>Буџет</option>
                            <option value="С" @if($user->budget == 'С') selected @endif>Самофинансирајући</option>
                        </select>

                        @error('budget')
                        <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="espb" class="col-md-4 col-form-label text-md-right">ЕСПБ</label>

                        <input id="espb" name="espb" type="number" class="col-md-1 form-control @error('espb') is-invalid @enderror" value="{{ $user->espb }}" required oninvalid="this.setCustomValidity('Унесите број ЕСПБ бодова!')" oninput="setCustomValidity('')">

                        @error('espb')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if($user->budget == 'С')
                        <div class="form-group row">
                            <label class="col-md-4 text-md-right">Дуг за школарину</label>

                            <div class="col-md-2 pl-0">
                                {{ 81000 - $user->paid }} динара
                            </div>
                        </div>
                    @endif
                </div>

                <div class="row pt-2 pb-3">
                    <div class="offset-md-4">
                        <button type="submit" class="btn btn-primary">Потврди</button>
                        <a href="{{ route('employee.showUsers') }}" class="btn btn-danger">Одустани</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update User Failed Message -->
<div class="modal" id="updateUser_failed" tabindex="-1" aria-labelledby="updateUser_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно ажурирање података о студенту. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
