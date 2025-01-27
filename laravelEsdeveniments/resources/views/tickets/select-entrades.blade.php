<!-- resources/views/tickets/select-entrades.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Selecciona les Entrades') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">{{ $esdeveniment->nom }}</h3>
                    <img src="data:image/png;base64,{{ $esdeveniment->foto_portada ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-auto">
                    <br>
                    <div class="steps">
                        <ul class="list-disc pl-5">
                            <li>Triar Seient</li>
                            <li>Iniciar Sessió</li>
                            <li>Seleccionar Entrades</li>
                            <li>Resum de la Compra</li>
                            <li>Pagament</li>
                        </ul>
                    </div>
                    <br>
                    <div id="seats-summary">
                        <h4 class="text-md font-medium text-black">Seients Seleccionats:</h4>
                        <ul id="selected-seats-list" class="list-disc pl-5"></ul>
                    </div>
                    <br>
                    <div id="entrades-summary">
                        <h4 class="text-md font-medium text-black">Entrades Seleccionades: <span id="selected-entrades-count">0/0</span></h4>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th>Tipus d'Entrada</th>
                                    <th>Descompte</th>
                                    <th>Quantitat</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($entrades as $entrada)
                                    <tr>
                                        <td>{{ $entrada->tipus_entrada }}</td>
                                        <td>{{ $entrada->descompte }}%</td>
                                        <td>
                                            <input type="number" min="0" value="0" class="entrada-quantitat" data-descompte="{{ $entrada->descompte }}">
                                        </td>
                                        <td class="entrada-subtotal">0€</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <button id="pay-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" disabled>Pagar</button>
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
                    const preu = selectedSeats[0].preu; // Utilitzar el preu del primer seient seleccionat
                    const preuAmbDescompte = preu - (preu * (descompte / 100));
                    const quantitat = parseInt(this.value);
                    const subtotalElement = this.closest('tr').querySelector('.entrada-subtotal');
                    subtotalElement.textContent = (preuAmbDescompte * quantitat).toFixed(2) + '€';

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
                    return {
                        tipus_entrada: input.closest('tr').querySelector('td:first-child').textContent,
                        descompte: parseFloat(input.dataset.descompte),
                        preu: selectedSeats[0].preu, // Utilitzar el preu del primer seient seleccionat
                        quantitat: parseInt(input.value),
                        subtotal: parseFloat(input.closest('tr').querySelector('.entrada-subtotal').textContent)
                    };
                }).filter(entrada => entrada.quantitat > 0);

                localStorage.setItem('selectedEntrades', JSON.stringify(selectedEntrades));
                window.location.href = "{{ route('tickets.orderSummary') }}";
            });
        });
    </script>
</x-app-layout>