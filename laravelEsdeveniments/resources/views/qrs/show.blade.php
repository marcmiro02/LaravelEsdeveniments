<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalls del QR') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Codi QR: {{ $qr->codi_qr }}</h3>
                    <p class="text-black"><strong>Data Generació:</strong> {{ $qr->data_generacio }}</p>
                    <p class="text-black"><strong>Data Expiració:</strong> {{ $qr->data_expiracio }}</p>
                    <p class="text-black"><strong>Esdeveniment:</strong> {{ $qr->id_esdeveniment }}</p>
                    <p class="text-black"><strong>Usuari:</strong> {{ $qr->id_usuari }}</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>