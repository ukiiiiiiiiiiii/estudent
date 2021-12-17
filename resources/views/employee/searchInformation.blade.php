@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="dropdown-tab" class="nav-item dropdown active mr-1">
            <a class="nav-link dropdown-toggle disabled" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Огласна табла</a>
            <div class="dropdown-menu">
                <a class="dropdown-item active disabled" href="{{ route('employee.dashboard') }}">Прикажи обавештења</a>
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
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
    <div class="container pt-3">
        <div class="card bg-light">
            <div class="card-body">
                <form action="{{ route('employee.searchInformation') }}" method="get" class="form-inline justify-content-between">

                    <div>
                        <label for="program_id">Студијски програм</label>
                        <select class="custom-select text-center" id="program_id" name="program_id">
                            <option value="" @if($program_id == "")selected @endif>Сви студијски програми</option>
                            {{--<option value="" selected>Сви студијски програми</option>--}}
                            @foreach(\App\Program::all() as $program)
                                <option value="{{ $program->id }}" @if($program_id == $program->id)selected @endif>{{ $program->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="grade">Година студија</label>
                        <select class="custom-select" id="grade" name="grade">
                            <option value="" @if($grade == "")selected @endif>Све године</option>
                            <option value="1" @if($grade == "1")selected @endif>I година</option>
                            <option value="2" @if($grade == "2")selected @endif>II година</option>
                            <option value="3" @if($grade == "3")selected @endif>III година</option>
                            <option value="4" @if($grade == "4")selected @endif>IV година</option>
                        </select>
                    </div>

                    <div>
                        <label for="created_at">Датум објављивања</label>
                        <div class="form-group">
                            од&nbsp
                            <div class="input-group mr-3">
                                {{-- date('d.m.Y.', strtotime($from)) --}}
                                <input type="text" class="form-control datepicker bg-white text-center @error('created_at_from') is-invalid @enderror" style="width: 120px" id="created_at_from" name="created_at_from" value="{{ date('d.m.Y.', strtotime($from)) }}" readonly>
                                <span class="input-group-append border-left-0">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </span>
                                @error('created_at_from')
                                <script>
                                    $(document).ready(function(){
                                        $('#created_at-modal').modal('show');
                                    });
                                </script>
                                @enderror
                            </div>

                            до&nbsp
                            <div class="input-group">
                                <input type="text" class="form-control datepicker bg-white text-center @error('created_at_to') is-invalid @enderror" style="width: 120px" id="created_at_to" name="created_at_to" value="{{ date('d.m.Y.', strtotime($to)) }}" readonly>
                                <span class="input-group-append border-left-0">
                                    <span class="input-group-text bg-white">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </span>
                                @error('created_at_to')
                                <script>
                                    $(document).ready(function(){
                                        $('#created_at-modal').modal('show');
                                    });
                                </script>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-column">
                        <button type="submit" class="btn btn-primary btn-sm mb-1">Претражи&nbsp<span><i class="fas fa-search"></i></span></button>

                        <a href="{{ route('employee.dashboard') }}" class="btn btn-warning btn-sm">Поништи&nbsp<span><i class="fas fa-sync"></i></span></a>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <a href="{{ route('employee.createInformation') }}" class="btn btn-success">Креирај обавештење</a>
        </div>

        @forelse($information as $info)
            <div class="card mt-4 mb-4">
                <div class="card-header d-flex flex-row justify-content-between">
                    <div class="font-weight-bold text-uppercase pt-1">
                        {{ $info->program->name }} -
                        @if($info->grade == "1")
                            I
                        @elseif($info->grade == "2")
                            II
                        @elseif($info->grade == "3")
                            III
                        @elseif($info->grade == "4")
                            IV
                        @endif
                        година
                    </div>

                    <div>
                        <a href="{{ route('employee.editInformation', ['id' => $info->id]) }}" class="btn btn-sm btn-info">Измени</a>

                        <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#ModalDelete{{$info->id}}">Обриши</button>

                        <div class="modal fade" id="ModalDelete{{$info->id}}" tabindex="-1" aria-labelledby="ModalDelete{{$info->id}}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-left" style="padding-bottom: 0.35rem">
                                        Да ли сте сигурни да желите да обришете обавештење?
                                    </div>
                                    <div class="modal-footer" style="padding-top: 0.40rem">
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Одустани</button>
                                        <a href="{{ route('employee.destroyInformation', ['id' => $info->id]) }}" class="btn btn-sm btn-danger">Обриши</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <div class="text-muted pb-3">
                        {{ $info->created_at->format('d.m.Y.') }}
                    </div>
                    <p class="card-text">{{ $info->text }}</p>
                </div>
            </div>
        @empty
            <div class="card mt-4">
                <div class="card-body text-center">Нема резултата претраге</div>
            </div>
        @endforelse

        {{ $information->appends(request()->input())->links() }}
    </div>

    <!-- Modal Date Required Message -->
    <div class="modal" id="created_at-modal" tabindex="-1" aria-labelledby="created_at-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Нисте дефинисали временски опсег за претрагу.
                </div>
            </div>
        </div>
    </div>
@endsection

