@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.dashboard') }}">Прикажи обавештења</a>
                <a class="dropdown-item" href="{{ route('employee.createInformation') }}">Креирај обавештење</a>
                <a class="dropdown-item active disabled" href="#">Измени обавештење</a>
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
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студенти</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showUsers') }}">Прикажи студенте</a>
                <a class="dropdown-item" href="{{ route('employee.createUser') }}">Додај студента</a>
                <a class="dropdown-item disabled" href="#">Измени податке о студенту</a>
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
                <a class="card-navigation-1" href="{{ route('employee.dashboard') }}">Огласна табла&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Измени обавештење</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employee.updateInformation', $information->id) }}" method="POST">
                @csrf
                <div class="d-flex flex-row justify-content-center">
                    <div class="form-group form-inline font-weight-bold text-uppercase">
                        {{ $information->program->name }}
                    </div>

                    <div class="form-group form-inline font-weight-bold text-uppercase">
                        @if($information->grade == "1")
                            &nbsp- I година
                        @elseif($information->grade == "2")
                            &nbsp- II година
                        @elseif($information->grade == "3")
                            &nbsp- III година
                        @elseif($information->grade == "4")
                            &nbsp- IV година
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="text">Текст обавештења</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text" rows="3">{{ $information->text }}</textarea>
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mr-2">Измени</button>
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-danger">Одустани</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Information Failed Message -->
<div class="modal" id="updateInformation_failed" tabindex="-1" aria-labelledby="updateInformation_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно ажурирање обавештења. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
