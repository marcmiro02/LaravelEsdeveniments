<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalls del Tipus d\'Esdeveniment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Nom del Tipus d'Esdeveniment: {{ $tipusEsdeveniment->nom_tipus }}</h3>

                    <a href="{{ route('tipus_esdeveniments.edit', $tipusEsdeveniment->id_tipus) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                    <form action="{{ route('tipus_esdeveniments.destroy', $tipusEsdeveniment->id_tipus) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>