<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Table Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <!-- Title and Actions -->
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-bold text-rose-600">{{ __("Llistat de QR Codes") }}</h3>
                <a href="{{ route('qrs.create') }}"
                    class="flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">
                    <span class="mr-2">➕</span> Afegir QR
                </a>
            </div>

            <!-- Table -->
            @if ($qrs->isEmpty())
                <p class="text-center text-lg text-gray-400">No s'han trobat qrs.</p>
            @else
                <table class="table-auto w-full text-left">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="px-4 py-2 text-lg font-medium">Codi QR</th>
                            <th class="px-4 py-2 text-lg font-medium">Data Generació</th>
                            <th class="px-4 py-2 text-lg font-medium">Data Expiració</th>
                            <th class="px-4 py-2 text-lg font-medium">Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($qrs as $qr)
                            <tr class="border-b border-gray-700">
                                <td class="px-4 py-2">{{ $qr->codi_qr }}</td>
                                <td class="px-4 py-2">{{ $qr->data_generacio }}</td>
                                <td class="px-4 py-2">{{ $qr->data_expiracio }}</td>
                                <td class="px-4 py-2 flex space-x-2">
                                    <!-- Ver QR -->
                                    <a href="{{ route('qrs.show', ['qr' => $qr->id_qr]) }}"
                                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition-colors">Veure</a>

                                    <!-- Editar QR -->
                                    <a href="{{ route('qrs.edit', ['qr' => $qr->id_qr]) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition-colors">Editar</a>

                                    <!-- Eliminar QR -->
                                    <form action="{{ route('qrs.destroy', ['qr' => $qr->id_qr]) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition-colors">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif          </div>
    </div>
</x-app-layout>