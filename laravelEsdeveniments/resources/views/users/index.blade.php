@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Usuarios</h1>



@if(Auth::check() && (Auth::user()->rol == 1 || (Auth::user()->rol == 2 && $user->rol == 3)))
    <!-- Admin puede editar/eliminar a cualquier usuario, Subadmin puede editar/eliminar solo trabajadores -->
    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
@endif

    <div class="row mt-4">
        @foreach($users as $user)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <img src="{{ $user->foto_perfil ? asset('storage/' . $user->foto_perfil) : asset('images/default-avatar.png') }}" class="card-img-top" alt="Foto de perfil">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} {{ $user->surname }}</h5>
                        <p class="card-text">
                            <strong>Rol:</strong> {{ $user->rol == 1 ? 'Admin' : ($user->rol == 2 ? 'Subadmin' : 'Trabajador') }}<br>
                            <strong>Empresa:</strong> {{ $empresa->nom_empresa }}
                        </p>
                        
                        @if(Auth::user()->rol == 1 || (Auth::user()->rol == 2 && $user->rol == 3))
                            <!-- Admin puede editar/eliminar a cualquier usuario, Subadmin puede editar/eliminar solo trabajadores -->
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
