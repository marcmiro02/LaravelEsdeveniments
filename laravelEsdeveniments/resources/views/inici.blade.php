<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-black to-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8 transform transition-all duration-500 hover:scale-105">
                <div class="p-8 text-white">
                    <h1 class="text-5xl font-bold mb-4 animate-pulse">Benvingut a DAM</h1>
                    <p class="text-xl mb-4">Descobreix les últimes pel·lícules i esdeveniments a la teva sala de cinema preferida.</p>
                </div>
            </div>

            <!-- Movies Section (Vertical List) -->
            <div class="bg-gray-800 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h2 class="text-4xl font-bold mb-8 text-center text-rose-600">Pel·lícules en Cartellera</h2>
                    <div class="space-y-8">
                        <!-- Movie Card -->
                        @foreach($esdeveniments as $esdeveniment)
                            <div class="flex bg-gray-700 dark:bg-gray-800 p-8 rounded-lg transform transition-all duration-300 hover:scale-102 hover:shadow-2xl">
                                <div class="w-1/3 h-96 overflow-hidden rounded-lg mr-8 shadow-lg">
                                    <img src="data:image/png;base64,{{ $esdeveniment->foto_portada ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-full object-cover transform transition-all duration-500 hover:scale-110">
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-3xl font-bold mb-4 text-rose-600">{{ $esdeveniment->nom }}</h3>
                                    <p class="mb-6 text-lg">{{ $esdeveniment->sinopsis }}</p>
                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <p class="text-lg"><strong>Duració:</strong> {{ $esdeveniment->duracio ?? 'No disponible' }}</p><br>
                                        <p class="text-lg"><strong>Edat Recomanada:</strong> {{ $esdeveniment->edats ?? 'No especificada' }}</p>
                                    </div>

                                    <!-- Horarios Section -->
                                    <div class="mt-6">
                                        <h4 class="text-2xl font-bold mb-4 text-rose-600">Horaris:</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                            @if($esdeveniment->horaris && $esdeveniment->horaris->count() > 0)
                                                @foreach($esdeveniment->horaris as $horari)
                                                    <a href="#" class="bg-gray-600 dark:bg-gray-700 p-4 rounded-lg hover:bg-rose-600 dark:hover:bg-rose-600 transition-colors duration-200 transform hover:scale-105 shadow-lg">
                                                        <p class="text-lg text-center">{{ date('d/m/Y H:i', strtotime($horari->data_hora)) }}</p>
                                                    </a>
                                                @endforeach
                                            @else
                                                <p class="text-lg text-gray-500">No hi ha horaris disponibles per aquest esdeveniment.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>