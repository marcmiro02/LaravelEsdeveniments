<x-app-layout>
    <div class="min-h-screen bg-black flex justify-center items-center">
        <div
            class="max-w-7xl w-full bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-8 text-gray-100 dark:text-gray-100">
            <!-- Línea de Progreso -->
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
                        <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clapperboard text-2xl"></i>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Triar Entrada</span>
                    </div>
                    <div class="text-center">
                        <div class="w-14 h-14 bg-rose-600 text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clapperboard text-2xl"></i>
                        </div>
                        <span class="text-sm text-rose-600">Resum de la compra</span>
                    </div>
                    <div class="text-center">
                        <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clapperboard text-2xl"></i>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Pagament</span>
                    </div>
                </div>
            </div>
            <!-- Título -->
            <h3 class="text-3xl font-bold text-center text-rose-600 mb-6">Resum de la Comanda</h3>
            <!-- Contenido -->
            <div id="order-summary" class="space-y-6">
                <!-- Información del usuario -->
                <div class="flex flex-col md:flex-row justify-between items-center bg-gray-800 rounded-lg p-4">
                    <div class="w-full md:w-1/2">
                        <h4 class="text-lg font-medium text-rose-600">Nom:</h4>
                        <p class="text-lg">{{ Auth::user()->name }} {{ Auth::user()->surname }}</p>
                    </div>
                    <div class="w-full md:w-1/2 mt-4 md:mt-0">
                        <h4 class="text-lg font-medium text-rose-600">Correu:</h4>
                        <p class="text-lg">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <!-- Entradas seleccionadas -->
                <div class="bg-gray-800 rounded-lg p-4">
                    <h4 class="text-lg font-medium text-rose-600 mb-4">Entrades Seleccionades:</h4>
                    <ul id="selected-entrades-list" class="list-disc pl-5 text-lg space-y-2">
                        <!-- Las entradas se cargarán dinámicamente -->
                    </ul>
                </div>
                <!-- Detalles de costes -->
                <div class="bg-gray-800 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-medium text-rose-600">Entrades Total:</p>
                        <p class="text-lg"><span id="total-entrades"></span>€</p>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-medium text-rose-600">Gastos de Gestió:</p>
                        <p class="text-lg"><span id="gestio-cost"></span>€</p>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-medium text-rose-600">IVA (21%):</p>
                        <p class="text-lg"><span id="iva-cost"></span>€</p>
                    </div>
                    <div class="flex justify-between items-center mb-4">
                        <p class="text-lg font-medium text-rose-600">Recàrrecs:</p>
                        <p class="text-lg"><span id="recarrec-cost"></span>€</p>
                    </div>
                    <div class="flex justify-between items-center border-t border-gray-700 pt-4">
                        <p class="text-xl font-bold text-rose-600">Preu Total:</p>
                        <p class="text-xl font-bold"><span id="total-price"></span>€</p>
                    </div>
                </div>
                <!-- Botón de pago -->
                <form id="payment-form" action="{{ route('tickets.processPayment') }}" method="POST" class="mt-6">
                    @csrf
                    <input type="hidden" name="selectedEntrades" id="selected-entrades-input">
                    <div class="flex justify-center">
                        <button type="submit" id="pay-button"
                            class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105">
                            Pagar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectedEntrades = JSON.parse(localStorage.getItem('selectedEntrades')) || [];
            const selectedEntradesList = document.getElementById('selected-entrades-list');
            const totalPriceElement = document.getElementById('total-price');
            const totalEntradesElement = document.getElementById('total-entrades'); // Nuevo elemento para el subtotal de entradas
            const selectedEntradesInput = document.getElementById('selected-entrades-input');
            const gestioCostElement = document.getElementById('gestio-cost');
            const ivaCostElement = document.getElementById('iva-cost');
            const recarrecCostElement = document.getElementById('recarrec-cost');

            let total = 0;
            // Cargar las entradas seleccionadas
            if (selectedEntrades.length > 0) {
                selectedEntrades.forEach(entrada => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${entrada.tipus_entrada} - Quantitat: ${entrada.quantitat} - Subtotal: ${entrada.subtotal.toFixed(2)}€`;
                    selectedEntradesList.appendChild(listItem);
                    total += entrada.subtotal;
                });
            } else {
                const noItemsMessage = document.createElement('p');
                noItemsMessage.textContent = 'No has seleccionat cap entrada.';
                noItemsMessage.style.color = 'red';
                selectedEntradesList.appendChild(noItemsMessage);
            }

            // Mostrar el subtotal de entradas
            totalEntradesElement.textContent = total.toFixed(2);

            // Calcular costes adicionales
            const gestioCost = total * 0.05; // Gastos de gestió (5% del total)
            const ivaCost = total * 0.21; // IVA (21% del total)
            const recarrecCost = total * 0.02; // Recàrrecs (2% del total)

            // Actualizar valores en pantalla
            gestioCostElement.textContent = gestioCost.toFixed(2);
            ivaCostElement.textContent = ivaCost.toFixed(2);
            recarrecCostElement.textContent = recarrecCost.toFixed(2);

            // Calcular precio total
            const finalTotal = total + gestioCost + ivaCost + recarrecCost;
            totalPriceElement.textContent = finalTotal.toFixed(2);

            // Pasar las entradas seleccionadas al formulario
            selectedEntradesInput.value = JSON.stringify(selectedEntrades);
        });
    </script>
</x-app-layout>