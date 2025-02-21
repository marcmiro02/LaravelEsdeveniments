<x-app-layout>
    <div class="min-h-screen bg-black flex flex-col items-center py-10">
        <!-- Sección de Entrades Vigents -->
        <div class="max-w-7xl w-full bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-6">
            <h3 class="text-center text-4xl font-bold mb-8 text-green-500">ENTRADES VIGENTS</h3>

            @if ($pdfsVigents->isEmpty())
                <p class="text-center text-lg text-gray-500">No tens entrades vigents</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pdfsVigents as $pdf)
                        <div class="relative bg-gray-800 p-4 rounded-lg shadow-2xl transition-transform hover:scale-105">
                            <div class="w-full aspect-[9/16] md:aspect-[16/9] overflow-hidden rounded-md">
                                <iframe src="{{ route('pdf.show', $pdf->id_pdf) }}" class="w-full h-full"></iframe>
                            </div>
                            <div class="flex flex-col md:flex-row justify-between mt-4 space-y-2 md:space-y-0 md:space-x-2">
                                <a href="{{ route('pdf.show', $pdf->id_pdf) }}" class="bg-purple-600 hover:bg-purple-800 px-4 py-2 rounded-lg text-white text-center transition-colors duration-200">Veure</a>
                                <a href="{{ route('pdf.download', $pdf->id_pdf) }}" class="bg-rose-600 hover:bg-rose-800 px-4 py-2 rounded-lg text-white text-center transition-colors duration-200">Descarregar</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Sección de Entrades Expirades -->
        <div class="max-w-7xl w-full bg-gray-900 overflow-hidden shadow-2xl sm:rounded-lg p-6 mt-10">
            <h3 class="text-center text-4xl font-bold mb-8 text-rose-600">ENTRADES EXPIRADES</h3>

            @if ($pdfsExpirats->isEmpty())
                <p class="text-center text-lg text-gray-500">No tens entrades expirades</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($pdfsExpirats as $pdf)
                        <div class="relative bg-gray-700 p-4 rounded-lg shadow-2xl transition-transform hover:scale-105 opacity-70">
                            <div class="w-full aspect-[9/16] md:aspect-[16/9] overflow-hidden rounded-md">
                                <iframe src="{{ route('pdf.show', $pdf->id_pdf) }}" class="w-full h-full"></iframe>
                            </div>
                            <div class="flex flex-col md:flex-row justify-between mt-4 space-y-2 md:space-y-0 md:space-x-2">
                                <a href="{{ route('pdf.show', $pdf->id_pdf) }}" class="bg-gray-500 hover:bg-gray-700 px-4 py-2 rounded-lg text-white text-center transition-colors duration-200">Veure</a>
                                <a href="{{ route('pdf.download', $pdf->id_pdf) }}" class="bg-gray-500 hover:bg-gray-700 px-4 py-2 rounded-lg text-white text-center transition-colors duration-200">Descarregar</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
