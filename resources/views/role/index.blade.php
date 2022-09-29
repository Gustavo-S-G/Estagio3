@extends('layouts.admin')

@section('title')
    Funções
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabela das Funções</h3>
            <div class="card-tools">
                <a href="{{ route('role.create') }} " class="btn btn-primary"><i class="fas fa-shield-alt"></i>
                     Adicionar Nova Função</a>
            </div>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="1%">ID</th>
                        <th>Função</th>
                        <th>Permissões</th>
                        <th>Data Criado</th>
                        <th width="1%">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach ($role->permissions as $permission)
                                    <button class="btn btn-warning" role="button"><i class="fas fa-shield-alt"></i>
                                        {{ $permission->name }}</button>
                                @endforeach
                            </td>
                            <td><span class="tag tag-success">{{date('d/m/Y H:i:s', strtotime($role->created_at))}}</span></td>
                            <td>
                                <a href="{{ route('role.edit', $role->id) }}" class="btn btn-sm btn-warning"> Editar </a>
                            </td>
                            <td>
                                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"> Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td><i class="fas fa-folder-open"></i> Nenhuma Função encontrada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
