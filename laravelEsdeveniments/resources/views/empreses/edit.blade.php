<x-app-layout>
    <!-- Fullscreen Black Background -->
    <div class="min-h-screen bg-black flex items-center justify-center">
        <!-- Centered Form Container -->
        <div class="bg-gray-900 p-8 rounded-lg shadow-lg max-w-7xl w-full sm:px-6 lg:px-8 text-gray-100">

            <h3 class="text-3xl font-bold text-rose-600 mb-6 text-center">Editar Detalls de l'Entrada</h3>

            <form action="{{ route('empreses.update', $empresa->id_empresa) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="mb-4">
                    <label for="nom_empresa" class="block text-lg font-medium text-gray-100">Nom Empresa</label>
                    <input type="text" id="nom_empresa" name="nom_empresa" value="{{ $empresa->nom_empresa }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="nif" class="block text-lg font-medium text-gray-100">NIF</label>
                    <input type="text" id="nif" name="nif" value="{{ $empresa->nif }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="compte_bancari" class="block text-lg font-medium text-gray-100">Compte Bancari</label>
                    <input type="text" id="compte_bancari" name="compte_bancari" value="{{ $empresa->compte_bancari }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="adreca" class="block text-lg font-medium text-gray-100">Adreça</label>
                    <input type="text" id="adreca" name="adreca" value="{{ $empresa->adreca }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="ciutat" class="block text-lg font-medium text-gray-100">Ciutat</label>
                    <input type="text" id="ciutat" name="ciutat" value="{{ $empresa->ciutat }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="codi_postal" class="block text-lg font-medium text-gray-100">Codi Postal</label>
                    <input type="number" id="codi_postal" name="codi_postal" value="{{ $empresa->codi_postal }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white" 
                           required>
                </div>
                
                <div class="mb-4">
                    <label for="telefon" class="block text-lg font-medium text-gray-100">Telèfon</label>
                    <input type="text" id="telefon" name="telefon" value="{{ $empresa->telefon }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="email" class="block text-lg font-medium text-gray-100">Email</label>
                    <input type="email" id="email" name="email" value="{{ $empresa->email }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="web" class="block text-lg font-medium text-gray-100">Web</label>
                    <input type="text" id="web" name="web" value="{{ $empresa->web }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="horari" class="block text-lg font-medium text-gray-100">Horari</label>
                    <input type="text" id="horari" name="horari" value="{{ $empresa->horari }}" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>
                
                <div class="mb-4">
                    <label for="logo" class="block text-lg font-medium text-gray-100">Logo</label>
                    <input type="file" id="logo" name="logo" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <div class="mb-4">
                    <label for="logo_capsalera" class="block text-lg font-medium text-gray-100">Logo Capsalera</label>
                    <input type="file" id="logo_capsalera" name="logo_capsalera" 
                           class="mt-2 block w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:outline-none focus:border-rose-600 text-white">
                </div>

                <button type="submit" class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded-lg transition-colors duration-300">Actualitzar</button>
            </form>
        </div>
    </div>
</x-app-layout>