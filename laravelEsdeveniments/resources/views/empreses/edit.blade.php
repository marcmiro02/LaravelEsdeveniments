<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Empresa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('empreses.update', $empresa->id_empresa) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nom_empresa" class="block text-sm font-medium text-gray-700">Nom Empresa</label>
                            <input type="text" id="nom_empresa" name="nom_empresa" value="{{ $empresa->nom_empresa }}" class="mt-1 block w-full text-black" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="nif" class="block text-sm font-medium text-gray-700">NIF</label>
                            <input type="text" id="nif" name="nif" value="{{ $empresa->nif }}" class="mt-1 block w-full text-black" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="compte_bancari" class="block text-sm font-medium text-gray-700">Compte Bancari</label>
                            <input type="text" id="compte_bancari" name="compte_bancari" value="{{ $empresa->compte_bancari }}" class="mt-1 block w-full text-black">
                        </div>
                        
                        <div class="mb-4">
                            <label for="adreca" class="block text-sm font-medium text-gray-700">Adreça</label>
                            <input type="text" id="adreca" name="adreca" value="{{ $empresa->adreca }}" class="mt-1 block w-full text-black" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="ciutat" class="block text-sm font-medium text-gray-700">Ciutat</label>
                            <input type="text" id="ciutat" name="ciutat" value="{{ $empresa->ciutat }}" class="mt-1 block w-full text-black" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="codi_postal" class="block text-sm font-medium text-gray-700">Codi Postal</label>
                            <input type="number" id="codi_postal" name="codi_postal" value="{{ $empresa->codi_postal }}" class="mt-1 block w-full text-black" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="telefon" class="block text-sm font-medium text-gray-700">Telèfon</label>
                            <input type="text" id="telefon" name="telefon" value="{{ $empresa->telefon }}" class="mt-1 block w-full text-black">
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" id="email" name="email" value="{{ $empresa->email }}" class="mt-1 block w-full text-black">
                        </div>
                        
                        <div class="mb-4">
                            <label for="web" class="block text-sm font-medium text-gray-700">Web</label>
                            <input type="text" id="web" name="web" value="{{ $empresa->web }}" class="mt-1 block w-full text-black">
                        </div>
                        
                        <div class="mb-4">
                            <label for="horari" class="block text-sm font-medium text-gray-700">Horari</label>
                            <input type="text" id="horari" name="horari" value="{{ $empresa->horari }}" class="mt-1 block w-full text-black">
                        </div>
                        
                        <div class="mb-4">
                            <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                            <input type="file" id="logo" name="logo" class="mt-1 block w-full text-black">
                        </div>

                        <div class="mb-4">
                            <label for="logo_capsalera" class="block text-sm font-medium text-gray-700">Logo Capsalera</label>
                            <input type="file" id="logo_capsalera" name="logo_capsalera" class="mt-1 block w-full text-black">
                        </div>

                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>