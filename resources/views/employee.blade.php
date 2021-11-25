@extends('layouts.employee-app')

@section('content')
    <ul class="nav nav-tabs justify-content-center">
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link active" href="#">Студијски програми</a>
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
        <li id="tab" class="nav-item mr-1">
            <a class="nav-link" href="#">Огласна табла</a>
        </li>
        <li id="tab" class="nav-item">
            <a class="nav-link" href="#">Испитни рокови</a>
        </li>
    </ul>
    <div class="container pt-3">
        <div class="row">
            <div class="col-md-6">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createProgram">
                    Креирај студијски програм
                </button>

                <form action="{{ route('employee.storeProgram') }}" method="POST">
                    @csrf
                    <div class="modal fade" id="createProgram" tabindex="-1" aria-labelledby="createProgramLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createProgramlabel">Креирање студијског програма</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Назив студијског програма</label>

                                        <div class="col-md-7">
                                            <input id="name" type="text" class="form-control @error('program-name') is-invalid @enderror" name="name" value="{{ old('name') }}" required oninvalid="this.setCustomValidity('Унесите назив студијског програма!')" oninput="setCustomValidity('')" autofocus>

                                            @error('program-name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="code" class="col-md-4 col-form-label text-md-right">Шифра</label>

                                        <div class="col-md-1">
                                            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required oninvalid="this.setCustomValidity('Унесите шифру студијског програма!')" oninput="setCustomValidity('')">

                                            @error('code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Одустани</button>
                                    <button type="submit" class="btn btn-primary">Потврди</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <input type="text" name="search-program" id="search-program" placeholder="Претрага" class="form-control">
            </div>
        </div>

        <div class="pb-3"></div>

        <table class="table" id="program_data">
            <thead class="thead-blue">
            <tr>
                <th class="col-md-8 sorting" data-sorting_type="asc" data-column_name="name" style="cursor: pointer"><span id="name_icon"><i class="fas fa-sort pr-1"></i></span>Назив студијског програма</th>
                <th class="col-md-2 sorting text-center" data-sorting_type="asc" data-column_name="code" style="cursor: pointer"><span id="username_icon"><i class="fas fa-sort pr-1"></i></span>Шифра</th>
                <th class="col-md-2 text-center">Акција</th>
            </tr>
            </thead>
            <tbody>
            {{--
            @include('employee.program_data')
            --}}
            </tbody>
        </table>

        <input type="hidden" name="hidden_page" id="hidden_page" value="1">
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name">
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">
    </div>
@endsection

