<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title -->
            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Escull el tipus de sala que vols crear</h3>
            <form id="sala-form" class="space-y-6">
                <div class="mb-4">
                    <label for="tipus_sala" class="block text-lg font-medium text-gray-100">Tipus de Sala</label>
                    <select id="tipus_sala" name="tipus_sala"
                        class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white"
                        required>
                        @foreach($sales as $sala)
                            <option value="{{ $sala->id }}">{{ $sala->nom_sala }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" id="continuar-btn"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">
                    Continuar
                </button>
            </form>

        </div>
    </div>

    <script>
        document.getElementById('sala-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Evita el envío automático del formulario

            const tipusSala = document.getElementById('tipus_sala').value;

            if (!tipusSala) {
                alert('Selecciona un tipus de sala abans de continuar.');
                return;
            }

            // Redirige según el tipo de sala seleccionado
            if (tipusSala == 1) {
                window.location.href = "{{ route('sales.create') }}?tipus_sala=" + tipusSala;
            } else if (tipusSala == 2) {
                window.location.href = "{{ route('sales.createDisco') }}?tipus_sala=" + tipusSala;
            }
        });
    </script>
</x-app-layout>