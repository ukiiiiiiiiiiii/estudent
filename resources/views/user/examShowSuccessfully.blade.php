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
                <a class="dropdown-item" href="{{ route('showExams') }}">Распоред и пријава испита</a>
                <a class="dropdown-item" href="{{ route('showRegisteredExam') }}">Пријављени испити</a>
                <a class="dropdown-item active disabled" href="{{ route('showSuccessfullyExam') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('showUnsuccessfullyExam') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>

    <div class="container pt-4">
        <table class="table" id="table_data_filter">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-6">Предмет</th>
                <th class="col-md-1 text-center">Година</th>
                <th class="col-md-1 text-center">ЕСПБ</th>
                <th class="col-md-2 text-center">Датум полагања</th>
                <th class="col-md-2 text-center">Оцена</th>
            </tr>
            </thead>
            <tbody>
            @forelse($results as $result)
                <tr>
                    <td>{{ $result->exam->subject->name }}</td>
                    <td class="text-center">
                        {{ $result->exam->subject->grade }}
                    </td>
                    <td class="text-center">
                        {{ $result->exam->subject->espb }}
                    </td>
                    <td class="text-center">
                        {{ date('d.m.Y.', strtotime($result->exam->date)) }}
                    </td>
                    <td class="text-center">
                        {{ $result->result }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Нема положених испита</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
