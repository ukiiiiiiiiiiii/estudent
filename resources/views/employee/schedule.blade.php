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
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студенти</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showUsers') }}">Прикажи студенте</a>
                <a class="dropdown-item" href="{{ route('employee.createUser') }}">Додај студента</a>
                <a class="dropdown-item disabled" href="#">Измени податке о студенту</a>
            </div>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="{{ route('employee.showSchedule') }}">Распоред наставе</a>
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
    <div class="container pt-4">
        <div class="pb-3"></div>

        <table class="table" id="table_data">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-10">Студијски програм</th>
                <th class="col-md-2 text-center">Распоред</th>
            </tr>
            </thead>
            <tbody>
            @include('employee.schedule_data')
            </tbody>
        </table>
    </div>

    <!-- Modal Update Program Success Message -->
    <div class="modal" id="updateProgram_success" tabindex="-1" aria-labelledby="updateProgram_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте изменили студијски програм <br><span class="font-weight-bold">{{ Session::get('programName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Program Success Message -->
    <div class="modal" id="deleteProgram_success" tabindex="-1" aria-labelledby="deleteProgram_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте избрисали податке.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Program Failed Message -->
    <div class="modal" id="deleteProgram_failed" tabindex="-1" aria-labelledby="deleteProgram_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно брисање података. Покушајте поново.
                </div>
            </div>
        </div>
    </div>
@endsection

