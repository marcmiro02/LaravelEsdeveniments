<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Estat del Seient</h3>


            <form action="{{ route('estat_seients.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="mb-4">
                    <label for="nom_estat_seient" class="block text-lg font-medium text-gray-100">Nom de l'Estat del
                        Seient</label>
                    <input type="text" id="nom_estat_seient" name="nom_estat_seient"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Crear Estat del Seient
                </button>
            </form>
        </div>
    </div>
</x-app-layout>