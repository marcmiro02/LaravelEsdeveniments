<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Details Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-md w-full text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Detalls Usuari</h3>

            <!-- User Details -->
            <div class="space-y-4">
                <!-- Nom -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Nom:</strong>
                    <div>{{ $user->name }}</div>
                </div>

                <!-- Cognoms -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Cognoms:</strong>
                    <div>{{ $user->surname }}</div>
                </div>

                <!-- Nom usuari -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Nom usuari:</strong>
                    <div>{{ $user->nom_usuari }}</div>
                </div>

                <!-- E-mail -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">E-mail:</strong>
                    <div>{{ $user->email }}</div>
                </div>

                <!-- Adreça -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Adreça:</strong>
                    <div>{{ $user->adreca }}</div>
                </div>

                <!-- Data naixement -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Data naixement:</strong>
                    <div>{{ $user->data_naixement }}</div>
                </div>

                <!-- Rol -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Rol:</strong>
                    <div>{{ $user->role->nom_rol ?? 'N/A' }}</div>
                </div>

                <!-- Empresa -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Empresa:</strong>
                    <div>{{ $user->empresa->nom_empresa ?? 'N/A' }}</div>
                </div>

                <!-- Foto de perfil -->
                <div class="flex items-center space-x-4">
                    <strong class="text-lg font-medium">Foto de perfil:</strong>
                    <img src="data:image/png;base64,{{ $user->foto_perfil ?? '' }}" alt="Foto de perfil"
                        class="w-12 h-12 rounded-full">
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-8 flex justify-center space-x-4">
                <!-- Volver Button -->
                <a href="{{ route('users.index') }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded transition-colors">
                    Tornar
                </a>

                <!-- Editar Button -->
                <a href="{{ route('users.edit', $user->id) }}" 
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded transition-colors">
                    Editar
                </a>

                <!-- Eliminar Button -->
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded transition-colors">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>