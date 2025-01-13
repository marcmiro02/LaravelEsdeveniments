<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ver Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="mb-4">Detalles del Usuario</h1>

                    <div class="mb-4">
                        <label class="form-label">Nombre:</label>
                        <p>{{ $user->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Apellido:</label>
                        <p>{{ $user->surname }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nombre de usuario:</label>
                        <p>{{ $user->nom_usuari }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Correo electrónico:</label>
                        <p>{{ $user->email }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Dirección:</label>
                        <p>{{ $user->adreca }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Tarjeta bancaria:</label>
                        <p>{{ $user->targeta_bancaria }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Fecha de nacimiento:</label>
                        <p>{{ $user->data_naixement }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Rol:</label>
                        <p>{{ $user->role->nom_rol ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Empresa:</label>
                        <p>{{ $user->empresa->nom_empresa ?? 'N/A' }}</p>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Foto de perfil:</label>
                        <img src="{{ $user->foto_perfil ? asset('storage/' . $user->foto_perfil) : asset('images/default-avatar.png') }}" 
                             alt="Foto de perfil" 
                             class="w-12 h-12 rounded-full">
                    </div>

                    <a href="{{ route('users.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Volver</a>

                    <!-- Editar Usuario -->
                    <a href="{{ route('users.edit', $user->id) }}" 
                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>

                    <!-- Eliminar Usuario -->
                    <form action="{{ route('users.destroy', $user->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')" 
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
