<!-- resources/views/tickets/order-summary.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Resum de la Comanda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-medium text-black">Resum de la Comanda</h3>
                    <br>
                    <div id="order-summary">
                        <h4 class="text-md font-medium text-black">Nom: {{ Auth::user()->name }} {{ Auth::user()->surname }}</h4>
                        <p class="text-md font-medium text-black">Correu: {{ Auth::user()->email }}</p>
                        <h4 class="text-md font-medium text-black">Entrades Seleccionades:</h4>
                        <ul id="selected-entrades-list" class="list-disc pl-5"></ul>
                        <p class="text-md font-medium text-black">Gastos de Gestió: <span id="gestio-cost">2.00</span>€</p>
                        <p class="text-md font-medium text-black">IVA: <span id="iva-cost">1.50</span>€</p>
                        <p class="text-md font-medium text-black">Recàrrecs: <span id="recarrec-cost">1.00</span>€</p>
                        <p class="text-md font-medium text-black">Preu Total: <span id="total-price"></span>€</p>
                    </div>
                    <br>
                    <button id="pay-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Pagar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectedEntrades = JSON.parse(localStorage.getItem('selectedEntrades')) || [];
            const selectedEntradesList = document.getElementById('selected-entrades-list');
            const totalPriceElement = document.getElementById('total-price');
            let total = 0;

            selectedEntrades.forEach(entrada => {
                const listItem = document.createElement('li');
                listItem.textContent = `${entrada.tipus_entrada} - Quantitat: ${entrada.quantitat} - Subtotal: ${entrada.subtotal}€`;
                selectedEntradesList.appendChild(listItem);
                total += entrada.subtotal;
            });

            const gestioCost = parseFloat(document.getElementById('gestio-cost').textContent);
            const ivaCost = parseFloat(document.getElementById('iva-cost').textContent);
            const recarrecCost = parseFloat(document.getElementById('recarrec-cost').textContent);
            total += gestioCost + ivaCost + recarrecCost;

            totalPriceElement.textContent = total.toFixed(2);
        });
    </script>
</x-app-layout>