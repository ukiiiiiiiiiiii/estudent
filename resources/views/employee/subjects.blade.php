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
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Предмети</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{ route('employee.showSubjects') }}">Прикажи предмете</a>
                <a class="dropdown-item" href="{{ route('employee.createSubject') }}">Креирај предмет</a>
                <a class="dropdown-item disabled" href="#">Измени предмет</a>
            </div>
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
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-6">
                <a href="{{ route('employee.createSubject') }}" class="btn btn-success">Креирај предмет</a>
            </div>

            <div class="col-md-3"></div>
            <div class="col-md-3">
                <input type="text" name="search" id="search" placeholder="Претрага" class="form-control">
            </div>
        </div>

        <div class="pb-3"></div>

        <table class="table mb-0">
            <thead class="thead-blue">
                <tr>
                    <th class="col-md-3 text-center border-bottom-0">Назив предмета</th>
                    <th class="col-md-4 text-center border-bottom-0">Студијски програм</th>
                    <th class="col-md-2 text-center border-bottom-0">Година студија</th>
                    <th class="col-md-2 text-center border-bottom-0">ЕСПБ</th>
                    <th class="col-md-1 text-center border-bottom-0">Акција</th>
                </tr>
            </thead>
        </table>

        <div id="fetch_subjects_data">
            @include('employee.subjects_data')
        </div>
    </div>

    <!-- Modal Create Subject Success Message -->
    <div class="modal" id="createSubject_success" tabindex="-1" aria-labelledby="createSubject_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте креирали предмет <br><span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Subject Success Message -->
    <div class="modal" id="updateSubject_success" tabindex="-1" aria-labelledby="updateSubject_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте изменили предмет <br><span class="font-weight-bold">{{-- Session::get('programName') --}}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Subject Success Message -->
    <div class="modal" id="deleteSubject_success" tabindex="-1" aria-labelledby="deleteSubject_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте избрисали податке о предмету.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Subject Failed Message -->
    <div class="modal" id="deleteSubject_failed" tabindex="-1" aria-labelledby="deleteSubject_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно брисање података о предмету. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/searchSubjects.js') }}"></script>
@endsection

