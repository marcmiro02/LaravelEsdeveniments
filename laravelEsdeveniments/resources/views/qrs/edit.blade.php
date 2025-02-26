<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Detalls de l'Entrada</h3>

            <form action="{{ route('qrs.update', $qr->id_qr) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="codi_qr" class="block text-lg font-medium text-gray-100">Codi QR</label>
                    <input type="text" name="codi_qr" class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" value="{{ $qr->codi_qr }}" required>
                </div>
                <div class="mb-4">
                    <label for="data_generacio" class="block text-lg font-medium text-gray-100">Data Generació</label>
                    <input type="date" name="data_generacio" class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" value="{{ $qr->data_generacio }}" required>
                </div>
                <div class="mb-4">
                    <label for="data_expiracio" class="block text-lg font-medium text-gray-100">Data Expiració</label>
                    <input type="date" name="data_expiracio" class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" value="{{ $qr->data_expiracio }}" required>
                </div>
                <div class="mb-4">
                    <label for="id_esdeveniment" class="block text-lg font-medium text-gray-100">Esdeveniment</label>
                    <input type="number" name="id_esdeveniment" class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" value="{{ $qr->id_esdeveniment }}" required>
                </div>
                <div class="mb-4">
                    <label for="id_usuari" class="block text-lg font-medium text-gray-100">Usuari</label>
                    <input type="number" name="id_usuari" class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" value="{{ $qr->id_usuari }}" required>
                </div>
                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Actualitzar</button>
            </form>
        </div>
    </div>
</x-app-layout>