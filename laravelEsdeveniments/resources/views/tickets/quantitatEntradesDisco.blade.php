<x-app-layout>
    <div class="min-h-screen bg-black flex justify-center items-center">
        <div class="max-w-4xl w-full bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-8 text-gray-100 dark:text-gray-100">

            @php
                // Recuperamos los datos de la sesión
                $id_sala = session('id_sala');
                $id_esdeveniment = session('id_esdeveniment');
                $fecha = session('fecha_seleccionada');
                $id_tipus_sala = session('id_tipus_sala');

                // Obtener el evento con base en el id_esdeveniment
                $esdeveniment = \App\Models\Esdeveniments::find($id_esdeveniment);
            @endphp

            <!-- Hero Section -->
            <div class="relative bg-gradient-to-r from-black to-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8 h-56">
                @if(isset($esdeveniment->foto_fons))
                    <img src="data:image/png;base64,{{ $esdeveniment->foto_fons }}" alt="Fons {{ $esdeveniment->nom }}" class="absolute inset-0 w-full h-full object-cover opacity-50">
                @endif
                <div class="absolute bottom-0 left-0 p-6 text-white bg-black bg-opacity-60 w-full">
                    <h1 class="text-4xl font-bold">{{ $esdeveniment->nom ?? 'Nom de l\'esdeveniment' }}</h1>
                </div>
            </div>

            <!-- Event Details -->
            <div class="text-center">
                @if(isset($esdeveniment->foto_portada))
                    <img src="data:image/png;base64,{{ $esdeveniment->foto_portada }}" alt="Portada {{ $esdeveniment->nom }}" class="w-48 h-48 mx-auto rounded-lg shadow-lg mb-6">
                @endif
                <h2 class="text-3xl font-bold text-rose-600">{{ $esdeveniment->nom ?? 'Nom de l\'esdeveniment' }}</h2>
                <p class="text-lg mt-4">{{ $esdeveniment->sinopsis ?? 'Descripció no disponible' }}</p>
            </div>

            <!-- Ticket Quantity Selection -->
            <form action="{{ route('tickets.orderSummaryDisco') }}" method="POST" class="mt-8">
                @csrf
                <input type="hidden" name="id_esdeveniment" value="{{ $id_esdeveniment }}">
                <input type="hidden" name="id_sala" value="{{ $id_sala }}">
                <input type="hidden" name="fecha" value="{{ $fecha }}">
                <input type="hidden" name="id_tipus_sala" value="{{ $id_tipus_sala }}">

                <div class="flex flex-col items-center space-y-4">
                    <label for="quantitat" class="text-xl font-semibold text-gray-300">Selecciona la quantitat d'entrades:</label>
                    <input type="number" id="quantitat" name="quantitat" min="1" max="10" value="1" class="w-24 p-2 text-lg text-center bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-rose-600">
                </div>

                <div class="mt-6 flex justify-center">
                    <button type="submit" class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                        Continuar
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
