@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="{{ route('home') }}">Огласна табла</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('showSubjects') }}">Моји предмети</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('showExams') }}">Распоред и пријава испита</a>
                <a class="dropdown-item" href="{{ route('showRegisteredExam') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('showSuccessfullyExam') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('showUnsuccessfullyExam') }}">Неуспешна полагања</a>
            </div>
        </li>
        @if(Auth::user()->budget == "С")
            <li id="tab" class="nav-item mr-1">
                <a class="nav-link" href="{{ route('showScholarship') }}">Школарина</a>
            </li>
        @endif
    </ul>

    <div class="container pt-3">
        @forelse($information as $info)
            <div class="card mt-4 mb-4">
                <div class="card-header d-flex flex-row justify-content-between">
                    <div class="font-weight-bold text-uppercase pt-1">
                        {{ $info->created_at->format('d.m.Y.') }}
                    </div>
                </div>

                <div class="card-body pt-3">
                    <p class="card-text">{{ $info->text }}</p>
                </div>
            </div>
        @empty
            <div class="card mt-4">
                <div class="card-body text-center">Тренутно нема обавештења</div>
            </div>
        @endforelse
        {{ $information->links() }}
    </div>
@endsection
