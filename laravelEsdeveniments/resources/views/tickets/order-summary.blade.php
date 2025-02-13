<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h1 class="text-3xl font-bold text-center text-rose-600 mb-4">
                        {{ strtoupper(optional($esdeveniment)->nom ?? 'Esdeveniment no trobat') }}
                    </h1>

                    <!-- Línea de progreso (igual que antes) -->
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

                    <!-- Resumen de Entradas -->
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
                                @foreach($selectedEntrades as $entrada)
                                    <tr>
                                        <td class="border px-4 py-2">{{ $entrada['tipus_entrada'] }}</td>
                                        <td class="border px-4 py-2">{{ $entrada['descompte'] }}%</td>
                                        <td class="border px-4 py-2">{{ $entrada['quantitat'] }}</td>
                                        <td class="border px-4 py-2 entrada-subtotal">{{ number_format($entrada['subtotal'], 2) }}€</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-between mt-4">
                            <h4 class="text-md font-medium text-rose-600">Entrades Seleccionades: <span id="selected-entrades-count">{{ count($selectedEntrades) }} / {{ count($selectedEntrades) }}</span></h4>
                            <button id="pay-button" class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-2 px-4 rounded mt-2" disabled>Pagar</button>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const payButton = document.getElementById('pay-button');
                            const selectedEntradesCount = document.getElementById('selected-entrades-count');
                            let totalEntrades = 0;

                            // Calcular el total de las entradas
                            document.querySelectorAll('.entrada-subtotal').forEach(function(subtotalElement) {
                                totalEntrades += parseFloat(subtotalElement.textContent.replace('€', ''));
                            });

                            selectedEntradesCount.textContent = `${totalEntrades.toFixed(2)}€`;

                            // Habilitar el botón de pago si el total es mayor a 0
                            payButton.disabled = totalEntrades <= 0;
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
