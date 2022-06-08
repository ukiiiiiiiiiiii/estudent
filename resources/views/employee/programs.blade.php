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
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студијски програми</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{ route('employee.showPrograms') }}">Прикажи студијске програме</a>
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
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('employee.createProgram') }}" class="btn btn-success">Креирај студијски програм</a>
            </div>

            <div class="col-md-3"></div>
            <div class="col-md-3">
                <input type="text" name="search" id="search" placeholder="Претрага" class="form-control">
            </div>
        </div>

        <div class="pb-3"></div>

        <table class="table" id="table_data">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-10 sorting" data-sorting_type="desc" data-column_name="name" style="cursor: pointer"><span id="name_icon"><i class="fas fa-sort pr-1"></i></span>Назив студијског програма</th>
                <th class="col-md-2 text-center">Акција</th>
            </tr>
            </thead>
            <tbody>
            @include('employee.programs_data')
            </tbody>
        </table>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1">
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name">
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc">
    </div>

    <!-- Modal Create Program Success Message -->
    <div class="modal" id="createProgram_success" tabindex="-1" aria-labelledby="createProgram_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте креирали студијски програм <br><span class="font-weight-bold">{{ Session::get('programName') }}</span>.
                </div>
            </div>
        </div>
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
                    Успешно сте избрисали податке о изабраном студијском програму.
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

    <script src="{{ asset('js/searchPrograms.js') }}"></script>
@endsection

