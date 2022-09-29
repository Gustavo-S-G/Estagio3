@extends('layouts.admin')

@section('title')
    Criar Função
@endsection

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Adicionar nova Função</h3>
        <div class="card-tools">
            <a href="{{ route('role.index') }}" class="btn btn-danger"><i class="fas fa-shield-alt"></i> Ver todas as Funções</a>
        </div>
    </div>
    <div class="card-body">
        <role></role>
    </div>
</div>

@endsection
