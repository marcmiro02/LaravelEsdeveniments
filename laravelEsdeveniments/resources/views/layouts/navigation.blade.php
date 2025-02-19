<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img src="{{ asset('img/Logos/Fosc_sense_bg.png') }}" alt="" class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200">  
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                        {{ __('Welcome') }}
                    </x-nav-link>
                </div>

                <!-- Esdeveniments Dropdown -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" style="padding-top: 1.5rem;">
                                <div>{{ __('Esdeveniments') }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('esdeveniments.index')">
                                {{ __('Esdeveniments') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('entrades.index')">
                                {{ __('Entrades') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('categories.index')">
                                {{ __('Categories') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('tipus_esdeveniments.index')">
                                {{ __('Tipus Esdeveniments') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('qrs.index')">
                                {{ __('QR') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('codis_promocionals.index')">
                                {{ __('Codis Promocionals') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Sales Dropdown -->
                @can('isAdmin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" style="padding-top: 1.5rem;">
                                <div>{{ __('Sales') }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('sales.index')">
                                {{ __('Sales') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('seients.index')">
                                {{ __('Seients') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('tipus_seients.index')">
                                {{ __('Tipus Seients') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('estat_seients.index')">
                                {{ __('Estat Seients') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endcan
                @can('isSuperadmin')
                <!-- Usuaris Dropdown -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-dropdown align="left" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150" style="padding-top: 1.5rem;">
                                <div>{{ __('Usuaris') }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('users.index')">
                                {{ __('Users') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('empreses.index')">
                                {{ __('Empreses') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('rols_usuaris.index')">
                                {{ __('Rols Usuaris') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endcan

                <!-- Barra de Búsqueda -->
                <div class="flex-grow flex items-center justify-center relative">
                    <div class="relative w-full max-w-2xl">
                        <input type="text" id="search-input" placeholder="Buscar..." class="w-full px-6 py-2 rounded-lg border border-gray-600 bg-gray-800 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <svg class="absolute right-4 top-2.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1111.196 3.47l4.717 4.717a1 1 0 01-1.414 1.414l-4.717-4.717A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div id="search-results" class="absolute top-full mt-2 w-full max-w-2xl bg-white dark:bg-gray-800 rounded-lg shadow-lg z-50 hidden">
                        <ul id="results-list" class="divide-y divide-gray-200 dark:divide-gray-700"></ul>
                    </div>
                </div>
                
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const searchInput = document.getElementById('search-input');
                        const searchResults = document.getElementById('search-results');
                        const resultsList = document.getElementById('results-list');

                        searchInput.addEventListener('input', function () {
                            const query = searchInput.value;

                            if (query.length > 2) {
                                fetch(`/search?query=${query}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        resultsList.innerHTML = '';

                                        if (data.esdeveniments.length > 0 || data.empreses.length > 0) {
                                            data.esdeveniments.forEach(esdeveniment => {
                                                const li = document.createElement('li');
                                                li.classList.add('p-2', 'hover:bg-gray-100', 'dark:hover:bg-gray-700', 'flex', 'items-center');
                                                li.innerHTML = `
                                                    <img src="data:image/png;base64,${esdeveniment.foto_portada}" alt="${esdeveniment.nom}" class="h-10 w-10 rounded-full mr-3">
                                                    <div>
                                                        <a href="/esdeveniments/${esdeveniment.id_esdeveniment}" class="block text-gray-900 dark:text-gray-300">
                                                            ${esdeveniment.nom}
                                                            <span class="flex items-center text-sm text-green-600 dark:text-green-400">
                                                                <svg class="h-2 w-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Esdeveniment
                                                            </span>
                                                        </a>
                                                    </div>`;
                                                resultsList.appendChild(li);
                                            });

                                            data.empreses.forEach(empresa => {
                                                const li = document.createElement('li');
                                                li.classList.add('p-2', 'hover:bg-gray-100', 'dark:hover:bg-gray-700', 'flex', 'items-center');
                                                li.innerHTML = `
                                                    <img src="data:image/png;base64,${empresa.logo}" alt="${empresa.nom_empresa}" class="h-10 w-10 rounded-full mr-3">
                                                    <div>
                                                        <a href="/inici/${empresa.id_empresa}" class="block text-gray-900 dark:text-gray-300">
                                                            ${empresa.nom_empresa}
                                                            <span class="flex items-center text-sm text-red-600 dark:text-red-400">
                                                                <svg class="h-2 w-2 mr-1" fill="currentColor" viewBox="0 0 8 8">
                                                                    <circle cx="4" cy="4" r="3" />
                                                                </svg>
                                                                Empresa
                                                            </span>
                                                        </a>
                                                    </div>`;
                                                resultsList.appendChild(li);
                                            });

                                            searchResults.classList.remove('hidden');
                                        } else {
                                            searchResults.classList.add('hidden');
                                        }
                                    });
                            } else {
                                searchResults.classList.add('hidden');
                            }
                        });

                        document.addEventListener('click', function (event) {
                            if (!searchResults.contains(event.target) && event.target !== searchInput) {
                                searchResults.classList.add('hidden');
                            }
                        });
                    });
                </script>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('pdf.index')" :active="request()->routeIs('pdf.index')">
                        {{ __('TEST QR') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('pdf.indexValidar')" :active="request()->routeIs('pdf.indexValidar')">
                        {{ __('VALIDAR QR') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('historial.index')" :active="request()->routeIs('historial.index')">
                        {{ __('HISTORIAL') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @else
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ __('Account') }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('login')">
                            {{ __('Login') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')">
                            {{ __('Register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')">
                {{ __('welcome') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @else
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ __('Guest') }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                @else
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">
                    {{ __('Register') }}
                </x-responsive-nav-link>
                @endauth
            </div>
        </div>
    </div>
</nav>