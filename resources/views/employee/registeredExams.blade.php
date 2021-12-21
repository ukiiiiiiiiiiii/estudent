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
            <a class="nav-link" href="{{ route('employee.showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{ route('employee.showExams') }}">Распоред испита</a>
                <a class="dropdown-item" href="{{ route('employee.showRegisteredExams') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{-- route('employee.createUser') --}}">Положени испити</a>
                <a class="dropdown-item" href="{{-- route('employee.createUser') --}}">Неуспешна полагања</a>
                {{--
                <a class="dropdown-item disabled" href="#">Измени податке о студенту</a>
                --}}
            </div>
        </li>
    </ul>
    <div class="container pt-4">
        <div class="pb-3"></div>

        <table class="table" id="table_data">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-10">Студијски програм</th>
                <th class="col-md-2 text-center">Пријаве</th>
            </tr>
            </thead>
            <tbody>
                @forelse($programs as $program)
                    <tr>
                        <td class="pt-3">{{ $program->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('employee.createExam', ['id' => $program->id]) }}" class="btn btn-sm btn-info">Прикажи</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">
                            Нема резултата претраге
                        </td>
                    </tr>
                @endforelse
                <tr>
                    <td colspan="2">{{ $programs->links() }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection

