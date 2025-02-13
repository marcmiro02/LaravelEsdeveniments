<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center text-rose-600 mb-4">
                        {{ strtoupper(optional($esdeveniment)->nom ?? 'Esdeveniment no trobat') }}
                    </h1>

                    <div class="flex justify-center">
                        @if($esdeveniment && is_object($esdeveniment) && isset($esdeveniment->foto_portada))
                            <img src="data:image/png;base64,{{ $esdeveniment->foto_portada }}" 
                                 alt="{{ $esdeveniment->nom }}" 
                                 class="w-full h-96 object-cover mb-4">
                        @else
                            <p class="text-center text-gray-500">No hi ha imatge disponible</p>
                        @endif
                    </div>

                    <div class="flex items-center justify-between mb-8">
                        <div class="flex-1">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="bg-rose-600 h-3 rounded-full" style="width: 50%;"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between w-full mt-2">
                            <div class="text-center">
                                <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Triar Seient</span>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-rose-600 text-white rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-rose-600">Triar Entrada</span>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Resum de la compra</span>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Pagament</span>
                            </div>
                        </div>
                    </div>

                    <div id="entrades-summary" class="mb-4">
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Tipus d'Entrada</th>
                                    <th class="px-4 py-2">Descompte</th>
                                    <th class="px-4 py-2">Quantitat</th>
                                    <th class="px-4 py-2">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrades as $entrada)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $entrada->tipus_entrada }}</td>
                                        <td class="border px-4 py-2">{{ $entrada->descompte }}%</td>
                                        <td class="border px-4 py-2">
                                            <input type="number" min="0" value="0" class="entrada-quantitat w-full bg-gray-800 text-white border border-gray-600 rounded-lg px-2 py-1" data-preu="{{ $entrada->preu }}" data-descompte="{{ $entrada->descompte }}">
                                        </td>
                                        <td class="border px-4 py-2 entrada-subtotal">0€</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-between mt-4">
                            <h4 class="text-md font-medium text-rose-600">Entrades Seleccionades: <span id="selected-entrades-count">0/0</span></h4>
                            <button id="pay-button" class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-2 px-4 rounded mt-2" disabled>Pagar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantitatInputs = document.querySelectorAll('.entrada-quantitat');
            const selectedEntradesCount = document.getElementById('selected-entrades-count');
            const payButton = document.getElementById('pay-button');
            let totalEntrades = 0;

            // Recuperar los asientos seleccionados de la sesión
            const selectedSeats = @json(Session::get('selectedSeats', []));
            const maxEntrades = selectedSeats.length;
            selectedEntradesCount.textContent = `0/${maxEntrades}`;

            // Actualizar las cantidades de entradas y el total
            quantitatInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const descompte = parseFloat(this.dataset.descompte);
                    const preu = parseFloat(this.dataset.preu);
                    const preuAmbDescompte = preu - (preu * (descompte / 100));
                    const quantitat = parseInt(this.value);
                    const subtotalElement = this.closest('tr').querySelector('.entrada-subtotal');
                    subtotalElement.textContent = (preuAmbDescompte * quantitat).toFixed(2) + '€';

                    // Actualizar el contador de entradas seleccionadas
                    totalEntrades = Array.from(quantitatInputs).reduce((total, input) => total + parseInt(input.value), 0);
                    selectedEntradesCount.textContent = `${totalEntrades}/${maxEntrades}`;

                    // Habilitar el botón de pago si el total es mayor a 0
                    payButton.disabled = totalEntrades === 0 || totalEntrades > maxEntrades;
                });
            });

            // Evento de pago
            payButton.addEventListener('click', function() {
                localStorage.setItem('selectedEntrades', JSON.stringify([])); // Limpiar las entradas seleccionadas
                window.location.href = "{{ route('tickets.orderSummary') }}";
            });
        });
    </script>
</x-app-layout>