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
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студијски програми</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showPrograms') }}">Прикажи студијске програме</a>
                <a class="dropdown-item" href="{{ route('employee.createProgram') }}">Креирај студијски програм</a>
                <a class="dropdown-item disabled" href="#">Измени студијски програм</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Предмети</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showSubjects') }}">Прикажи предмете</a>
                <a class="dropdown-item" href="{{ route('employee.createSubject') }}">Креирај предмет</a>
                <a class="dropdown-item active disabled" href="#">Измени предмет</a>
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
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <div class="row pl-3">
                <a class="card-navigation-1" href="{{ route('employee.showSubjects') }}">Предмети&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Измени предмет</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employee.updateSubject', $subject->id) }}" method="POST">
                @csrf

                <div>
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">Назив предмета</label>

                        <input id="name" type="text" class="col-md-6 form-control @error('subject-name') is-invalid @enderror" name="name" value="{{ $subject->name }}" required oninvalid="this.setCustomValidity('Унесите назив предмета!')" oninput="setCustomValidity('')" autofocus>

                        @error('subject-name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="program_id" class="col-md-4 col-form-label text-md-right">Студијски програм</label>
                        <select class="col-md-6 form-control @error('program_id') is-invalid @enderror" name="program_id" id="program_id">
                            @foreach($programs as $program)
                                <option @if($subject->program->id == $program->id)selected @endif value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="grade" class="col-md-4 col-form-label text-md-right">Година студија</label>
                        <select class="col-md-3 form-control  @error('grade') is-invalid @enderror" name="grade" id="grade">
                            <option value="" @if($subject->grade == "")selected @endif>Све године</option>
                            <option value="1" @if($subject->grade == "1")selected @endif>I година</option>
                            <option value="2" @if($subject->grade == "2")selected @endif>II година</option>
                            <option value="3" @if($subject->grade == "3")selected @endif>III година</option>
                            <option value="4" @if($subject->grade == "4")selected @endif>IV година</option>
                        </select>
                        @error('grade')
                        <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="espb" class="col-md-4 col-form-label text-md-right">ЕСПБ</label>

                    <input id="espb" name="espb" type="number" class="col-md-1 form-control @error('espb') is-invalid @enderror" value="{{ $subject->espb }}" required oninvalid="this.setCustomValidity('Унесите број ЕСПБ бодова!')" oninput="setCustomValidity('')">

                    @error('espb')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row pt-2 pb-3">
                    <div class="offset-md-4">
                        <button type="submit" class="btn btn-primary">Потврди</button>
                        <a href="{{ route('employee.showSubjects') }}" class="btn btn-danger">Одустани</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Subject Failed Message -->
<div class="modal" id="updateSubject_failed" tabindex="-1" aria-labelledby="updateSubject_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно ажурирање података о предмету. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
