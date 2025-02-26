<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Sala Discoteca</h3>


            <form action="{{ route('sales.guardarDisco') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Campo: Nom Sala -->
                <div class="mb-4">
                    <label for="nom_sala" class="block text-lg font-medium text-gray-100">Nom Sala</label>
                    <input type="text" id="nom_sala" name="nom_sala"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>

                <!-- Campo: Aforament -->
                <div class="mb-4">
                    <label for="aforament" class="block text-lg font-medium text-gray-100">Aforament</label>
                    <input type="number" id="aforament" name="aforament"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>

                <!-- Campos Ocultos -->
                <input type="hidden" name="id_empresa" value="{{ auth()->user()->id_empresa }}">
                <input type="hidden" name="id_tipus_sala" value="{{ $tipusSala }}">

                <!-- Botón de Envío -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Crear Sala
                </button>
            </form>
        </div>
    </div>
</x-app-layout>