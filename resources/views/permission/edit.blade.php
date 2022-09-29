@extends('layouts.admin')

@section('title')
    Editar Permissão
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Editar Permissão</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('permission.update', $permission->id) }}" method="POST">
                @csrf
                <input name="_method" type="hidden" value="PUT">
                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $permission->name }}"
                        required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary"> Salvar </button>
                    <a href="{{ route('permission.index') }}" class="btn btn-danger"> Voltar </a>
                </div>
            </form>
        </div>
    </div>
@endsection
