@extends('layouts.app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('home') }}">Огласна табла</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('showSubjects') }}">Моји предмети</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="{{ route('showSchedule') }}">Распоред наставе</a>
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
        <div class="row justify-content-end px-3">
            <button type="button" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#scheduleHours">
                Сатница
            </button>
        </div>

        <div class="modal fade" id="scheduleHours" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead class="bg-secondary" style="color: white">
                            <tr>
                                <th class="text-center">Час</th>
                                <th class="text-center">Време</th>
                                <th class="text-center">Пауза</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center">1.</td>
                                <td class="text-center">8,00 – 8,45</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">2.</td>
                                <td class="text-center">8,55 – 9,40</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">3.</td>
                                <td class="text-center">9,50 – 10,35</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">4.</td>
                                <td class="text-center">10,45 – 11,30</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">5.</td>
                                <td class="text-center">11,40 – 12,25</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">6.</td>
                                <td class="text-center">12,35 – 13,20</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">7.</td>
                                <td class="text-center">13,30 – 14,15</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">8.</td>
                                <td class="text-center">14,25 – 15,10</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">9.</td>
                                <td class="text-center">15,20 – 16,05</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">10.</td>
                                <td class="text-center">16,15 – 17,00</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">11.</td>
                                <td class="text-center">17,10 – 17,55</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">12.</td>
                                <td class="text-center">18,05 – 18,50</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="text-center">13.</td>
                                <td class="text-center">19,00 – 19,45</td>
                                <td class="text-center"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Затвори</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table" id="table_data_filter">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-6">Предмет</th>
                <th class="col-md-2 text-center">Дан</th>
                <th class="col-md-2 text-center">Почетак</th>
                <th class="col-md-2 text-center">Крај</th>
            </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                    <tr>
                        <td class="align-middle">{{ $schedule->name }}</td>
                        <td class="align-middle text-center">
                            @if($schedule->day == "monday")
                                Понедељак
                            @elseif($schedule->day == "tuesday")
                                Уторак
                            @elseif($schedule->day == "wednesday")
                                Среда
                            @elseif($schedule->day == "thrusday")
                                Четвртак
                            @elseif($schedule->day == "friday")
                                Петак
                            @endif
                        </td>
                        <td class="align-middle text-center">{{ $schedule->start }}</td>
                        <td class="align-middle text-center">{{ $schedule->end }}</td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="4">Распоред наставе није дефинисан</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
