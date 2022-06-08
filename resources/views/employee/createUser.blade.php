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
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Студенти</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showUsers') }}">Прикажи студенте</a>
                <a class="dropdown-item active disabled" href="{{ route('employee.createUser') }}">Додај студента</a>
                <a class="dropdown-item disabled" href="#">Измени податке о студенту</a>
            </div>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="{{ route('employee.showSchedule') }}">Распоред наставе</a>
        </li>
        <li id="dropdown-tab" class="nav-item dropdown mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Испити</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.showExams') }}">Распоред испита</a>
                <a class="dropdown-item" href="{{ route('employee.showRegisteredExams') }}">Пријављени испити</a>
                <a class="dropdown-item" href="{{ route('employee.showPassedExams') }}">Положени испити</a>
                <a class="dropdown-item" href="{{ route('employee.showUnsuccessfullyExams') }}">Неуспешна полагања</a>
            </div>
        </li>
    </ul>
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <div class="row pl-3">
                <a class="card-navigation-1" href="{{ route('employee.showUsers') }}">Студенти&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Додај студента</a>
            </div>
        </div>
        <div class="card-body">
            @if($programs->count() < 1)
                <strong>Упис студената није могућ! Студијски програми нису креирани.</strong>
            @else
                <form action="{{ route('employee.storeUser') }}" method="POST">
                    @csrf

                    <div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Име и презиме</label>

                            <input id="name" type="text" class="col-md-6 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required oninvalid="this.setCustomValidity('Унесите име и презиме студента!')" oninput="setCustomValidity('')" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">ЈМБГ</label>

                            <input id="password" type="number" class="col-md-6 form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required oninvalid="this.setCustomValidity('Унесите ЈМБГ!')" oninput="setCustomValidity('')">

                            @error('password')
                            <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="program_id" class="col-md-4 col-form-label text-md-right">Студијски програм</label>

                            <select class="col-md-6 form-control @error('program_id') is-invalid @enderror" name="program_id" id="program_id">
                                <option {{ old('program_id') == '' ? "selected" : "" }} value="">Изабери студијски програм</option>
                                @foreach($programs as $program)
                                    <option {{ old('program_id') == $program->id ? "selected" : "" }} value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                            @error('program_id')
                            <span class="offset-md-4 invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="budget" class="col-md-4 col-form-label text-md-right">Начин финансирања</label>

                            <select class="col-md-4 form-control  @error('budget') is-invalid @enderror" name="budget" id="budget">
                                <option {{ old('budget') == '' ? "selected" : "" }}  value="">Изабери начин финансирања</option>
                                <option {{ old('budget') == 'Б' ? "selected" : "" }} value="Б">Буџет</option>
                                <option {{ old('budget') == 'С' ? "selected" : "" }} value="С">Самофинансирајући</option>
                            </select>

                            @error('budget')
                            <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="rank" class="col-md-4 col-form-label text-md-right">Ранг</label>

                            <input id="rank" type="text" class="col-md-1 form-control @error('username') is-invalid @enderror" name="rank" value="{{ old('rank') }}" required oninvalid="this.setCustomValidity('Унесите позицију на ранг листи!')" oninput="setCustomValidity('')">

                            @error('username')
                            <span class="offset-md-4 invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <input id="username" type="text" class="col-md-1 form-control" name="username" value="{{ old('username') }}" required readonly hidden>
                        </div>
                    </div>

                    <div class="row pt-2 pb-3">
                        <div class="offset-md-4">
                            <button onclick="setIndex()" type="submit" class="btn btn-primary">Потврди</button>
                            <a href="{{ route('employee.showUsers') }}" class="btn btn-danger">Одустани</a>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

<!-- Modal Create User Failed Message -->
<div class="modal" id="createUser_failed" tabindex="-1" aria-labelledby="createUser_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно креирање корисничког налога за студента. Покушајте поново.
            </div>
        </div>
    </div>
</div>

<script>
    function setIndex() {
        //Get
        var program_id = $('#program_id').val();

        var programString = "";

        if(program_id < 10) {
            programString = "0" + program_id;
        } else {
            programString = "" + program_id;
        }

        var rank = $('#rank').val();

        var rankString = "";

        var strDate = new Date();
        var shortYear = strDate.getFullYear();
        var twoDigitYear = shortYear.toString().substr(-2)

        if(rank < 10) {
            rankString = "000" + rank;
        }
        else if(rank < 100) {
            rankString = "00" + rank;
        }
        else if(rank < 1000) {
            rankString = "0" + rank;
        }
        else if(rank < 10000) {
            rankString = "" + rank;
        }

        //Set
        $('#username').val(programString + "/" + rankString + "/" + twoDigitYear);
    }
</script>
@endsection
