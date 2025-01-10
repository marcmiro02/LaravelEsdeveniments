<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('qrs.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="codi_qr" class="block text-sm font-medium text-gray-700">Codi QR</label>
                            <input type="text" id="codi_qr" name="codi_qr" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_generacio" class="block text-sm font-medium text-gray-700">Data de Generació</label>
                            <input type="date" id="data_generacio" name="data_generacio" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="data_expiracio" class="block text-sm font-medium text-gray-700">Data d'Expiració</label>
                            <input type="date" id="data_expiracio" name="data_expiracio" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_esdeveniment" class="block text-sm font-medium text-gray-700">ID Esdeveniment</label>
                            <input type="number" id="id_esdeveniment" name="id_esdeveniment" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="id_usuari" class="block text-sm font-medium text-gray-700">ID Usuari</label>
                            <input type="number" id="id_usuari" name="id_usuari" class="mt-1 block w-full text-black" required>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Crear QR</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>