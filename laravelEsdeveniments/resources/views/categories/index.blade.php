<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="text-lg font-medium">
                            {{ __("Llistat de categories") }}
                        </h3>
                        <a href="{{ route('categories.create') }}" 
                           class="flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <span class="mr-2">📂</span> Afegir Categoria
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
                                <th class="px-4 py-2">Nom Categoria</th>
                                <th class="px-4 py-2">Accions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $categoria)
                                <tr>
                                    <td class="border px-4 py-2">{{ $categoria->nom_categoria }}</td>
                                    <td class="border px-4 py-2">
                                        <!-- Ver Categoria -->
                                        <a href="{{ route('categories.show', ['id_categoria' => $categoria->id_categoria]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Veure</a>

                                        <!-- Editar Categoria -->
                                        <a href="{{ route('categories.edit', ['id_categoria' => $categoria->id_categoria]) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>

                                        <!-- Eliminar Categoria -->
                                        <form action="{{ route('categories.destroy', ['id_categoria' => $categoria->id_categoria]) }}" method="POST" style="display:inline">
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