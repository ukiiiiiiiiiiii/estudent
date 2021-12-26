@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('home') }}">Огласна табла</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="{{ route('showSubjects') }}">Моји предмети</a>
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
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-I-tab" data-toggle="pill" href="#pills-I" role="tab" aria-controls="pills-I" aria-selected="true">I година</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-II-tab" data-toggle="pill" href="#pills-II" role="tab" aria-controls="pills-II" aria-selected="false">II година</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-III-tab" data-toggle="pill" href="#pills-III" role="tab" aria-controls="pills-III" aria-selected="false">III година</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-IV-tab" data-toggle="pill" href="#pills-IV" role="tab" aria-controls="pills-IV" aria-selected="false">IV година</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active offset-md-2" id="pills-I" role="tabpanel" aria-labelledby="pills-I-tab" style="max-width: 700px">
                <table class="table" id="table_data_filter">
                    <thead class="thead-blue">
                    <tr>
                        <th class="col-md-10">Назив предмета</th>
                        <th class="col-md-2 text-center">ЕСПБ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subjects1 as $subject1)
                        <tr>
                            <td class="align-middle">{{ $subject1->name }}</td>
                            <td class="align-middle text-center">{{ $subject1->espb }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="2">Предмети нису дефинисани</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade offset-md-2" id="pills-II" role="tabpanel" aria-labelledby="pills-II-tab" style="max-width: 700px">
                <table class="table" id="table_data_filter">
                    <thead class="thead-blue">
                    <tr>
                        <th class="col-md-10">Назив предмета</th>
                        <th class="col-md-2 text-center">ЕСПБ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subjects2 as $subject2)
                        <tr>
                            <td class="align-middle">{{ $subject2->name }}</td>
                            <td class="align-middle text-center">{{ $subject2->espb }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="2">Предмети нису дефинисани</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade offset-md-2" id="pills-III" role="tabpanel" aria-labelledby="pills-III-tab" style="max-width: 700px">
                <table class="table" id="table_data_filter">
                    <thead class="thead-blue">
                    <tr>
                        <th class="col-md-10">Назив предмета</th>
                        <th class="col-md-2 text-center">ЕСПБ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subjects3 as $subject3)
                        <tr>
                            <td class="align-middle">{{ $subject3->name }}</td>
                            <td class="align-middle text-center">{{ $subject3->espb }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="2">Предмети нису дефинисани</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade offset-md-2" id="pills-IV" role="tabpanel" aria-labelledby="pills-IV-tab" style="max-width: 700px">
                <table class="table" id="table_data_filter">
                    <thead class="thead-blue">
                    <tr>
                        <th class="col-md-10">Назив предмета</th>
                        <th class="col-md-2 text-center">ЕСПБ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($subjects4 as $subject4)
                        <tr>
                            <td class="align-middle">{{ $subject4->name }}</td>
                            <td class="align-middle text-center">{{ $subject4->espb }}</td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="2">Предмети нису дефинисани</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
