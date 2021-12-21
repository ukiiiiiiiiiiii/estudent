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
        <div class="card">
            <div class="card-header">
                <div class="row pl-3">
                    <a class="card-navigation-1" href="{{ route('showExams') }}">Распоред испита&nbsp</a>
                    <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                    <a class="card-navigation-2" href="#">{{$result->exam->subject->name}}</a>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-md-6 text-md-right">Предмет</div>

                    <div class="col-md-6 font-weight-bold">
                        {{$result->exam->subject->name}}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 text-md-right">Година</div>

                    <div class="col-md-6 font-weight-bold">
                        {{$result->exam->subject->grade}}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 text-md-right">ЕСПБ</div>

                    <div class="col-md-6 font-weight-bold">
                        {{$result->exam->subject->espb}}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 text-md-right">Датум полагања</div>

                    <div class="col-md-6 font-weight-bold">
                        {{ date('d.m.Y.', strtotime($result->exam->date)) }} године
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 text-md-right">Време полагања</div>

                    <div class="col-md-6 font-weight-bold">
                        {{ $result->exam->time }} часова
                    </div>
                </div>

                <div class="row pt-2 pb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 text-center">
                        <a href="{{ route('destroyResult', ['resultID' => $result->id, 'subjectID' => $result->exam->subject->id]) }}" class="btn btn-danger btn-sm">Откажи пријаву</a>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
