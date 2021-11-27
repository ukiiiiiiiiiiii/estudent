@extends('layouts.admin-app')

@section('content')
<ul class="nav nav-tabs justify-content-center">
    <li id="tab" class="nav-item mr-1">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Списак запослених</a>
    </li>
    <li id="tab" class="nav-item mr-1">
        <a class="nav-link" href="{{ route('admin.createEmployee') }}">Додај запосленог</a>
    </li>
    <li id="tab" class="nav-item">
        <a class="nav-link active" href="#">{{ $employee->name }}</a>
    </li>
</ul>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            Измена података о запосленом
        </div>
        <div class="card-body pt-5">
            <form action="{{ route('admin.updateEmployee', $employee->id) }}" method="POST">
                @csrf
                <div class="form-group row pl-5">
                    <label for="name" class="col-md-3 offset-2 col-form-label text-md-right">Име и презиме</label>

                    <div class="col-md-3">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $employee->name }}" required oninvalid="this.setCustomValidity('Унесите име и презиме!')" oninput="setCustomValidity('')" autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row pl-5">
                    <div class="col-md-3 offset-2 col-form-label text-md-right">Корисничко име</div>

                    <div class="col-md-3">
                        <div class="form-control">{{ $employee->username }}</div>
                    </div>
                </div>

                <div class="form-group row pl-5">
                    <label for="password" class="col-md-3 offset-2 col-form-label text-md-right">ЈМБГ</label>

                    <div class="col-md-3">
                        <input id="password" type="number" class="form-control @error('password') is-invalid @enderror" name="password" required oninvalid="this.setCustomValidity('Унесите ЈМБГ!')" oninput="setCustomValidity('')" autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0 pl-5 pt-2 pb-4">
                    <div class="col-md-6 offset-md-5">
                        <button type="submit" class="btn btn-primary">
                            Потврди
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Update Employee Failed -->
<div class="modal" id="updateEmployee_failed" tabindex="-1" aria-labelledby="updateEmployee_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешна измена података. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
