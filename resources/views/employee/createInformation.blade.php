@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('employee.dashboard') }}">Прикажи обавештења</a>
                <a class="dropdown-item active disabled" href="{{ route('employee.createInformation') }}">Креирај обавештење</a>
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
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Предмети</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Студенти</a>
        </li>
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Распоред наставе</a>
        </li>
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
<div class="container pt-5">
    <div class="card">
        <div class="card-header">
            <div class="row pl-3">
                <a class="card-navigation-1" href="{{ route('employee.dashboard') }}">Огласна табла&nbsp</a>
                <span><i class="fas fa-angle-right card-navigation-2"></i>&nbsp</span>
                <a class="card-navigation-2" href="#">Креирај обавештење</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('employee.storeInformation') }}" method="POST">
                @csrf
                <div class="d-flex flex-row justify-content-around">
                    <div class="form-group form-inline">
                        <label for="program_id" class="col-form-label mr-2 text-md-right">Студијски програм</label>
                        <select class="form-control @error('program_id') is-invalid @enderror" name="program_id" id="program_id">
                            <option {{ old('program_id') == 'all' ? "selected" : "" }} value="all">Сви студијски програми</option>
                            @foreach($programs as $program)
                                <option {{ old('program_id') == $program->id ? "selected" : "" }} value="{{ $program->id }}">{{ $program->name }}</option>
                            @endforeach
                        </select>
                        @error('program_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group form-inline">
                        <label for="grade" class="col-form-label text-md-right">Година</label>
                        <select class="ml-2 form-control  @error('grade') is-invalid @enderror" name="grade" id="grade">
                            <option {{ old('grade') == 'all' ? "selected" : "" }}  value="all">Све године</option>
                            <option {{ old('grade') == '1' ? "selected" : "" }} value="1">I година</option>
                            <option {{ old('grade') == '2' ? "selected" : "" }} value="2">II година</option>
                            <option {{ old('grade') == '3' ? "selected" : "" }} value="3">III година</option>
                            <option {{ old('grade') == '4' ? "selected" : "" }} value="4">IV година</option>
                        </select>
                        @error('grade')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="text">Текст обавештења</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" id="text" rows="3"></textarea>
                    @error('text')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary mr-2">Објави</button>
                    <a href="{{ route('employee.dashboard') }}" class="btn btn-danger">Одустани</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Create Information Failed Message -->
<div class="modal" id="createInformation_failed" tabindex="-1" aria-labelledby="createInformation_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно креирање обавештења. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
