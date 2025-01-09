@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>

    @can('isAdmin')
        <form method="GET" action="{{ route('users.index') }}">
            <div class="form-group">
                <label for="empresa_id">Filtrar por Empresa:</label>
                <select name="empresa_id" id="empresa_id" class="form-control">
                    <option value="">Todas las Empresas</option>
                    @foreach($empresas as $empresa)
                        <option value="{{ $empresa->id_empresa }}" {{ $empresaId == $empresa->id_empresa ? 'selected' : '' }}>
                            {{ $empresa->nom_empresa }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>
    @endcan

    <div class="row mt-4">
        @foreach($users as $user)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $user->foto_perfil ? asset('storage/' . $user->foto_perfil) : asset('images/default-avatar.png') }}" class="card-img-top" alt="Foto de perfil">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} {{ $user->surname }}</h5>
                        <p class="card-text">
                            <strong>Rol:</strong> {{ $user->rol == 1 ? 'Admin' : ($user->rol == 2 ? 'Subadmin' : 'Trabajador') }}<br>
                            <strong>Empresa:</strong> {{ $user->empresa->nom_empresa ?? 'N/A' }}
                        </p>
                        
                        @can('isAdmin')
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
