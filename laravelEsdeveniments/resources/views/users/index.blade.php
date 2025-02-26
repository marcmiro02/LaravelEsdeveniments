<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __('Listado de Usuarios') }}</h3>
                <a href="{{ route('users.create') }}" 
                   class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">👤</span> Añadir Usuario
                </a>
            </div>

            @can('isSuperadmin')
                <form method="GET" action="{{ route('users.index') }}" class="mb-6">
                    <div class="flex items-center space-x-4">
                        <label for="empresa_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                            Filtrar por Empresa:
                        </label>
                        <select name="empresa_id" id="empresa_id" class="form-control rounded border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Todas las Empresas</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id_empresa }}" 
                                    {{ $empresaId == $empresa->id_empresa ? 'selected' : '' }}>
                                    {{ $empresa->nom_empresa }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" 
                                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                            Filtrar
                        </button>
                    </div>
                </form>
            @endcan

            <!-- Table -->
            @if ($users->isEmpty())
                <p class="text-center text-lg text-gray-400">No se han encontrado usuarios.</p>
            @else
                <table class="w-full table-auto text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Foto</th>
                            <th class="px-4 py-2 text-lg font-medium">Nombre</th>
                            <th class="px-4 py-2 text-lg font-medium">Rol</th>
                            <th class="px-4 py-2 text-lg font-medium">Empresa</th>
                            <th class="px-4 py-2 text-lg font-medium">ID</th>
                            <th class="px-4 py-2 text-lg font-medium">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">
                                    <img src="data:image/png;base64,{{ $user->foto_perfil ?? '' }}" alt="Foto de perfil" class="w-12 h-12 rounded-full">
                                </td>
                                <td class="px-4 py-2">{{ $user->name }} {{ $user->surname }}</td>
                                <td class="px-4 py-2">{{ $user->role->nom_rol ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $user->empresa->nom_empresa ?? 'N/A' }}</td>
                                <td class="px-4 py-2">{{ $user->id }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver Usuario -->
                                    <a href="{{ route('users.show', $user->id) }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                                        Ver
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>