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
                <a class="dropdown-item active disabled" href="{{ route('showRegisteredExam') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('showSuccessfullyExam') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('showUnsuccessfullyExam') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>

    <div class="container pt-4">
        <table class="table" id="table_data_filter">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-8">Предмет</th>
                <th class="col-md-2 text-center">Датум полагања</th>
                <th class="col-md-2 text-center">Време полагања</th>
            </tr>
            </thead>
            <tbody>
            @forelse($results as $result)
                <tr>
                    <td>{{ $result->exam->subject->name }}</td>
                    <td class="text-center">
                        {{ date('d.m.Y.', strtotime($result->exam->date)) }}
                    </td>
                    <td class="text-center">
                        {{ $result->exam->time }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Нема пријављених испита</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
