<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tipus de Seients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat de Tipus de Seients") }}
                        </h3>
                        <a href="{{ route('tipus_seients.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">➕</span> Afegir Tipus de Seient
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
                                <th class="px-4 py-2">Nom del Tipus de Seient</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipusSeients as $tipusSeient)
                                <tr>
                                    <td class="border px-4 py-2">{{ $tipusSeient->nom_tipus_seient }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Tipus de Seient -->
                                        <a href="{{ route('tipus_seients.show', ['id_tipus_seient' => $tipusSeient->id_tipus_seient]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Tipus de Seient -->
                                        <a href="{{ route('tipus_seients.edit', ['id_tipus_seient' => $tipusSeient->id_tipus_seient]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Tipus de Seient -->
                                        <form action="{{ route('tipus_seients.destroy', ['id_tipus_seient' => $tipusSeient->id_tipus_seient]) }}" method="POST" style="display:inline">
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