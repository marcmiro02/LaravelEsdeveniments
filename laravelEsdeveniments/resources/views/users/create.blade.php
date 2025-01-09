@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Nombre -->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Apellido -->
        <div class="form-group">
            <label for="surname">Apellido</label>
            <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname') }}" required>
        </div>

        <!-- Nombre de usuario -->
        <div class="form-group">
            <label for="nom_usuari">Nombre de usuario</label>
            <input type="text" name="nom_usuari" id="nom_usuari" class="form-control" value="{{ old('nom_usuari') }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <!-- Dirección -->
        <div class="form-group">
            <label for="adreca">Dirección</label>
            <input type="text" name="adreca" id="adreca" class="form-control" value="{{ old('adreca') }}" required>
        </div>

        <!-- Tarjeta bancaria -->
        <div class="form-group">
            <label for="targeta_bancaria">Tarjeta bancaria</label>
            <input type="text" name="targeta_bancaria" id="targeta_bancaria" class="form-control" value="{{ old('targeta_bancaria') }}" required>
        </div>

        <!-- Fecha de nacimiento -->
        <div class="form-group">
            <label for="data_naixement">Fecha de nacimiento</label>
            <input type="date" name="data_naixement" id="data_naixement" class="form-control" value="{{ old('data_naixement') }}" required>
        </div>

        <!-- Contraseña -->
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <!-- Confirmar contraseña -->
        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>

        <!-- Foto de perfil -->
        <div class="form-group">
            <label for="foto_perfil">Foto de perfil</label>
            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control">
        </div>

        <!-- Rol -->
        <div class="form-group">
            <label for="rol">Rol</label>
            <select name="rol" id="rol" class="form-control" required>
                <option value="1" {{ old('rol') == 1 ? 'selected' : '' }}>Admin</option>
                <option value="2" {{ old('rol') == 2 ? 'selected' : '' }}>Subadmin</option>
            </select>
        </div>

        <!-- Campo de empresa (solo visible para Admin) -->
        @if(Auth::user()->rol == 1)  <!-- Solo Admins pueden ver este campo -->
            <div class="form-group">
                <label for="id_empresa">Empresa</label>
                <select name="id_empresa" id="id_empresa" class="form-control" required>
                    @foreach($empresas as $empresa)
                        <option value="{{ $empresa->id_empresa }}" {{ old('id_empresa') == $empresa->id_empresa ? 'selected' : '' }}>
                            {{ $empresa->nom_empresa }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <input type="hidden" name="id_empresa" value="{{ Auth::user()->id_empresa }}">
        @endif

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
@endsection
