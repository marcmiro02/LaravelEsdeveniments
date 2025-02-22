<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Escollir Tipus Sala') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Escull el tipus de sala que vols crear</h3>

                    <form id="sala-form">
                        <div class="mb-4">
                            <label for="tipus_sala" class="block text-sm font-medium text-gray-700">Tipus de Sala</label>
                            <select id="tipus_sala" name="tipus_sala" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                @foreach($sales as $sala)
                                    <option value="{{ $sala->id }}">{{ $sala->nom_sala }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" id="continuar-btn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Continuar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sala-form').addEventListener('submit', function(event) {
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