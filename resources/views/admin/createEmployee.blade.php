@extends('layouts.admin-app')

@section('content')
<ul class="nav nav-tabs justify-content-center">
    <li id="tab" class="nav-item mr-1">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">Преглед запослених</a>
    </li>
    <li id="tab" class="nav-item">
        <a class="nav-link active" href="#">Додај запосленог</a>
    </li>
</ul>
<div class="container pt-4">
    <div class="row justify-content-center">
        dodaj zaposlenog
    </div>
</div>
@endsection
