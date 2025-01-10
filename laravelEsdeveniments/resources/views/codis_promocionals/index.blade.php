<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Codis Promocionals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat de Codis Promocionals") }}
                        </h3>
                        <a href="{{ route('codis_promocionals.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">➕</span> Afegir Codi Promocional
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
                                <th class="px-4 py-2">Nom del Codi</th>
                                <th class="px-4 py-2">Descompte</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($codis_promocionals as $codi_promocional)
                                <tr>
                                    <td class="border px-4 py-2">{{ $codi_promocional->nom_codi }}</td>
                                    <td class="border px-4 py-2">{{ $codi_promocional->descompte }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Codi Promocional -->
                                        <a href="{{ route('codis_promocionals.show', ['id_codi' => $codi_promocional->id_codi]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Codi Promocional -->
                                        <a href="{{ route('codis_promocionals.edit', ['id_codi' => $codi_promocional->id_codi]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Codi Promocional -->
                                        <form action="{{ route('codis_promocionals.destroy', ['id_codi' => $codi_promocional->id_codi]) }}" method="POST" style="display:inline">
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