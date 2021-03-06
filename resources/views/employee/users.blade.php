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
                <a class="dropdown-item active disabled" href="{{ route('employee.showUsers') }}">Прикажи студенте</a>
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
            <div class="col-md-4">
                <a href="{{ route('employee.createUser') }}" class="btn btn-success">Додај студента</a>
            </div>

            <div class="col-md-4">
                <input type="text" name="search" id="search" placeholder="Претрага" class="form-control text-center">
            </div>

            <div class="col-md-4 text-right">
                <a href="{{ route('employee.showUsers') }}" class="btn btn-danger">Поништи претрагу</a>
            </div>
        </div>

        <div class="pb-3"></div>

        <table class="table mb-0">
            <thead class="thead-blue">
                <tr>
                    <th class="col-md-2 text-center border-bottom-0">Име и презиме</th>
                    <th class="col-md-2 text-center border-bottom-0">Број индекса</th>
                    <th class="col-md-4 text-center border-bottom-0">Студијски програм</th>
                    <th class="col-md-2 text-center border-bottom-0">Година студија</th>
                    <th class="col-md-1 text-center border-bottom-0">ЕСПБ</th>
                    <th class="col-md-1 text-center border-bottom-0">Акција</th>
                </tr>
            </thead>
        </table>

        <div id="fetch_users_data">
             @include('employee.users_data')
        </div>
    </div>

    <!-- Modal Create User Success Message -->
    <div class="modal" id="createUser_success" tabindex="-1" aria-labelledby="createUser_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте додали студента <br><span class="font-weight-bold">{{ Session::get('userName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update User Success Message -->
    <div class="modal" id="updateUser_success" tabindex="-1" aria-labelledby="updateUser_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте изменили податке о студенту <br><span class="font-weight-bold">{{  Session::get('userName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete User Success Message -->
    <div class="modal" id="deleteUser_success" tabindex="-1" aria-labelledby="deleteUser_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте избрисали податке о студенту.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete User Failed Message -->
    <div class="modal" id="deleteUser_failed" tabindex="-1" aria-labelledby="deleteUser_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно брисање података о студенту. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/searchUsers.js') }}"></script>
@endsection

