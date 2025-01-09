<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Sala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('sales.update', $sala->id_sala) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nom_sala" class="block text-sm font-medium text-gray-700">Nom de la sala</label>
                            <input type="text" id="nom_sala" name="nom_sala" value="{{ $sala->nom_sala }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="aforament" class="block text-sm font-medium text-gray-700">Aforament</label>
                            <input type="number" id="aforament" name="aforament" value="{{ $sala->aforament }}" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>