<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Esdeveniments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat d'Esdeveniments") }}
                        </h3>
                        <a href="{{ route('esdeveniments.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">➕</span> Afegir Esdeveniment
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
                                <th class="px-4 py-2">Nom</th>
                                <th class="px-4 py-2">Data Estrena</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($esdeveniments as $esdeveniment)
                                <tr>
                                    <td class="border px-4 py-2">{{ $esdeveniment->nom }}</td>
                                    <td class="border px-4 py-2">{{ $esdeveniment->data_estrena }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Esdeveniment -->
                                        <a href="{{ route('esdeveniments.show', $esdeveniment->id_esdeveniment) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Esdeveniment -->
                                        <a href="{{ route('esdeveniments.edit', $esdeveniment->id_esdeveniment) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Esdeveniment -->
                                        <form action="{{ route('esdeveniments.destroy', $esdeveniment->id_esdeveniment) }}" method="POST" style="display:inline">
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
