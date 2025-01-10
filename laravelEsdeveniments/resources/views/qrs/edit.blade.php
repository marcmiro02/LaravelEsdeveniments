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
                            <input type="text" id="codi_qr" name="codi_qr" value="{{ $qr->codi_qr }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_generacio" class="block text-sm font-medium text-gray-700">Data de Generació</label>
                            <input type="date" id="data_generacio" name="data_generacio" value="{{ $qr->data_generacio }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_expiracio" class="block text-sm font-medium text-gray-700">Data d'Expiració</label>
                            <input type="date" id="data_expiracio" name="data_expiracio" value="{{ $qr->data_expiracio }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_esdeveniment" class="block text-sm font-medium text-gray-700">ID Esdeveniment</label>
                            <input type="number" id="id_esdeveniment" name="id_esdeveniment" value="{{ $qr->id_esdeveniment }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_usuari" class="block text-sm font-medium text-gray-700">ID Usuari</label>
                            <input type="number" id="id_usuari" name="id_usuari" value="{{ $qr->id_usuari }}" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>