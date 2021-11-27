@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active" href="#">Прикажи обавештења</a>
                <a class="dropdown-item" href="#">Креирај обавештење</a>
                <a class="dropdown-item disabled" href="#">Измени обавештење</a>
            </div>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('employee.showPrograms') }}">Студијски програми</a>
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
    <div class="container pt-3">
        asasassa
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

    <!-- Modal Create Program Failed Message -->
    <div class="modal" id="createProgram_failed" tabindex="-1" aria-labelledby="createProgram_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно креирање студијског програма. Покушајте поново.
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

