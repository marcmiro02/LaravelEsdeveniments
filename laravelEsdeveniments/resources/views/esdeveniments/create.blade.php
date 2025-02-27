<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">
            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Crear Esdeveniment</h3>
            <form action="{{ route('esdeveniments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div class="mb-4">
                    <label for="nom" class="block text-lg font-medium text-gray-100">Nom</label>
                    <input type="text" id="nom" name="nom"
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
                    <input type="text" id="duracio" name="duracio"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="sinopsis" class="block text-lg font-medium text-gray-100">Sinopsis</label>
                    <textarea id="sinopsis" name="sinopsis"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"></textarea>
                </div>
                <div class="mb-4">
                    <label for="data_estrena" class="block text-lg font-medium text-gray-100">Data Estrena</label>
                    <input type="date" id="data_estrena" name="data_estrena"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                <div class="mb-4">
                    <label for="edats" class="block text-lg font-medium text-gray-100">Edats</label>
                    <select id="edats" name="edats"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                        <option value="TD">TD</option>
                        <option value="+7">+7</option>
                        <option value="+12">+12</option>
                        <option value="+16">+16</option>
                        <option value="+18">+18</option>
                        <option value="XXX">XXX</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_tipus" class="block text-lg font-medium text-gray-100">Tipus</label>
                    <select id="id_tipus" name="id_tipus"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        onchange="updateForm()">
                        @foreach($tipusEsdeveniments as $tipus)
                            <option value="{{ $tipus->id_tipus }}">{{ $tipus->nom_tipus }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="id_categoria" class="block text-lg font-medium text-gray-100">Categoria</label>
                    <select id="id_categoria" name="id_categoria"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                        @foreach($categories as $categoria)
                            <option value="{{ $categoria->id_categoria }}" data-type="{{ $categoria->id_categoria == 12 ? 'disco' : 'cinema' }}">
                                {{ $categoria->nom_categoria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Campos condicionales -->
                <div id="cinema-fields" class="space-y-4" style="display: none;">
                    <div class="mb-4">
                        <label for="trailer" class="block text-lg font-medium text-gray-100">Tràiler (Enllaç de YouTube)</label>
                        <input type="url" id="trailer" name="trailer"
                            class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                    </div>
                    <div class="mb-4">
                        <label for="director" class="block text-lg font-medium text-gray-100">Director</label>
                        <input type="text" id="director" name="director"
                            class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                    </div>
                    <div class="mb-4">
                        <label for="actors" class="block text-lg font-medium text-gray-100">Actors</label>
                        <textarea id="actors" name="actors"
                            class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"></textarea>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="id_sala" class="block text-lg font-medium text-gray-100">Sala</label>
                    <select id="id_sala" name="id_sala"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                        @foreach($sales as $sala)
                            <option value="{{ $sala->id_sala }}">{{ $sala->nom_sala }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="id_empresa" class="block text-lg font-medium text-gray-100">Empresa</label>
                    <input type="number" id="id_empresa" name="id_empresa"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        value="{{ Auth::user()->id_empresa }}" readonly>
                </div>
                <button type="submit"
                    class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Crear Esdeveniment
                </button>
            </form>
        </div>
    </div>

    <script>
        // Almacenar las opciones originales del select de categorías
        let originalCategories = Array.from(document.getElementById('id_categoria').options);

        function updateForm() {
            const tipusSelect = document.getElementById('id_tipus');
            const categoriaSelect = document.getElementById('id_categoria');
            const cinemaFields = document.getElementById('cinema-fields');

            // Limpiar el select actual
            while (categoriaSelect.firstChild) {
                categoriaSelect.removeChild(categoriaSelect.firstChild);
            }

            // Filtrar las opciones según el tipo seleccionado
            const selectedTipus = tipusSelect.value;

            if (selectedTipus === '1') {
                // Mostrar campos si se selecciona "Cinema"
                cinemaFields.style.display = 'block';

                // Mostrar todas las categorías excepto la de disco (id_categoria = 12)
                originalCategories.forEach(option => {
                    if (option.dataset.type !== 'disco') {
                        categoriaSelect.add(new Option(option.text, option.value, option.defaultSelected, option.selected));
                    }
                });
            } else if (selectedTipus === '2') {
                // Ocultar campos si se selecciona "Discoteca"
                cinemaFields.style.display = 'none';

                // Mostrar solo la categoría de disco (id_categoria = 12)
                originalCategories.forEach(option => {
                    if (option.dataset.type === 'disco') {
                        categoriaSelect.add(new Option(option.text, option.value, option.defaultSelected, option.selected));
                    }
                });
            }
        }

        // Inicializar al cargar la página
        window.onload = function() {
            updateForm(); // Asegurarse de que los campos y categorías estén inicializados correctamente
        };
    </script>
</x-app-layout>