<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Tipus de Seient</h3>

            <form action="{{ route('tipus_seients.update', $tipusSeient->id_tipus_seient) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="nom_tipus_seient" class="block text-lg font-medium text-gray-100">Nom del Tipus de Seient</label>
                    <input type="text" id="nom_tipus_seient" name="nom_tipus_seient" value="{{ $tipusSeient->nom_tipus_seient }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>

                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Actualitzar</button>
            </form>
        </div>
    </div>
</x-app-layout>