<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            @if($empresa)
                <div class="relative bg-gradient-to-r from-black to-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8 h-48 lg:h-64 xl:h-72 2xl:h-80">
                    <img src="data:image/png;base64,{{ $empresa->logo_capsalera }}" alt="{{ $empresa->nom_empresa }}" class="absolute inset-0 w-full h-full object-cover object-bottom">
                    <div class="absolute bottom-0 left-0 p-8 text-white bg-black bg-opacity-50">
                        <h1 class="text-5xl font-bold mb-4">{{ $empresa->nom_empresa }}</h1>
                    </div>
                </div>
            @endif

            <!-- Movies Section (Vertical List) -->
            <div class="bg-black dark:bg-black overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h2 class="text-4xl font-bold mb-8 text-center text-rose-600">ESDEVENIMENTS EN CARTELLERA</h2>
                    <div class="space-y-8">
                        <!-- Movie Card -->
                        @if($esdeveniments)
                            @foreach($esdeveniments as $esdeveniment)
                                <div class="flex bg-gray-900 dark:bg-gray-900 p-8 rounded-lg shadow-2xl">
                                    <div class="w-1/3 h-96 overflow-hidden rounded-lg mr-8 shadow-lg">
                                        <img src="data:image/png;base64,{{ $esdeveniment->foto_portada ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-full object-cover brightness-110">
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="text-3xl font-bold mb-4 text-rose-600">{{ $esdeveniment->nom }}</h3>
                                        <p class="mb-6 text-lg">{{ $esdeveniment->sinopsis }}</p>
                                        <div class="grid grid-cols-2 gap-4 mb-6">
                                        <p class="text-lg"><strong>Duració:</strong> {{ $esdeveniment->duracio ? date('H:i', strtotime($esdeveniment->duracio)) : 'No disponible' }}h</p><br>                                            <p class="text-lg"><strong>Edat Recomanada:</strong> {{ $esdeveniment->edats ?? 'No especificada' }}</p>
                                        </div>

                                        <!-- Horarios Section -->
                                        <div class="mt-6">
                                            <h4 class="text-2xl font-bold mb-4 text-rose-600">Horaris:</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                                                @if($esdeveniment->horaris && $esdeveniment->horaris->count() > 0)
                                                @foreach($esdeveniment->horaris->sortBy('data_hora') as $horari)
                                                    <form action="{{ route('sales.seients.redirect') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id_sala" value="{{ $esdeveniment->id_sala }}">
                                                        <input type="hidden" name="fecha" value="{{ $horari->data_hora }}">
                                                        <button type="submit" class="bg-gray-600 dark:bg-gray-700 p-4 rounded-lg hover:bg-rose-600 dark:hover:bg-rose-600 transition-colors duration-200 transform hover:scale-105 shadow-lg">
                                                            <p class="text-lg text-center">{{ date('d/m/Y H:i', strtotime($horari->data_hora)) }}</p>
                                                        </button>
                                                    </form>
                                                @endforeach
                                                @else
                                                    <p class="text-lg text-gray-500">No hi ha horaris disponibles per aquest esdeveniment.</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-lg text-gray-500">No hi ha esdeveniments disponibles per aquesta empresa.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>