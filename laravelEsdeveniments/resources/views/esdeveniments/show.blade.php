<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <!-- Hero Section -->
        <div class="relative h-96 bg-gradient-to-t from-black via-black/80 to-transparent">
            @if($esdeveniment->foto_fons)
                <img src="data:image/png;base64,{{ $esdeveniment->foto_fons }}" 
                     class="absolute inset-0 w-full h-full object-cover opacity-50"
                     alt="{{ $esdeveniment->nom }}">
            @endif
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center h-full">
                <div class="flex flex-col lg:flex-row gap-8 items-center">
                    <!-- Poster -->
                    <div class="w-48 lg:w-64 transform hover:scale-110 transition duration-300">
                        <img src="data:image/png;base64,{{ $esdeveniment->foto_portada }}" 
                             class="rounded-lg shadow-lg border-2 border-rose-600/50"
                             alt="{{ $esdeveniment->nom }}">
                    </div>
                    <!-- Title and Basic Info -->
                    <div class="text-white space-y-4">
                        <h1 class="text-4xl font-bold text-rose-600">{{ $esdeveniment->nom }}</h1>
                        <div class="flex gap-4 text-sm">
                            <span>{{ date('d M Y', strtotime($esdeveniment->data_estrena)) }}</span>
                            <span>•</span>
                            <span>{{ $esdeveniment->duracio }}</span>
                            <span>•</span>
                            <span>{{ $esdeveniment->edats }}+</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- Left Column: Sinopsis (Cinematic Design) -->
                <div class="space-y-8 text-gray-100 relative">
                    <div class="p-8 bg-gray-900 rounded-lg shadow-lg overflow-hidden">
                        <h3 class="text-3xl font-bold text-rose-600 mb-4">Sinopsis</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $esdeveniment->sinopsis }}</p>
                    </div>
                </div>

                <!-- Right Column: Metadata and Cast (Interactive Cards) -->
                <div class="space-y-8 text-gray-100">
                    <!-- Metadata -->
                    <div class="bg-gray-900 rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-rose-600 mb-4">Información Técnica</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 0v3a1 1 0 001 1h2a1 1 0 001-1v-3M7 10h2v3a1 1 0 001 1h2a1 1 0 001-1v-3" />
                                </svg>
                                <span><strong>Tipo:</strong> {{ $esdeveniment->tipus->nom_tipus }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                                </svg>
                                <span><strong>Género:</strong> {{ $esdeveniment->categoria->nom_categoria }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <span><strong>Sala:</strong> {{ $esdeveniment->sala->nom_sala }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Cast -->
                    <div class="bg-gray-900 rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-rose-600 mb-4">Reparto</h3>
                        <p class="text-lg">{{ $esdeveniment->actors }}</p>
                        <h3 class="text-2xl font-bold text-rose-600 mt-6">Director</h3>
                        <p class="text-lg">{{ $esdeveniment->director }}</p>
                    </div>

                    <!-- Trailer -->
                    @if($esdeveniment->trailer)
                    <div class="bg-gray-900 rounded-lg shadow-lg p-8">
                        <h3 class="text-2xl font-bold text-rose-600 mb-4">Tráiler</h3>
                        <div class="mt-4">
                            <a href="{{ $esdeveniment->trailer }}" target="_blank" 
                               class="inline-flex items-center px-6 py-3 bg-rose-600 hover:bg-rose-500 text-white rounded-lg transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                </svg>
                                Ver Tráiler
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Horarios Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="bg-black dark:bg-black rounded-lg shadow-lg overflow-hidden">
                <div class="p-8 text-gray-100">
                    <h3 class="text-3xl font-bold text-rose-600 mb-6">Horarios Disponibles</h3>
                    @if ($esdeveniment->horaris && $esdeveniment->horaris->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach ($esdeveniment->horaris->sortBy('data_hora') as $horari)
                                <form action="{{ route('sales.seients.redirect') }}" method="POST" 
                                      class="bg-gray-800 hover:bg-gray-700 p-4 rounded-lg shadow-md transition-colors duration-300">
                                    @csrf
                                    <input type="hidden" name="id_sala" value="{{ $esdeveniment->id_sala }}">
                                    <input type="hidden" name="id_esdeveniment" value="{{ $esdeveniment->id_esdeveniment }}">
                                    <input type="hidden" name="fecha" value="{{ $horari->data_hora }}">
                                    <button type="submit" 
                                            class="w-full text-center bg-transparent hover:text-rose-600 transition-colors duration-300">
                                        <p class="text-lg font-medium">{{ date('d M H:i', strtotime($horari->data_hora)) }}</p>
                                    </button>
                                </form>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-400 py-8">No hay horarios disponibles para este evento.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>