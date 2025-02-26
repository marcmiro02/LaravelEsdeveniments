<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Usuari</h3>

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-medium text-gray-100">Nom</label>
                    <input type="text" name="name" id="name" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->name }}" required>
                </div>

                <!-- Apellido -->
                <div class="mb-4">
                    <label for="surname" class="block text-lg font-medium text-gray-100">Cognoms</label>
                    <input type="text" name="surname" id="surname" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->surname }}" required>
                </div>

                <!-- Nombre de usuario -->
                <div class="mb-4">
                    <label for="nom_usuari" class="block text-lg font-medium text-gray-100">Nom d'usuari</label>
                    <input type="text" name="nom_usuari" id="nom_usuari" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->nom_usuari }}" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-gray-100">E-mail</label>
                    <input type="email" name="email" id="email" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->email }}" required>
                </div>

                <!-- Dirección -->
                <div class="mb-4">
                    <label for="adreca" class="block text-lg font-medium text-gray-100">Adreça</label>
                    <input type="text" name="adreca" id="adreca" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->adreca }}" required>
                </div>

                <!-- Fecha de nacimiento -->
                <div class="mb-4">
                    <label for="data_naixement" class="block text-lg font-medium text-gray-100">Data Naixement</label>
                    <input type="date" name="data_naixement" id="data_naixement" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $user->data_naixement }}" required>
                </div>

                <!-- Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-lg font-medium text-gray-100">Contrasenya</label>
                    <input type="password" name="password" id="password" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-lg font-medium text-gray-100">Confirmar contrasenya</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Foto de perfil -->
                <div class="mb-4">
                    <label for="foto_perfil" class="block text-lg font-medium text-gray-100">Foto de perfil</label>
                    <input type="file" name="foto_perfil" id="foto_perfil" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Rol -->
                <div class="mb-4">
                    <label for="rol" class="block text-lg font-medium text-gray-100">Rol</label>
                    <select name="rol" id="rol" 
                            class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                            required>
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
                        <label for="id_empresa" class="block text-lg font-medium text-gray-100">Empresa</label>
                        <select name="id_empresa" id="id_empresa" 
                                class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                                required>
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

                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Actualitzar Usuari</button>
            </form>
        </div>
    </div>
</x-app-layout>