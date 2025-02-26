<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Detalls de l'Entrada</h3>

            <form action="{{ route('esdeveniments.update', $esdeveniment->id_esdeveniment) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="nom" class="block text-lg font-medium text-gray-100">Nom</label>
                    <input type="text" id="nom" name="nom" value="{{ $esdeveniment->nom }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                <div class="mb-4">
                    <label for="foto_portada" class="block text-lg font-medium text-gray-100">Foto Portada</label>
                    <input type="file" id="foto_portada" name="foto_portada" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="foto_fons" class="block text-lg font-medium text-gray-100">Foto Fons</label>
                    <input type="file" id="foto_fons" name="foto_fons" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="duracio" class="block text-lg font-medium text-gray-100">Duració</label>
                    <input type="text" id="duracio" name="duracio" value="{{ $esdeveniment->duracio }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="sinopsis" class="block text-lg font-medium text-gray-100">Sinopsis</label>
                    <textarea id="sinopsis" name="sinopsis" 
                              class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">{{ $esdeveniment->sinopsis }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="trailer" class="block text-lg font-medium text-gray-100">Tràiler (Enllaç de YouTube)</label>
                    <input type="url" id="trailer" name="trailer" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           value="{{ $esdeveniment->trailer }}">
                </div>
                <div class="mb-4">
                    <label for="director" class="block text-lg font-medium text-gray-100">Director</label>
                    <input type="text" id="director" name="director" value="{{ $esdeveniment->director }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="actors" class="block text-lg font-medium text-gray-100">Actors</label>
                    <textarea id="actors" name="actors" 
                              class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">{{ $esdeveniment->actors }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="data_estrena" class="block text-lg font-medium text-gray-100">Data Estrena</label>
                    <input type="date" id="data_estrena" name="data_estrena" value="{{ $esdeveniment->data_estrena }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="edats" class="block text-lg font-medium text-gray-100">Edats</label>
                    <select id="edats" name="edats" 
                            class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                        <option value="TD" {{ $esdeveniment->edats == 'TD' ? 'selected' : '' }}>TD</option>
                        <option value="+7" {{ $esdeveniment->edats == '+7' ? 'selected' : '' }}>+7</option>
                        <option value="+12" {{ $esdeveniment->edats == '+12' ? 'selected' : '' }}>+12</option>
                        <option value="+16" {{ $esdeveniment->edats == '+16' ? 'selected' : '' }}>+16</option>
                        <option value="+18" {{ $esdeveniment->edats == '+18' ? 'selected' : '' }}>+18</option>
                        <option value="XXX" {{ $esdeveniment->edats == 'XXX' ? 'selected' : '' }}>XXX</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_tipus" class="block text-lg font-medium text-gray-100">Tipus</label>
                    <input type="number" id="id_tipus" name="id_tipus" value="{{ $esdeveniment->id_tipus }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="id_categoria" class="block text-lg font-medium text-gray-100">Categoria</label>
                    <input type="number" id="id_categoria" name="id_categoria" value="{{ $esdeveniment->id_categoria }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="id_sala" class="block text-lg font-medium text-gray-100">Sala</label>
                    <input type="number" id="id_sala" name="id_sala" value="{{ $esdeveniment->id_sala }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="id_empresa" class="block text-lg font-medium text-gray-100">Empresa</label>
                    <input type="number" id="id_empresa" name="id_empresa" value="{{ $esdeveniment->id_empresa }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Actualitzar</button>
            </form>
        </div>
    </div>
</x-app-layout>