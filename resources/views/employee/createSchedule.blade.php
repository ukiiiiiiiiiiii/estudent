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
            <a class="nav-link active" href="{{ route('employee.showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
    <div class="container pt-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row pl-3">
                    <a class="card-navigation-1" href="{{ route('employee.showSchedule') }}">Распоред наставе&nbsp</a>
                    <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                    <a class="card-navigation-2" href="#">{{ $program->name }}</a>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="navbar border-bottom">
                <ul class="nav nav-pills pb-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pills-I-tab" data-toggle="pill" href="#pills-I" role="tab" aria-controls="pills-I" aria-selected="true">I година</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-II-tab" data-toggle="pill" href="#pills-II" role="tab" aria-controls="pills-II" aria-selected="false">II година</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-III-tab" data-toggle="pill" href="#pills-III" role="tab" aria-controls="pills-III" aria-selected="false">III година</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="pills-IV-tab" data-toggle="pill" href="#pills-IV" role="tab" aria-controls="pills-IV" aria-selected="false">IV година</a>
                    </li>
                </ul>
                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#scheduleHours">
                        Сатница
                    </button>

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
                </div>

                <div class="tab-content pt-3" id="pills-tabContent">
                    {{-- I godina --}}
                    <div class="tab-pane show active" id="pills-I" role="tabpanel" aria-labelledby="pills-I-tab">
                        <table class="table" id="table_data_filter">
                            <thead class="thead-blue">
                            <tr>
                                <th class="col-md-6">Предмет</th>
                                <th class="col-md-2 text-center">Дан</th>
                                <th class="col-md-1 text-center">Почетак</th>
                                <th class="col-md-1 text-center">Крај</th>
                                <th class="col-md-2 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedules as $schedule)
                            <tr>
                                <td>{{ $schedule->name }}</td>
                                <td class="text-center">
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
                                <td class="text-center">{{ $schedule->start }}</td>
                                <td class="text-center">{{ $schedule->end }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$schedule->id}}">Обриши</button>

                                    <div class="modal fade" id="ModalDelete{{$schedule->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$schedule->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                    Да ли сте сигурни да желите да обришете распоред за предмет <br><b>{{$schedule->name}}</b>?
                                                </div>
                                                <div class="modal-footer" style="padding-top: 0.40rem">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                    <a href="{{ route('employee.destroySchedule', ['scheduleID' => $schedule->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Нема заказане наставе</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeSchedule') }}" method="POST">
                        @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи наставу
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id') is-invalid @enderror" name="subject_id" id="subject_id">
                                            <option {{ old('subject_id') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects as $subject)
                                                @if($subject->grade == 1)
                                                    <option {{ old('subject_id') == $subject->id ? "selected" : "" }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="day" class="col-md-4 col-form-label text-md-right">Дан</label>
                                        <select class="text-center col-md-4 form-control @error('day') is-invalid @enderror" name="day" id="day">
                                            <option value="" selected>Изабери дан</option>
                                            <option value="monday">Понедељак</option>
                                            <option value="tuesday">Уторак</option>
                                            <option value="wednesday">Среда</option>
                                            <option value="thrusday">Четвртак</option>
                                            <option value="friday">Петак</option>
                                        </select>

                                        @error('day')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="start" class="col-md-4 col-form-label text-md-right">од</label>
                                        <select class="text-center col-md-4 form-control @error('start') is-invalid @enderror" name="start" id="start">
                                            <option value="" selected>Изабери час</option>
                                            <option value="1">1. часа</option>
                                            <option value="2">2. часа</option>
                                            <option value="3">3. часа</option>
                                            <option value="4">4. часа</option>
                                            <option value="5">5. часа</option>
                                            <option value="6">6. часа</option>
                                            <option value="7">7. часа</option>
                                            <option value="8">8. часа</option>
                                            <option value="9">9. часа</option>
                                            <option value="10">10. часа</option>
                                            <option value="11">11. часа</option>
                                            <option value="12">12. часа</option>
                                            <option value="13">13. часа</option>
                                        </select>

                                        @error('start')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="end" class="col-md-4 col-form-label text-md-right">до</label>
                                        <select class="text-center col-md-4 form-control @error('end') is-invalid @enderror" name="end" id="end" disabled>
                                            <option value="" selected>Изабери час</option>
                                            <option value="1" id="end1">1. часа</option>
                                            <option value="2" id="end2">2. часа</option>
                                            <option value="3" id="end3">3. часа</option>
                                            <option value="4" id="end4">4. часа</option>
                                            <option value="5" id="end5">5. часа</option>
                                            <option value="6" id="end6">6. часа</option>
                                            <option value="7" id="end7">7. часа</option>
                                            <option value="8" id="end8">8. часа</option>
                                            <option value="9" id="end9">9. часа</option>
                                            <option value="10" id="end10">10. часа</option>
                                            <option value="11" id="end11">11. часа</option>
                                            <option value="12" id="end12">12. часа</option>
                                            <option value="13" id="end13">13. часа</option>
                                            <option value="14" id="end14">14. часа</option>
                                        </select>

                                        @error('end')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <input type="text" value="{{ $program->id }}" id="program_id" name="program_id" hidden>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="setOldTab(1)">Потврди</button>
                                </div>
                            </div>
                            <input type="text" id="oldTab" name="oldTab" value="{{ old('oldTab') }}" hidden>
                        </form>
                    </div>

                    {{-- II godina --}}
                    <div class="tab-pane" id="pills-II" role="tabpanel" aria-labelledby="pills-II-tab">
                        <table class="table" id="table_data_filter">
                            <thead class="thead-blue">
                            <tr>
                                <th class="col-md-6">Предмет</th>
                                <th class="col-md-2 text-center">Дан</th>
                                <th class="col-md-1 text-center">Почетак</th>
                                <th class="col-md-1 text-center">Крај</th>
                                <th class="col-md-2 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedules2 as $schedule2)
                                <tr>
                                    <td>{{ $schedule2->name }}</td>
                                    <td class="text-center">
                                        @if($schedule2->day == "monday")
                                            Понедељак
                                        @elseif($schedule2->day == "tuesday")
                                            Уторак
                                        @elseif($schedule2->day == "wednesday")
                                            Среда
                                        @elseif($schedule2->day == "thrusday")
                                            Четвртак
                                        @elseif($schedule2->day == "friday")
                                            Петак
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $schedule2->start }}</td>
                                    <td class="text-center">{{ $schedule2->end }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$schedule2->id}}">Обриши</button>

                                        <div class="modal fade" id="ModalDelete{{$schedule2->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$schedule2->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да обришете распоред за предмет <br><b>{{$schedule2->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.destroySchedule', ['scheduleID' => $schedule2->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Нема заказане наставе</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeSchedule2') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи наставу
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id2" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id2') is-invalid @enderror" name="subject_id2" id="subject_id2">
                                            <option {{ old('subject_id2') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects2 as $subject2)
                                                @if($subject2->grade == 2)
                                                    <option {{ old('subject_id2') == $subject2->id ? "selected" : "" }} value="{{ $subject2->id }}">{{ $subject2->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="day2" class="col-md-4 col-form-label text-md-right">Дан</label>
                                        <select class="text-center col-md-4 form-control @error('day2') is-invalid @enderror" name="day2" id="day2">
                                            <option value="" selected>Изабери дан</option>
                                            <option value="monday">Понедељак</option>
                                            <option value="tuesday">Уторак</option>
                                            <option value="wednesday">Среда</option>
                                            <option value="thrusday">Четвртак</option>
                                            <option value="friday">Петак</option>
                                        </select>

                                        @error('day2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="startSecond" class="col-md-4 col-form-label text-md-right">од</label>
                                        <select class="text-center col-md-4 form-control @error('start2') is-invalid @enderror" name="start2" id="startSecond">
                                            <option value="" selected>Изабери час</option>
                                            <option value="1">1. часа</option>
                                            <option value="2">2. часа</option>
                                            <option value="3">3. часа</option>
                                            <option value="4">4. часа</option>
                                            <option value="5">5. часа</option>
                                            <option value="6">6. часа</option>
                                            <option value="7">7. часа</option>
                                            <option value="8">8. часа</option>
                                            <option value="9">9. часа</option>
                                            <option value="10">10. часа</option>
                                            <option value="11">11. часа</option>
                                            <option value="12">12. часа</option>
                                            <option value="13">13. часа</option>
                                        </select>

                                        @error('start2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="endSecond" class="col-md-4 col-form-label text-md-right">до</label>
                                        <select class="text-center col-md-4 form-control @error('end2') is-invalid @enderror" name="end2" id="endSecond" disabled>
                                            <option value="" selected>Изабери час</option>
                                            <option value="1" id="endSecond1">1. часа</option>
                                            <option value="2" id="endSecond2">2. часа</option>
                                            <option value="3" id="endSecond3">3. часа</option>
                                            <option value="4" id="endSecond4">4. часа</option>
                                            <option value="5" id="endSecond5">5. часа</option>
                                            <option value="6" id="endSecond6">6. часа</option>
                                            <option value="7" id="endSecond7">7. часа</option>
                                            <option value="8" id="endSecond8">8. часа</option>
                                            <option value="9" id="endSecond9">9. часа</option>
                                            <option value="10" id="endSecond10">10. часа</option>
                                            <option value="11" id="endSecond11">11. часа</option>
                                            <option value="12" id="endSecond12">12. часа</option>
                                            <option value="13" id="endSecond13">13. часа</option>
                                            <option value="14" id="endSecond14">14. часа</option>
                                        </select>

                                        @error('end2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <input type="text" value="{{ $program->id }}" id="program_id" name="program_id" hidden>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="setOldTab(2)">Потврди</button>
                                </div>
                            </div>
                            <input type="text" id="oldTab2" name="oldTab2" value="{{ old('oldTab2') }}" hidden>
                        </form>
                    </div>

                    {{-- III godina --}}
                    <div class="tab-pane" id="pills-III" role="tabpanel" aria-labelledby="pills-III-tab">
                        <table class="table" id="table_data_filter">
                            <thead class="thead-blue">
                            <tr>
                                <th class="col-md-6">Предмет</th>
                                <th class="col-md-2 text-center">Дан</th>
                                <th class="col-md-1 text-center">Почетак</th>
                                <th class="col-md-1 text-center">Крај</th>
                                <th class="col-md-2 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedules3 as $schedule3)
                                <tr>
                                    <td>{{ $schedule3->name }}</td>
                                    <td class="text-center">
                                        @if($schedule3->day == "monday")
                                            Понедељак
                                        @elseif($schedule3->day == "tuesday")
                                            Уторак
                                        @elseif($schedule3->day == "wednesday")
                                            Среда
                                        @elseif($schedule3->day == "thrusday")
                                            Четвртак
                                        @elseif($schedule3->day == "friday")
                                            Петак
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $schedule3->start }}</td>
                                    <td class="text-center">{{ $schedule3->end }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$schedule3->id}}">Обриши</button>

                                        <div class="modal fade" id="ModalDelete{{$schedule3->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$schedule3->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да обришете распоред за предмет <br><b>{{$schedule3->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.destroySchedule', ['scheduleID' => $schedule3->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Нема заказане наставе</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeSchedule3') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи наставу
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id3" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id3') is-invalid @enderror" name="subject_id3" id="subject_id3">
                                            <option {{ old('subject_id3') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects3 as $subject3)
                                                @if($subject3->grade == 3)
                                                    <option {{ old('subject_id3') == $subject3->id ? "selected" : "" }} value="{{ $subject3->id }}">{{ $subject3->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="day3" class="col-md-4 col-form-label text-md-right">Дан</label>
                                        <select class="text-center col-md-4 form-control @error('day3') is-invalid @enderror" name="day3" id="day3">
                                            <option value="" selected>Изабери дан</option>
                                            <option value="monday">Понедељак</option>
                                            <option value="tuesday">Уторак</option>
                                            <option value="wednesday">Среда</option>
                                            <option value="thrusday">Четвртак</option>
                                            <option value="friday">Петак</option>
                                        </select>

                                        @error('day3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="startТhird" class="col-md-4 col-form-label text-md-right">од</label>
                                        <select class="text-center col-md-4 form-control @error('start3') is-invalid @enderror" name="start3" id="startThird">
                                            <option value="" selected>Изабери час</option>
                                            <option value="1">1. часа</option>
                                            <option value="2">2. часа</option>
                                            <option value="3">3. часа</option>
                                            <option value="4">4. часа</option>
                                            <option value="5">5. часа</option>
                                            <option value="6">6. часа</option>
                                            <option value="7">7. часа</option>
                                            <option value="8">8. часа</option>
                                            <option value="9">9. часа</option>
                                            <option value="10">10. часа</option>
                                            <option value="11">11. часа</option>
                                            <option value="12">12. часа</option>
                                            <option value="13">13. часа</option>
                                        </select>

                                        @error('start3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="endThird" class="col-md-4 col-form-label text-md-right">до</label>
                                        <select class="text-center col-md-4 form-control @error('end3') is-invalid @enderror" name="end3" id="endThird" disabled>
                                            <option value="" selected>Изабери час</option>
                                            <option value="1" id="endThird1">1. часа</option>
                                            <option value="2" id="endThird2">2. часа</option>
                                            <option value="3" id="endThird3">3. часа</option>
                                            <option value="4" id="endThird4">4. часа</option>
                                            <option value="5" id="endThird5">5. часа</option>
                                            <option value="6" id="endThird6">6. часа</option>
                                            <option value="7" id="endThird7">7. часа</option>
                                            <option value="8" id="endThird8">8. часа</option>
                                            <option value="9" id="endThird9">9. часа</option>
                                            <option value="10" id="endThird10">10. часа</option>
                                            <option value="11" id="endThird11">11. часа</option>
                                            <option value="12" id="endThird12">12. часа</option>
                                            <option value="13" id="endThird13">13. часа</option>
                                            <option value="14" id="endThird14">14. часа</option>
                                        </select>

                                        @error('end3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <input type="text" value="{{ $program->id }}" id="program_id" name="program_id" hidden>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="setOldTab(3)">Потврди</button>
                                </div>
                            </div>
                            <input type="text" id="oldTab3" name="oldTab3" value="{{ old('oldTab3') }}" hidden>
                        </form>
                    </div>

                    {{-- IV godina --}}
                    <div class="tab-pane" id="pills-IV" role="tabpanel" aria-labelledby="pills-IV-tab">
                        <table class="table" id="table_data_filter">
                            <thead class="thead-blue">
                            <tr>
                                <th class="col-md-6">Предмет</th>
                                <th class="col-md-2 text-center">Дан</th>
                                <th class="col-md-1 text-center">Почетак</th>
                                <th class="col-md-1 text-center">Крај</th>
                                <th class="col-md-2 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($schedules4 as $schedule4)
                                <tr>
                                    <td>{{ $schedule4->name }}</td>
                                    <td class="text-center">
                                        @if($schedule4->day == "monday")
                                            Понедељак
                                        @elseif($schedule4->day == "tuesday")
                                            Уторак
                                        @elseif($schedule4->day == "wednesday")
                                            Среда
                                        @elseif($schedule4->day == "thrusday")
                                            Четвртак
                                        @elseif($schedule4->day == "friday")
                                            Петак
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $schedule4->start }}</td>
                                    <td class="text-center">{{ $schedule4->end }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$schedule4->id}}">Обриши</button>

                                        <div class="modal fade" id="ModalDelete{{$schedule4->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$schedule4->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да обришете распоред за предмет <br><b>{{$schedule4->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.destroySchedule', ['scheduleID' => $schedule4->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Нема заказане наставе</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeSchedule4') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи наставу
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id4" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id4') is-invalid @enderror" name="subject_id4" id="subject_id4">
                                            <option {{ old('subject_id4') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects4 as $subject4)
                                                @if($subject4->grade == 4)
                                                    <option {{ old('subject_id4') == $subject4->id ? "selected" : "" }} value="{{ $subject4->id }}">{{ $subject4->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="day4" class="col-md-4 col-form-label text-md-right">Дан</label>
                                        <select class="text-center col-md-4 form-control @error('day4') is-invalid @enderror" name="day4" id="day4">
                                            <option value="" selected>Изабери дан</option>
                                            <option value="monday">Понедељак</option>
                                            <option value="tuesday">Уторак</option>
                                            <option value="wednesday">Среда</option>
                                            <option value="thrusday">Четвртак</option>
                                            <option value="friday">Петак</option>
                                        </select>

                                        @error('day4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="startFourth" class="col-md-4 col-form-label text-md-right">од</label>
                                        <select class="text-center col-md-4 form-control @error('start4') is-invalid @enderror" name="start4" id="startFourth">
                                            <option value="" selected>Изабери час</option>
                                            <option value="1">1. часа</option>
                                            <option value="2">2. часа</option>
                                            <option value="3">3. часа</option>
                                            <option value="4">4. часа</option>
                                            <option value="5">5. часа</option>
                                            <option value="6">6. часа</option>
                                            <option value="7">7. часа</option>
                                            <option value="8">8. часа</option>
                                            <option value="9">9. часа</option>
                                            <option value="10">10. часа</option>
                                            <option value="11">11. часа</option>
                                            <option value="12">12. часа</option>
                                            <option value="13">13. часа</option>
                                        </select>

                                        @error('start4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="endFourth" class="col-md-4 col-form-label text-md-right">до</label>
                                        <select class="text-center col-md-4 form-control @error('end4') is-invalid @enderror" name="end4" id="endFourth" disabled>
                                            <option value="" selected>Изабери час</option>
                                            <option value="1" id="endFourth1">1. часа</option>
                                            <option value="2" id="endFourth2">2. часа</option>
                                            <option value="3" id="endFourth3">3. часа</option>
                                            <option value="4" id="endFourth4">4. часа</option>
                                            <option value="5" id="endFourth5">5. часа</option>
                                            <option value="6" id="endFourth6">6. часа</option>
                                            <option value="7" id="endFourth7">7. часа</option>
                                            <option value="8" id="endFourth8">8. часа</option>
                                            <option value="9" id="endFourth9">9. часа</option>
                                            <option value="10" id="endFourth10">10. часа</option>
                                            <option value="11" id="endFourth11">11. часа</option>
                                            <option value="12" id="endFourth12">12. часа</option>
                                            <option value="13" id="endFourth13">13. часа</option>
                                            <option value="14" id="endFourth14">14. часа</option>
                                        </select>

                                        @error('end4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <input type="text" value="{{ $program->id }}" id="program_id" name="program_id" hidden>
                                </div>
                                <div class="card-footer text-muted text-center">
                                    <button type="submit" class="btn btn-success btn-sm" onclick="setOldTab(4)">Потврди</button>
                                </div>
                            </div>
                            <input type="text" id="oldTab4" name="oldTab4" value="{{ old('oldTab4') }}" hidden>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Schedule Success Message -->
    <div class="modal" id="createSchedule_success" tabindex="-1" aria-labelledby="createSchedule_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте креирали распоред наставе за предмет<br> <span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Schedule Failed Message -->
    <div class="modal" id="createSchedule_failed" tabindex="-1" aria-labelledby="createSchedule_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно креирање распореда. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Schedule Success Message -->
    <div class="modal" id="deleteSchedule_success" tabindex="-1" aria-labelledby="deleteSchedule_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте избрисали распоред наставе за предмет<br> <span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Schedule Failed Message -->
    <div class="modal" id="deleteSchedule_failed" tabindex="-1" aria-labelledby="deleteSchedule_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно брисање распореда. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <input type="text" id="subjectGrade" value="{{Session::get('subjectGrade')}}" hidden>
    <script>
        function setOldTab(value) {
            if (value == 1) {
                $("#oldTab").val(value);
            } else if(value == 2) {
                $("#oldTab2").val(value);
            } else if(value == 3) {
                $("#oldTab3").val(value);
            } else if(value == 4) {
                $("#oldTab4").val(value);
            }
        }

        var oldTab = $("#oldTab").val();
        var oldTab2 = $("#oldTab2").val();
        var oldTab3 = $("#oldTab3").val();
        var oldTab4 = $("#oldTab4").val();


        var grade = $("#subjectGrade").val();

        if (oldTab == 1) {
            $('#pills-tab a[href="#pills-I"]').tab('show')
        } else if (oldTab2 == 2) {
            $('#pills-tab a[href="#pills-II"]').tab('show')
        } else if (oldTab3 == 3) {
            $('#pills-tab a[href="#pills-III"]').tab('show')
        } else if (oldTab4 == 4) {
            $('#pills-tab a[href="#pills-IV"]').tab('show')
        }
        else {
            if (grade == "") {
                $('#pills-tab a[href="#pills-I"]').tab('show')
            } else if (grade == 1) {
                $('#pills-tab a[href="#pills-I"]').tab('show')
            } else if (grade == 2) {
                $('#pills-tab a[href="#pills-II"]').tab('show')
            } else if (grade == 3) {
                $('#pills-tab a[href="#pills-III"]').tab('show')
            } else if (grade == 4) {
                $('#pills-tab a[href="#pills-IV"]').tab('show')
            }
        }

        $("#start").change(function() {
            var startValue = $("#start").val();
            var resetValue = 13;

            if (startValue == "") {
                $("#end").val("");
                $("#end").attr( "disabled", true);
            } else {
                $("#end").val("");
                $("#end").attr( "disabled", false);
            }

            if (startValue == 13) {
                $("#end").val(14);
            }

            while (resetValue > 0) {
                $("#end" + resetValue).attr( "disabled", false).css('background-color', 'white');
                resetValue--;
            }

            while (startValue > 0) {
                $("#end" + startValue).attr( "disabled", true).css('background-color', '#E9ECEF');
                startValue--;
            }
        })

        $("#startSecond").change(function() {
            var startValue = $("#startSecond").val();
            var resetValue = 13;

            if (startValue == "") {
                $("#endSecond").val("");
                $("#endSecond").attr( "disabled", true);
            } else {
                $("#endSecond").val("");
                $("#endSecond").attr( "disabled", false);
            }

            if (startValue == 13) {
                $("#endSecond").val(14);
            }

            while (resetValue > 0) {
                $("#endSecond" + resetValue).attr( "disabled", false).css('background-color', 'white');
                resetValue--;
            }

            while (startValue > 0) {
                $("#endSecond" + startValue).attr( "disabled", true).css('background-color', '#E9ECEF');
                startValue--;
            }
        })

        $("#startThird").change(function() {
            var startValue = $("#startThird").val();
            var resetValue = 13;

            if (startValue == "") {
                $("#endThird").val("");
                $("#endThird").attr( "disabled", true);
            } else {
                $("#endThird").val("");
                $("#endThird").attr( "disabled", false);
            }

            if (startValue == 13) {
                $("#endThird").val(14);
            }

            while (resetValue > 0) {
                $("#endThird" + resetValue).attr( "disabled", false).css('background-color', 'white');
                resetValue--;
            }

            while (startValue > 0) {
                $("#endThird" + startValue).attr( "disabled", true).css('background-color', '#E9ECEF');
                startValue--;
            }
        })

        $("#startFourth").change(function() {
            var startValue = $("#startFourth").val();
            var resetValue = 13;

            if (startValue == "") {
                $("#endFourth").val("");
                $("#endFourth").attr( "disabled", true);
            } else {
                $("#endFourth").val("");
                $("#endFourth").attr( "disabled", false);
            }

            if (startValue == 13) {
                $("#endFourth").val(14);
            }

            while (resetValue > 0) {
                $("#endFourth" + resetValue).attr( "disabled", false).css('background-color', 'white');
                resetValue--;
            }

            while (startValue > 0) {
                $("#endFourth" + startValue).attr( "disabled", true).css('background-color', '#E9ECEF');
                startValue--;
            }
        })
    </script>
@endsection

