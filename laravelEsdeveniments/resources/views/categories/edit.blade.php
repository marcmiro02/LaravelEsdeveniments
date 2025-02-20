<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-md w-full text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Categoria</h3>

            <!-- Form -->
            <form action="{{ route('categories.update', $categoria->id_categoria) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nom de la categoria -->
                <div>
                    <label for="nom_categoria" class="block text-lg font-medium text-gray-100">Nom de la categoria</label>
                    <input type="text" id="nom_categoria" name="nom_categoria" value="{{ $categoria->nom_categoria }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                           required>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Actualitzar Categoria
                </button>
            </form>
        </div>
    </div>
</x-app-layout>