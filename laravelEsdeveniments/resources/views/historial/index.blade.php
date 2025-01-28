<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Historial de PDFs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-center text-lg font-semibold mb-4">LES TEVES ENTRADES</h3>
                    @if($pdfs->isEmpty())
                        <p class="text-center">No tienes PDFs guardados.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pdfs as $pdf)
                                <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                                    <iframe src="{{ route('pdf.show', $pdf->id_pdf) }}" class="w-full h-64 mb-4"></iframe>
                                    <div class="flex justify-between">
                                        <a href="{{ route('pdf.show', $pdf->id_pdf) }}" class="text-blue-500 hover:underline">Ver</a>
                                        <a href="{{ route('pdf.download', $pdf->id_pdf) }}" class="text-blue-500 hover:underline">Descargar</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>