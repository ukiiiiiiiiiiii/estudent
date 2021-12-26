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
                <a class="dropdown-item" href="{{ route('employee.showPassedExams') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('employee.showUnsuccessfullyExams') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>
    <div class="container pt-4">
        <div class="card mb-4">
            <div class="card-header">
                <div class="row pl-3">
                    <a class="card-navigation-1" href="{{ route('employee.showExams') }}">Распоред испита&nbsp</a>
                    <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                    <a class="card-navigation-2" href="#">{{ $program->name }}</a>
                </div>
            </div>
            <div class="card-body pt-2">
                <div class="navbar justify-content-center border-bottom">
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
                </div>

                <div class="tab-content pt-3" id="pills-tabContent">
                    {{-- I godina --}}
                    <div class="tab-pane show active" id="pills-I" role="tabpanel" aria-labelledby="pills-I-tab">
                        <table class="table" id="table_data_filter">
                            <thead class="thead-blue">
                            <tr>
                                <th class="col-md-6">Предмет</th>
                                <th class="col-md-2 text-center">Датум</th>
                                <th class="col-md-1 text-center">Време</th>
                                <th class="col-md-3 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exams as $exam)
                            <tr>
                                <td>{{ $exam->name }}</td>
                                <td class="text-center">{{ date('d.m.Y.', strtotime($exam->date)) }}</td>
                                <td class="text-center">{{ $exam->time }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalUpdate{{$exam->id}}">Затвори пријаву испита</button>

                                    <div class="modal fade" id="ModalUpdate{{$exam->id}}" tabindex="-1" aria-labelledby="ModalUpdate{{$exam->id}}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                    Да ли сте сигурни да желите да затворите пријаву испита за предмет <b>{{$exam->name}}</b>?
                                                </div>
                                                <div class="modal-footer" style="padding-top: 0.40rem">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                    <a href="{{ route('employee.updateExam', ['examID' => $exam->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Затвори пријаву испита</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Нема заказаних испита</td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeExam') }}" method="POST">
                        @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи испит
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id-exam" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id_exam') is-invalid @enderror" name="subject_id_exam" id="subject_id_exam">
                                            <option {{ old('subject_id_exam') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects as $subject)
                                                @if($subject->grade == 1)
                                                    <option {{ old('subject_id_exam') == $subject->id ? "selected" : "" }} value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id_exam')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="date" class="col-md-4 col-form-label text-md-right">Датум</label>
                                        <input type="text" class="col-md-4 form-control datepicker bg-white text-center @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" readonly placeholder="--.--.----">

                                        @error('date')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="time" class="col-md-4 col-form-label text-md-right">Време</label>
                                        <input type="time" class="col-md-4 form-control text-center @error('time') is-invalid @enderror" id="time" name="time">

                                        @error('time')
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
                                <th class="col-md-2 text-center">Датум</th>
                                <th class="col-md-1 text-center">Време</th>
                                <th class="col-md-3 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exams2 as $exam2)
                                <tr>
                                    <td>{{ $exam2->name }}</td>
                                    <td class="text-center">{{ date('d.m.Y.', strtotime($exam2->date)) }}</td>
                                    <td class="text-center">{{ $exam2->time }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalUpdate{{$exam2->id}}">Затвори пријаву испита</button>

                                        <div class="modal fade" id="ModalUpdate{{$exam2->id}}" tabindex="-1" aria-labelledby="ModalUpdate{{$exam2->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да затворите пријаву испита за предмет <b>{{$exam2->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.updateExam', ['examID' => $exam2->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Затвори пријаву испита</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Нема заказаних испита</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeExam2') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи испит
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id_exam2" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id_exam2') is-invalid @enderror" name="subject_id_exam2" id="subject_id_exam2">
                                            <option {{ old('subject_id_exam2') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects2 as $subject2)
                                                @if($subject2->grade == 2)
                                                    <option {{ old('subject_id_exam2') == $subject2->id ? "selected" : "" }} value="{{ $subject2->id }}">{{ $subject2->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id_exam2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="date2" class="col-md-4 col-form-label text-md-right">Датум</label>
                                        <input type="text" class="col-md-4 form-control datepicker bg-white text-center @error('date2') is-invalid @enderror" id="date2" name="date2" value="{{ old('date2') }}" readonly placeholder="--.--.----">

                                        @error('date2')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="time2" class="col-md-4 col-form-label text-md-right">Време</label>
                                        <input type="time" class="col-md-4 form-control text-center @error('time2') is-invalid @enderror" id="time2" name="time2">

                                        @error('time2')
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
                                <th class="col-md-2 text-center">Датум</th>
                                <th class="col-md-1 text-center">Време</th>
                                <th class="col-md-3 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exams3 as $exam3)
                                <tr>
                                    <td>{{ $exam3->name }}</td>
                                    <td class="text-center">{{ date('d.m.Y.', strtotime($exam3->date)) }}</td>
                                    <td class="text-center">{{ $exam3->time }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalUpdate{{$exam3->id}}">Затвори пријаву испита</button>

                                        <div class="modal fade" id="ModalUpdate{{$exam3->id}}" tabindex="-1" aria-labelledby="ModalUpdate{{$exam3->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да затворите пријаву испита за предмет <b>{{$exam3->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.updateExam', ['examID' => $exam3->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Затвори пријаву испита</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Нема заказаних испита</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeExam3') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи испит
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id-exam3" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id_exam3') is-invalid @enderror" name="subject_id_exam3" id="subject_id_exam3">
                                            <option {{ old('subject_id_exam3') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects3 as $subject3)
                                                @if($subject3->grade == 3)
                                                    <option {{ old('subject_id_exam3') == $subject3->id ? "selected" : "" }} value="{{ $subject3->id }}">{{ $subject3->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id_exam3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="date3" class="col-md-4 col-form-label text-md-right">Датум</label>
                                        <input type="text" class="col-md-4 form-control datepicker bg-white text-center @error('date3') is-invalid @enderror" id="date3" name="date3" value="{{ old('date3') }}" readonly placeholder="--.--.----">

                                        @error('date3')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="time3" class="col-md-4 col-form-label text-md-right">Време</label>
                                        <input type="time" class="col-md-4 form-control text-center @error('time3') is-invalid @enderror" id="time3" name="time3">

                                        @error('time3')
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
                                <th class="col-md-2 text-center">Датум</th>
                                <th class="col-md-1 text-center">Време</th>
                                <th class="col-md-3 text-center">Акција</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($exams4 as $exam4)
                                <tr>
                                    <td>{{ $exam4->name }}</td>
                                    <td class="text-center">{{ date('d.m.Y.', strtotime($exam4->date)) }}</td>
                                    <td class="text-center">{{ $exam4->time }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalUpdate{{$exam4->id}}">Затвори пријаву испита</button>

                                        <div class="modal fade" id="ModalUpdate{{$exam4->id}}" tabindex="-1" aria-labelledby="ModalUpdate{{$exam4->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                                        Да ли сте сигурни да желите да затворите пријаву испита за предмет <b>{{$exam4->name}}</b>?
                                                    </div>
                                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                                        <a href="{{ route('employee.updateExam', ['examID' => $exam4->id, 'programID' => $program->id]) }}" class="btn btn-sm btn-danger">Затвори пријаву испита</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Нема заказаних испита</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="border-bottom"></div>

                        <form action="{{ route('employee.storeExam4') }}" method="POST">
                            @csrf
                            <div class="card mt-3">
                                <div class="card-header font-weight-bold text-center">
                                    Закажи испит
                                </div>
                                <div class="card-body">
                                    <div class="form-group row pt-1">
                                        <label for="subject_id-exam4" class="col-md-4 col-form-label text-md-right">Предмет</label>
                                        <select class="text-center col-md-4 form-control @error('subject_id_exam4') is-invalid @enderror" name="subject_id_exam4" id="subject_id_exam4">
                                            <option {{ old('subject_id_exam4') == '' ? "selected" : "" }} value="">Изабери предмет</option>
                                            @foreach($subjects4 as $subject4)
                                                @if($subject4->grade == 4)
                                                    <option {{ old('subject_id_exam4') == $subject4->id ? "selected" : "" }} value="{{ $subject4->id }}">{{ $subject4->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                        @error('subject_id_exam4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="date4" class="col-md-4 col-form-label text-md-right">Датум</label>
                                        <input type="text" class="col-md-4 form-control datepicker bg-white text-center @error('date4') is-invalid @enderror" id="date4" name="date4" value="{{ old('date4') }}" readonly placeholder="--.--.----">

                                        @error('date4')
                                        <span class="offset-md-4 invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group row">
                                        <label for="time4" class="col-md-4 col-form-label text-md-right">Време</label>
                                        <input type="time" class="col-md-4 form-control text-center @error('time4') is-invalid @enderror" id="time4" name="time4">

                                        @error('time4')
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

    <!-- Modal Create Exam Success Message -->
    <div class="modal" id="createExam_success" tabindex="-1" aria-labelledby="createExam_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте заказали испит за предмет<br> <span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Create Exam Failed Message -->
    <div class="modal" id="createExam_failed" tabindex="-1" aria-labelledby="createExam_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно заказивање испита. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Exam Success Message -->
    <div class="modal" id="updateExam_success" tabindex="-1" aria-labelledby="updateExam_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте затворили пријаву испита за предмет<br> <span class="font-weight-bold">{{ Session::get('subjectName') }}</span>.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Exam Failed Message -->
    <div class="modal" id="updateExam_failed" tabindex="-1" aria-labelledby="updateExam_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно затварање пријаве испита. Покушајте поново.
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
    </script>
@endsection

