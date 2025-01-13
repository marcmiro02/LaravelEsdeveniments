<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('qrs.update', $qr->id_qr) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="codi_qr" class="block text-sm font-medium text-gray-700">Codi QR</label>
                            <input type="text" name="codi_qr" class="mt-1 block w-full text-black" value="{{ $qr->codi_qr }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_generacio" class="block text-sm font-medium text-gray-700">Data Generació</label>
                            <input type="date" name="data_generacio" class="mt-1 block w-full text-black" value="{{ $qr->data_generacio }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_expiracio" class="block text-sm font-medium text-gray-700">Data Expiració</label>
                            <input type="date" name="data_expiracio" class="mt-1 block w-full text-black" value="{{ $qr->data_expiracio }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_esdeveniment" class="block text-sm font-medium text-gray-700">Esdeveniment</label>
                            <input type="number" name="id_esdeveniment" class="mt-1 block w-full text-black" value="{{ $qr->id_esdeveniment }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_usuari" class="block text-sm font-medium text-gray-700">Usuari</label>
                            <input type="number" name="id_usuari" class="mt-1 block w-full text-black" value="{{ $qr->id_usuari }}" required>
                        </div>
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>