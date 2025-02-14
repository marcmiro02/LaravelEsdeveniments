<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Detalls de l'Entrada</h3>

            <!-- Form -->
            <form action="{{ route('entrades.update', $entrada->id_entrada) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Tipus d'Entrada -->
                <div>
                    <label for="tipus_entrada" class="block text-lg font-medium text-gray-100">Tipus d'Entrada</label>
                    <input type="text" id="tipus_entrada" name="tipus_entrada" value="{{ $entrada->tipus_entrada }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Descompte -->
                <div>
                    <label for="descompte" class="block text-lg font-medium text-gray-100">Descompte (%)</label>
                    <input type="number" id="descompte" name="descompte" value="{{ $entrada->descompte }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Actualitzar Entrada
                </button>
            </form>
        </div>
    </div>
</x-app-layout>