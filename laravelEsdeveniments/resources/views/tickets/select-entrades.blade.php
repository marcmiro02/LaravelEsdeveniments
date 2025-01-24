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
                    <img src="{{ asset('img/esdeveniments/' . $esdeveniment->foto_portada) }}" alt="{{ $esdeveniment->nom }}" class="w-full h-auto">
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
                    <div id="entrades-summary">
                        <h4 class="text-md font-medium text-black">Entrades Seleccionades: <span id="selected-entrades-count">0/2</span></h4>
                        <table class="table-auto w-full">
                            <thead>
                                <tr>
                                    <th>Tipus d'Entrada</th>
                                    <th>Preu amb Descompte</th>
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
                                            <input type="number" min="0" max="2" value="0" class="entrada-quantitat" data-descompte="{{ $entrada->descompte }}" data-preu="{{ $entrada->preu }}">
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
            const payButton = document.getElementById('pay-button');
            let totalEntrades = 0;
            const maxEntrades = 2;

            quantitatInputs.forEach(input => {
                input.addEventListener('input', function() {
                    const preu = parseFloat(this.dataset.preu);
                    const descompte = parseFloat(this.dataset.descompte);
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
                window.location.href = "{{ route('tickets.orderSummary') }}";
            });
        });
    </script>
</x-app-layout>