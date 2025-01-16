<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalls de la Sala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Nom Sala: {{ $sala->nom_sala }}</h3>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">Aforament: {{ $sala->aforament }}</h3>

                    <div class="mt-6 grid grid-cols-1 gap-4">
                        @foreach ($seients as $seient)
                            <div class="relative mx-1">
                                <button class="seat Seient_d" data-fila="{{ $seient->fila }}" data-columna="{{ $seient->columna }}" data-estat-seient="{{ $seient->estat_seient }}" data-preu="{{ $seient->preu }}">
                                    <img src="{{ asset('img/seients/Seient_d.png') }}" alt="Seient">
                                </button>
                                <input type="hidden" class="preu-seient" value="{{ $seient->preu }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>