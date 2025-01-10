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
                    <p class="text-black"><strong>Data de Generació:</strong> {{ $qr->data_generacio }}</p>
                    <p class="text-black"><strong>Data d'Expiració:</strong> {{ $qr->data_expiracio }}</p>
                    <p class="text-black"><strong>ID Esdeveniment:</strong> {{ $qr->id_esdeveniment }}</p>
                    <p class="text-black"><strong>ID Usuari:</strong> {{ $qr->id_usuari }}</p>

                    <a href="{{ route('qrs.edit', $qr->id_qr) }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Editar</a>
                    <form action="{{ route('qrs.destroy', $qr->id_qr) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>