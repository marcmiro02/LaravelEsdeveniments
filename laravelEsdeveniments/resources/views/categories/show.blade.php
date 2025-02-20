<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Details Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-md w-full text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Detalls de la categoria</h3>

            <!-- Category Name -->
            <div class="mb-6">
                <strong class="block text-lg font-medium text-gray-100 mb-2">Nom de la categoria:</strong>
                <p class="text-xl font-semibold text-white">{{ $categoria->nom_categoria }}</p>
            </div>

            <!-- Actions -->
            <div class="flex justify-center space-x-4">
                <!-- Edit Button -->
                <a href="{{ route('categories.edit', $categoria->id_categoria) }}" 
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Editar
                </a>

                <!-- Delete Button -->
                <form action="{{ route('categories.destroy', $categoria->id_categoria) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-6 rounded transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>