@extends('layouts.admin-app')

@section('content')
<ul class="nav nav-tabs justify-content-center">
    <li id="tab" class="nav-item mr-1">
        <a class="nav-link active" href="#">Списак запослених</a>
    </li>
    <li id="tab" class="nav-item">
        <a class="nav-link" href="{{ route('admin.createEmployee') }}">Додај запосленог</a>
    </li>
</ul>
<div class="container pt-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6"></div>
        <div class="col-md-3">
            <input type="text" name="search" id="search" placeholder="Претрага" class="form-control">
        </div>
    </div>

    <div class="pb-3"></div>

    <table class="table" id="employees_data">
        <thead class="thead-blue">
        <tr>
            <th class="col-md-5 sorting" data-sorting_type="asc" data-column_name="name" style="cursor: pointer"><span id="name_icon"><i class="fas fa-sort pr-1"></i></span>Име и презиме</th>
            <th class="col-md-5 sorting" data-sorting_type="asc" data-column_name="username" style="cursor: pointer"><span id="username_icon"><i class="fas fa-sort pr-1"></i></span>Корисничко име</th>
            <th class="col-md-2 text-center">Акција</th>
        </tr>
        </thead>
        <tbody>
            @include('admin.employees_data')
        </tbody>
    </table>

    <input type="hidden" name="hidden_page" id="hidden_page" value="1">
    <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name">
    <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc">
</div>

<!-- Modal Add Employee Success Message -->
<div class="modal" id="addEmployee_success" tabindex="-1" aria-labelledby="addEmployee_success" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Успешно сте додали корисника <span class="font-weight-bold">{{ Session::get('employeeName') }}</span>.
            </div>
        </div>
    </div>
</div>

<!-- Modal Update Employee Success Message -->
<div class="modal" id="updateEmployee_success" tabindex="-1" aria-labelledby="updateEmployee_success" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Успешно сте изменили податке о кориснику <span class="font-weight-bold">{{ Session::get('employeeName') }}</span>.
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Employee Success Message -->
<div class="modal" id="deleteEmployee_success" tabindex="-1" aria-labelledby="deleteEmployee_success" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #155724; background-color: #d4edda; border-color: #c3e6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Успешно сте избрисали податке.
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete Employee Failed Message -->
<div class="modal" id="deleteEmployee_failed" tabindex="-1" aria-labelledby="deleteEmployee_failed" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="color: #721c24; background-color: #f8d7da; border-color: #f5c6cb;">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Неуспешно брисање података. Покушајте поново.
            </div>
        </div>
    </div>
</div>
@endsection
