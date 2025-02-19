<x-app-layout>
    <div class="min-h-screen bg-black flex justify-center items-center">
        <div class="max-w-7xl w-full bg-gray-900 dark:bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-8 text-gray-100 dark:text-gray-100">
            <!-- Línea de Progreso -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex-1">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3">
                        <div class="bg-rose-600 h-3 rounded-full" style="width: 100%;"></div>
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
                        <div class="w-14 h-14 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clapperboard text-2xl"></i>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Resum de la compra</span>
                    </div>
                    <div class="text-center">
                        <div class="w-14 h-14 bg-rose-600 text-white rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-clapperboard text-2xl"></i>
                        </div>
                        <span class="text-sm text-rose-600">Pagament Finalitzat</span>
                    </div>
                </div>
            </div>
            <!-- Título -->
            <h3 class="text-3xl font-bold text-center text-rose-600 mb-6">Pagament exitós!</h3>
            <!-- Contenido -->
            <div class="space-y-6">
                <hr class="border-gray-700">

                @if(session()->has('id_esdeveniment'))
                    <!-- Formulario de Generar Entrada -->
                    <div class="flex justify-center">
                        <form action="{{ route('pdf.generarEntrada') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id_esdeveniment" value="{{ session('id_esdeveniment') }}">
                            <button type="submit" class="bg-rose-600 hover:bg-rose-800 text-white font-bold py-2 px-4 rounded mt-3">
                                Generar Entrades
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Mensaje si ya se generó la entrada -->
                    <div class="text-center text-gray-500">
                        <p>Ya has generado tu entrada. No es posible generarla nuevamente.</p>
                    </div>
                @endif

                <!-- Botón Volver -->
                <div class="flex justify-center mt-8">
                    <a href="{{ route('welcome') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Volver al inicio
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
