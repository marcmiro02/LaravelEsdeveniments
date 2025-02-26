<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Codi Promocional</h3>

            <!-- Form -->
            <form action="{{ route('codis_promocionals.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nom del Codi -->
                <div>
                    <label for="nom_codi" class="block text-lg font-medium text-gray-100">Nom del Codi</label>
                    <input type="text" id="nom_codi" name="nom_codi" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Descompte -->
                <div>
                    <label for="descompte" class="block text-lg font-medium text-gray-100">Descompte</label>
                    <input type="number" id="descompte" name="descompte" step="0.01" min="0" max="100"
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Crear Codi Promocional
                </button>
            </form>
        </div>
    </div>
</x-app-layout>