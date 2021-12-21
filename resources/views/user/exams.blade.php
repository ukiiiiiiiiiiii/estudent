@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{-- route('employee.dashboard') --}}">Прикажи обавештења</a>
                <a class="dropdown-item" href="{{-- route('employee.createInformation') --}}">Креирај обавештење</a>
                <a class="dropdown-item disabled" href="#">Измени обавештење</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{ route('showExams') }}">Распоред и пријава испита</a>
                <a class="dropdown-item" href="{{ route('showRegisteredExam') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('showSuccessfullyExam') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('showUnsuccessfullyExam') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>

    <div class="container pt-4">
        <table class="table" id="table_data_filter">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-10">Предмет</th>
                <th class="col-md-2 text-center">Информације</th>
            </tr>
            </thead>
            <tbody>
                @forelse($exams as $exam)
                    <tr>
                        <td>{{ $exam->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('showExamInfo', ['examID' => $exam->id, 'subjectID' => $exam->subject_id]) }}" class="btn btn-sm btn-info">Информације</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Нема отворених пријава</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal Store Result Success Message -->
    <div class="modal" id="storeResult_success" tabindex="-1" aria-labelledby="storeResult_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте пријавили испит из предмета <br><span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Store Result Failed Message -->
    <div class="modal" id="storeResult_failed" tabindex="-1" aria-labelledby="storeResult_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешнa пријава испита. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Result Success Message -->
    <div class="modal" id="deleteResult_success" tabindex="-1" aria-labelledby="deleteResult_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте отказали испитну пријаву из предмета <br><span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Result Failed Message -->
    <div class="modal" id="deleteResult_failed" tabindex="-1" aria-labelledby="deleteResult_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешнa одјава испитне пријаве. Покушајте поново.
                </div>
            </div>
        </div>
    </div>
@endsection
