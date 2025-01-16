<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Editar Usuario</h1>

                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->name }}" required>
                        </div>

                        <!-- Apellido -->
                        <div class="mb-4">
                            <label for="surname" class="form-label">Apellido</label>
                            <input type="text" name="surname" id="surname" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->surname }}" required>
                        </div>

                        <!-- Nombre de usuario -->
                        <div class="mb-4">
                            <label for="nom_usuari" class="form-label">Nombre de usuario</label>
                            <input type="text" name="nom_usuari" id="nom_usuari" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->nom_usuari }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" name="email" id="email" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->email }}" required>
                        </div>

                        <!-- Dirección -->
                        <div class="mb-4">
                            <label for="adreca" class="form-label">Dirección</label>
                            <input type="text" name="adreca" id="adreca" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->adreca }}" required>
                        </div>

                        <!-- Tarjeta bancaria -->
                        <div class="mb-4">
                            <label for="targeta_bancaria" class="form-label">Tarjeta bancaria</label>
                            <input type="text" name="targeta_bancaria" id="targeta_bancaria" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->targeta_bancaria }}" required>
                        </div>

                        <!-- Fecha de nacimiento -->
                        <div class="mb-4">
                            <label for="data_naixement" class="form-label">Fecha de nacimiento</label>
                            <input type="date" name="data_naixement" id="data_naixement" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" value="{{ $user->data_naixement }}" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Foto de perfil -->
                        <div class="mb-4">
                            <label for="foto_perfil" class="form-label">Foto de perfil</label>
                            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Rol -->
                        <div class="mb-4">
                            <label for="rol" class="form-label">Rol</label>
                            <select name="rol" id="rol" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id_rol }}" {{ $user->rol == $role->id_rol ? 'selected' : '' }}>
                                        {{ $role->nom_rol }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Campo de empresa (solo visible para SuperAdmin) -->
                        @if(Auth::user()->rol == 1)  <!-- Solo SuperAdmins pueden ver este campo -->
                            <div class="mb-4">
                                <label for="id_empresa" class="form-label">Empresa</label>
                                <select name="id_empresa" id="id_empresa" class="form-control bg-white text-black dark:bg-gray-700 dark:text-white" required>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id_empresa }}" {{ $user->id_empresa == $empresa->id_empresa ? 'selected' : '' }}>
                                            {{ $empresa->nom_empresa }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="id_empresa" value="{{ Auth::user()->id_empresa }}">
                        @endif

                        <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
