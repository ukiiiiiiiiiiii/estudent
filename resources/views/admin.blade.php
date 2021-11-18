@extends('layouts.admin-app')

@section('content')
<ul class="nav nav-tabs justify-content-center">
    <li id="tab" class="nav-item mr-1">
        <a class="nav-link active" href="#">Преглед запослених</a>
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

    <div id="employees_data">
        @include('admin.employees_data')
    </div>
</div>
@endsection
