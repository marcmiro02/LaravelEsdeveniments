<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalls de l\'Esdeveniment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Nom: {{ $esdeveniment->nom }}</h3>
                    <p class="text-black"><strong>Data Estrena:</strong> {{ $esdeveniment->data_estrena }}</p>
                    <p class="text-black"><strong>Duració:</strong> {{ $esdeveniment->duracio }}</p>
                    <p class="text-black"><strong>Sinopsis:</strong> {{ $esdeveniment->sinopsis }}</p>
                    <p class="text-black"><strong>Director:</strong> {{ $esdeveniment->director }}</p>
                    <p class="text-black"><strong>Actors:</strong> {{ $esdeveniment->actors }}</p>
                    <p class="text-black"><strong>Edats:</strong> {{ $esdeveniment->edats }}</p>
                    <p class="text-black"><strong>Tipus:</strong> {{ $esdeveniment->id_tipus }}</p>
                    <p class="text-black"><strong>Categoria:</strong> {{ $esdeveniment->id_categoria }}</p>
                    <p class="text-black"><strong>Sala:</strong> {{ $esdeveniment->id_sala }}</p>
                    <p class="text-black"><strong>Empresa:</strong> {{ $esdeveniment->id_empresa }}</p>
                    @if($esdeveniment->foto_portada)
                        <p class="text-black"><strong>Foto Portada:</strong></p>
                        <img src="{{ asset($esdeveniment->foto_portada) }}" alt="{{ $esdeveniment->nom }}" style="max-width: 200px;">
                    @endif
                    @if($esdeveniment->foto_fons)
                        <p class="text-black"><strong>Foto Fons:</strong></p>
                        <img src="{{ asset($esdeveniment->foto_fons) }}" alt="{{ $esdeveniment->nom }}" style="max-width: 200px;">
                    @endif
                    @if($esdeveniment->trailer)
                        <p class="text-black"><strong>Trailer:</strong></p>
                        <a href="{{ $esdeveniment->trailer }}" target="_blank" class="text-blue-500 hover:text-blue-700">{{ $esdeveniment->trailer }}</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>