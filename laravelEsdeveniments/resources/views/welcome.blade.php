<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-3xl font-bold mb-4">Benvingut a DAM</h1>
                    <p class="mb-4">Descobreix les últimes pel·lícules i esdeveniments a la teva sala de cinema preferida.</p>
                    <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compra Entrades</a>
                </div>
            </div>

            <!-- Slider Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Pel·lícules Més Noves</h2>
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach($esdeveniments->sortByDesc('created_at')->take(6) as $esdeveniment)
                                <div class="swiper-slide">
                                    <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg">
                                        <div class="w-full h-64 overflow-hidden rounded-lg mb-4">
                                        <img src="data:image/png;base64,{{$esdeveniment->foto_fons ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-full object-cover">
                                        </div>
                                        <h3 class="text-2xl font-bold mb-2">{{ $esdeveniment->nom }}</h3>
                                        <p class="mb-4">{{ $esdeveniment->sinopsis }}</p>
                                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compra Entrades</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- Add Navigation -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>

            <!-- Movies Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Pel·lícules en Cartellera</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <!-- Movie Card -->
                        @foreach($esdeveniments as $esdeveniment)
                            <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg">
                                <div class="w-full h-64 overflow-hidden rounded-lg mb-4">
                                <img src="data:image/png;base64,{{ $esdeveniment->foto_portada ?? '' }}" alt="{{ $esdeveniment->nom }}" class="w-full h-full object-cover">
                                </div>
                                <h3 class="text-2xl font-bold mb-2">{{ $esdeveniment->nom }}</h3>
                                <p class="mb-4">{{ $esdeveniment->sinopsis }}</p>
                                <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Compra Entrades</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Events Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-2xl font-bold mb-4">Esdeveniments Especials</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <!-- Event Card -->
                        <div class="bg-gray-200 dark:bg-gray-700 p-6 rounded-lg">
                            <div class="w-full h-64 overflow-hidden rounded-lg mb-4">
                                <img src="{{ asset('img/events/event1.jpg') }}" alt="Event 1" class="w-full h-full object-cover">
                            </div>
                            <h3 class="text-2xl font-bold mb-2">Títol de l'Esdeveniment 1</h3>
                            <p class="mb-4">Descripció breu de l'esdeveniment.</p>
                            <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Més Informació</a>
                        </div>
                        <!-- Repeat Event Card for other events -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Swiper JS Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 10,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000, // Cambia cada 5 segundos
                    disableOnInteraction: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 2,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>
</x-app-layout>

