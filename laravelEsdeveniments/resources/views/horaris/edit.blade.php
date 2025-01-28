<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Horari') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('horaris.update', $horari->id_horari) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="data_hora" class="block text-sm font-medium text-gray-700">Data i Hora</label>
                            <input type="datetime-local" id="data_hora" name="data_hora" class="mt-1 block w-full text-black" value="{{ $horari->data_hora }}" required>
                        </div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>