<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">
                            {{ __('Listado de Usuarios') }}
                        </h3>
                        <a href="{{ route('users.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
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
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Filtrar
                                </button>
                            </div>
                        </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <th class="px-4 py-2 text-left">Foto</th>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Rol</th>
                                <th class="px-4 py-2 text-left">Empresa</th>
                                <th class="px-4 py-2 text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">
                                        <img src="{{ $user->foto_perfil ? asset('storage/' . $user->foto_perfil) : asset('images/default-avatar.png') }}" 
                                             alt="Foto de perfil" 
                                             class="w-12 h-12 rounded-full">
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $user->name }} {{ $user->surname }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $user->rol == 1 ? 'Admin' : ($user->rol == 2 ? 'Subadmin' : 'Trabajador') }}
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $user->empresa->nom_empresa ?? 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <!-- Ver Usuario -->
                                        <a href="{{ route('users.show', $user->id) }}" 
                                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Ver
                                        </a>

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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
