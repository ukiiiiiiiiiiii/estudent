@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{-- route('employee.dashboard') --}}">Прикажи обавештења</a>
                <a class="dropdown-item" href="{{-- route('employee.createInformation') --}}">Креирај обавештење</a>
                <a class="dropdown-item disabled" href="#">Измени обавештење</a>
            </div>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('showExams') }}">Распоред испита</a>
                <a class="dropdown-item" href="{{-- route('employee.createProgram') --}}">Пријављени испити</a>
                <a class="dropdown-item disabled" href="#">Резултати испита</a>
            </div>
        </li>
    </ul>

    <div class="container pt-3">
        blaaaaaaaaaaah
    </div>
@endsection
