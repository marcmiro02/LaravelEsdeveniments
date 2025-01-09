<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Empreses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat d'empreses") }}
                        </h3>
                        <a href="{{ route('empreses.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">🏢</span> Afegir Empresa
                        </a>
                    </div>
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
                            <tr>
                                <th class="px-4 py-2">Nom Empresa</th>
                                <th class="px-4 py-2">NIF</th>
                                <th class="px-4 py-2">Adreça</th>
                                <th class="px-4 py-2">Ciutat</th>
                                <th class="px-4 py-2">Telèfon</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empreses as $empresa)
                                <tr>
                                    <td class="border px-4 py-2">{{ $empresa->nom_empresa }}</td>
                                    <td class="border px-4 py-2">{{ $empresa->nif }}</td>
                                    <td class="border px-4 py-2">{{ $empresa->adreca }}</td>
                                    <td class="border px-4 py-2">{{ $empresa->ciutat }}</td>
                                    <td class="border px-4 py-2">{{ $empresa->telefon }}</td>
                                    <td class="border px-4 py-2">{{ $empresa->email }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Empresa -->
                                        <a href="{{ route('empreses.show', ['id_empresa' => $empresa->id_empresa]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Empresa -->
                                        <a href="{{ route('empreses.edit', ['id_empresa' => $empresa->id_empresa]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Empresa -->
                                        <form action="{{ route('empreses.destroy', ['id_empresa' => $empresa->id_empresa]) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
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
