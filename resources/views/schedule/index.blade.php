@extends('layouts.admin')

@section('title')
    Agenda
@endsection

@section('content')
    <div class="card">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">Agenda</h3>
        </div>
        <div class="card-body">
            <schedule></schedule>
        </div>
    </div>
@endsection
