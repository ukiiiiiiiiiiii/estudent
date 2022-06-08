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
    <div class="container pt-3">
        @if($information->count() < 1)

        @else
            <div class="card bg-light">
                <div class="card-body">
                    <form action="{{ route('employee.searchInformation') }}" method="get">

                        <div class="text-center">
                            <label for="program_id" class="mb-0">Студијски програм</label>
                        </div>

                        <div class="offset-md-1">
                            <select class="custom-select text-center col-md-11" id="program_id" name="program_id">
                                <option value="" selected>Сви студијски програми</option>
                                @foreach(\App\Program::all()->sortByDesc('name') as $program)
                                    <option value="{{ $program->id }}">{{ $program->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-inline justify-content-between pt-3">
                            <div class="col-md-1"></div>

                            <div>
                                <label for="created_at">Датум објављивања</label>
                                <div class="form-group">
                                    од&nbsp
                                    <div class="input-group mr-3">
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

                            <div>
                                <label for="grade">Година студија</label>
                                <select class="custom-select" id="grade" name="grade">
                                    <option value="" selected>Све године</option>
                                    <option value="1">I година</option>
                                    <option value="2">II година</option>
                                    <option value="3">III година</option>
                                    <option value="4">IV година</option>
                                </select>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="btn btn-primary btn-sm">Претражи</button>
                                <a href="{{ route('employee.dashboard') }}" class="btn btn-danger btn-sm">Поништи претрагу</a>
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </form>
            </div>
        </div>
    @endif


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

        {{-- $information->appends(request()->input())->links() --}}
        {{ $information->links() }}
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

    <!-- Modal Create Information Success Message -->
    <div class="modal" id="createInformation_success" tabindex="-1" aria-labelledby="createInformation_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте креирали обавештење.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Information Success Message -->
    <div class="modal" id="deleteInformation_success" tabindex="-1" aria-labelledby="deleteInformation_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте избрисали обавештење.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Information Failed Message -->
    <div class="modal" id="deleteInformation_failed" tabindex="-1" aria-labelledby="deleteInformation_failed" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Неуспешно брисање обавештења. Покушајте поново.
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Information Success Message -->
    <div class="modal" id="updateInformation_success" tabindex="-1" aria-labelledby="updateInformation_success" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
                <div class="modal-body text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Успешно сте изменили обавештење.
                </div>
            </div>
        </div>
    </div>
@endsection

