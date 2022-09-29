@extends('layouts.admin')

@section('title')
    Permissões
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela de Permissões</h3>

            <div class="card-tools">
                <a href="{{ route('permission.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Criar Nova permissão</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Data Criado</th>
                        <th width="1%">Acão</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{date('d/m/Y H:i:s', strtotime($permission->created_at))}}</td>
                            <td>
                                <a href="{{ route('permission.edit', $permission->id) }}" class="btn btn-sm btn-warning"> Editar </a>
                            </td>
                            <td>
                                <form action="{{ route('permission.destroy', $permission->id) }}" method="POST">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"> Deletar </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>Nenhuma Permissão Encontrada</tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
