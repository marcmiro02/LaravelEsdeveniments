<x-app-layout>
    <div class="py-12 bg-black dark:bg-black">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="relative bg-gradient-to-r from-black to-gray-900 overflow-hidden shadow-2xl sm:rounded-lg mb-8" style="height: 600px;">
                <img src="{{ asset('img/Banners/OSCURIDAD.png') }}" alt="Banner" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute bottom-0 left-0 p-8 text-white bg-black bg-opacity-10">
                    <h1 class="text-5xl font-bold mb-4">DAM EVENT PLANNER</h1>
                    <p class="text-xl mb-4">Descobreix els millors esdeveniments i empreses organitzadores</p>
                </div>
            </div>

            <!-- Empresas Section -->
            <div class="bg-black dark:bg-black overflow-hidden shadow-2xl sm:rounded-lg mb-8">
                <div class="p-8 text-gray-100 dark:text-gray-100">
                    <h2 class="text-4xl font-bold mb-8 text-center text-rose-600">LLISTAT D'EMPRESES</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        @foreach($empreses as $empresa)
                            <div class="relative bg-gray-900 dark:bg-gray-900 p-6 rounded-lg shadow-2xl h-96 overflow-hidden">
                                @if($empresa->logo)
                                    <img src="data:image/png;base64,{{ $empresa->logo }}" alt="{{ $empresa->nom_empresa }}" class="absolute inset-0 w-full h-full object-cover brightness-110">
                                @else
                                    <img src="https://via.placeholder.com/300x200" alt="{{ $empresa->nom_empresa }}" class="absolute inset-0 w-full h-full object-cover brightness-110">
                                @endif
                                <div class="absolute inset-0 p-6 flex flex-col justify-end text-white bg-black bg-opacity-50">
                                    <h3 class="text-2xl font-bold mb-2 text-rose-600">{{ $empresa->nom_empresa }}</h3>
                                    <p class="mb-4 text-lg">{{ $empresa->ciutat }}</p>
                                    <a href="{{ route('inici', ['id_empresa' => $empresa->id_empresa]) }}" class="bg-rose-600 hover:bg-rose-800 px-4 py-2 rounded-lg text-white inline-block transition-colors duration-200 self-start">Som-hi</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>