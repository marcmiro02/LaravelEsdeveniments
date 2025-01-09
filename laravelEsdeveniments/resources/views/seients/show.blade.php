<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalls del Seient') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Fila: {{ $seient->fila }}</h3>
                    <p class="text-black"><strong>Columna:</strong> {{ $seient->columna }}</p>
                    <p class="text-black"><strong>Preu:</strong> {{ $seient->preu }}</p>
                    <p class="text-black"><strong>Estat del Seient:</strong> {{ $seient->estat_seient }}</p>
                    <p class="text-black"><strong>ID de la Sala:</strong> {{ $seient->id_sala }}</p>

                    <a href="{{ route('seients.edit', $seient->id_seient) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                    <form action="{{ route('seients.destroy', $seient->id_seient) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>