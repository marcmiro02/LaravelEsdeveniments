<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Sala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('sales.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="nom_sala" class="block text-sm font-medium text-gray-700">Nom de la sala</label>
                            <input type="text" id="nom_sala" name="nom_sala" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="aforament" class="block text-sm font-medium text-gray-700">Aforament</label>
                            <input type="number" id="aforament" name="aforament" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear Sala</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>