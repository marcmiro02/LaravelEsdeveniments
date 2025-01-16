<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Llista de Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom Sala</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aforament</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($sales as $sala)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sala->nom_sala }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $sala->aforament }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('sales.show', $sala->id_sala) }}" class="text-indigo-600 hover:text-indigo-900">Mostrar</a>
                                        <a href="{{ route('sales.edit', $sala->id_sala) }}" class="text-indigo-600 hover:text-indigo-900 ml-4">Editar</a>
                                        <form action="{{ route('sales.destroy', $sala->id_sala) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">Eliminar</button>
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