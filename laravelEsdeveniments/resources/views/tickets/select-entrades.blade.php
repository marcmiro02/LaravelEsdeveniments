<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center text-rose-600 mb-4">{{ strtoupper($esdeveniment->nom) }}</h1>
                    <div class="flex justify-center">
                        <img src="data:image/png;base64,{{ $esdeveniment->foto_portada ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-96 object-cover mb-4">
                    </div>
                    
                    <!-- Línea de Progreso -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex-1">
                            <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                                <div class="bg-rose-600 h-3 rounded-full" style="width: 50%;"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between w-full mt-2">
                            <div class="text-center">
                                <div class="w-14 h-14 bg-rose-600 text-white rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-rose-600">Triar Seient</span>
                            </div>
                            <div class="text-center">
                                <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-clapperboard text-2xl"></i>
                                </div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Triar Entrada</span>
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

                    <div id="seats-summary" class="mb-4">
                        <h4 class="text-md font-medium text-rose-600">Seients Seleccionats:</h4>
                        <ul id="selected-seats-list" class="list-disc pl-5"></ul>
                    </div>
                    <br>
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
                                            <input type="number" min="0" value="0" class="entrada-quantitat w-full bg-gray-800 text-white border border-gray-600 rounded-lg px-2 py-1" data-descompte="{{ $entrada->descompte }}">
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
            const selectedSeatsList = document.getElementById('selected-seats-list');
            const payButton = document.getElementById('pay-button');
            let totalEntrades = 0;

            // Recuperar els seients seleccionats de localStorage
            const selectedSeats = JSON.parse(localStorage.getItem('selectedSeats')) || [];
            console.log('Seients seleccionats:', selectedSeats);

            // Mostrar els seients seleccionats
            selectedSeats.forEach(seat => {
                const listItem = document.createElement('li');
                listItem.textContent = `Fila ${seat.fila}, Columna ${seat.columna} - Preu: ${seat.preu}€`;
                selectedSeatsList.appendChild(listItem);
            });

            const maxEntrades = selectedSeats.length;
            selectedEntradesCount.textContent = `0/${maxEntrades}`;

            quantitatInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const descompte = parseFloat(this.dataset.descompte);
                    let preuTotal = 0;

                    // Recorremos todos los asientos seleccionados y calculamos el subtotal para cada uno
                    selectedSeats.forEach((seat, index) => {
                        const preuAmbDescompte = seat.preu - (seat.preu * (descompte / 100));
                        const quantitat = parseInt(input.value);
                        const subtotalElement = this.closest('tr').querySelector('.entrada-subtotal');

                        // Establecer el subtotal por asiento
                        subtotalElement.textContent = (preuAmbDescompte * quantitat).toFixed(2) + '€';

                        // Acumular el total de entradas seleccionadas
                        preuTotal += preuAmbDescompte * quantitat;
                    });

                    totalEntrades = Array.from(quantitatInputs).reduce((total, input) => total + parseInt(input.value), 0);
                    selectedEntradesCount.textContent = `${totalEntrades}/${maxEntrades}`;

                    if (totalEntrades > maxEntrades) {
                        this.value = quantitat - (totalEntrades - maxEntrades);
                        subtotalElement.textContent = (preuAmbDescompte * this.value).toFixed(2) + '€';
                        totalEntrades = maxEntrades;
                        selectedEntradesCount.textContent = `${totalEntrades}/${maxEntrades}`;
                    }

                    payButton.disabled = totalEntrades !== maxEntrades;
                });
            });

            payButton.addEventListener('click', function() {
                const selectedEntrades = Array.from(quantitatInputs).map(input => {
                const tipusEntrada = input.closest('tr').querySelector('td:first-child').textContent;
                const descompte = parseFloat(input.dataset.descompte);
                const quantitat = parseInt(input.value);
                const subtotal = parseFloat(input.closest('tr').querySelector('.entrada-subtotal').textContent);

                // Asignar fila y columna a cada entrada
                const entradesConSeients = [];
                for (let i = 0; i < quantitat; i++) {
                    const seat = selectedSeats[i]; // Asignar un asiento a cada entrada
                    entradesConSeients.push({
                        tipus_entrada: tipusEntrada,
                        descompte: descompte,
                        preu: seat.preu, // Precio del asiento
                        quantitat: 1, // Cada entrada es para un asiento
                        fila: seat.fila, // Fila del asiento
                        columna: seat.columna // Columna del asiento
                    });
                }

                return entradesConSeients;
            }).flat().filter(entrada => entrada.quantitat > 0);

            localStorage.setItem('selectedEntrades', JSON.stringify(selectedEntrades));
            window.location.href = "{{ route('tickets.orderSummary', ['id_esdeveniment' => $esdeveniment->id_esdeveniment]) }}";
        });
    });
    </script>
</x-app-layout>