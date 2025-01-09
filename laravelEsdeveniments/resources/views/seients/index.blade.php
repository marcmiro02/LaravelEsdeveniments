<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Seients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat de seients") }}
                        </h3>
                        <a href="{{ route('seients.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">💺</span> Afegir Seient
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
                                <th class="px-4 py-2">Fila</th>
                                <th class="px-4 py-2">Columna</th>
                                <th class="px-4 py-2">Preu</th>
                                <th class="px-4 py-2">Estat del Seient</th>
                                <th class="px-4 py-2">ID de la Sala</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seients as $seient)
                                <tr>
                                    <td class="border px-4 py-2">{{ $seient->fila }}</td>
                                    <td class="border px-4 py-2">{{ $seient->columna }}</td>
                                    <td class="border px-4 py-2">{{ $seient->preu }}</td>
                                    <td class="border px-4 py-2">{{ $seient->estat_seient }}</td>
                                    <td class="border px-4 py-2">{{ $seient->id_sala }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Seient -->
                                        <a href="{{ route('seients.show', ['id_seient' => $seient->id_seient]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Seient -->
                                        <a href="{{ route('seients.edit', ['id_seient' => $seient->id_seient]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Seient -->
                                        <form action="{{ route('seients.destroy', ['id_seient' => $seient->id_seient]) }}" method="POST" style="display:inline">
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