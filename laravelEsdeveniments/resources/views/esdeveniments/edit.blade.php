<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Esdeveniment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('esdeveniments.update', $esdeveniment->id_esdeveniment) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                            <input type="text" id="nom" name="nom" value="{{ $esdeveniment->nom }}" class="mt-1 block w-full text-black" required>
                        </div>
                        <div class="mb-4">
                            <label for="foto_portada" class="block text-sm font-medium text-gray-700">Foto Portada</label>
                            <input type="file" id="foto_portada" name="foto_portada" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="foto_fons" class="block text-sm font-medium text-gray-700">Foto Fons</label>
                            <input type="file" id="foto_fons" name="foto_fons" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="duracio" class="block text-sm font-medium text-gray-700">Duració</label>
                            <input type="text" id="duracio" name="duracio" value="{{ $esdeveniment->duracio }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="sinopsis" class="block text-sm font-medium text-gray-700">Sinopsis</label>
                            <textarea id="sinopsis" name="sinopsis" class="mt-1 block w-full text-black">{{ $esdeveniment->sinopsis }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="trailer" class="block text-sm font-medium text-gray-700">Tràiler (Enllaç de YouTube)</label>
                            <input type="url" id="trailer" name="trailer" class="mt-1 block w-full text-black" value="{{ $esdeveniment->trailer }}">
                        </div>
                        <div class="mb-4">
                            <label for="director" class="block text-sm font-medium text-gray-700">Director</label>
                            <input type="text" id="director" name="director" value="{{ $esdeveniment->director }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="actors" class="block text-sm font-medium text-gray-700">Actors</label>
                            <textarea id="actors" name="actors" class="mt-1 block w-full text-black">{{ $esdeveniment->actors }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="data_estrena" class="block text-sm font-medium text-gray-700">Data Estrena</label>
                            <input type="date" id="data_estrena" name="data_estrena" value="{{ $esdeveniment->data_estrena }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="edats" class="block text-sm font-medium text-gray-700">Edats</label>
                            <select id="edats" name="edats" class="mt-1 block w-full text-black">
                                <option value="TD" {{ $esdeveniment->edats == 'TD' ? 'selected' : '' }}>TD</option>
                                <option value="+7" {{ $esdeveniment->edats == '+7' ? 'selected' : '' }}>+7</option>
                                <option value="+12" {{ $esdeveniment->edats == '+12' ? 'selected' : '' }}>+12</option>
                                <option value="+16" {{ $esdeveniment->edats == '+16' ? 'selected' : '' }}>+16</option>
                                <option value="+18" {{ $esdeveniment->edats == '+18' ? 'selected' : '' }}>+18</option>
                                <option value="XXX" {{ $esdeveniment->edats == 'XXX' ? 'selected' : '' }}>XXX</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="id_tipus" class="block text-sm font-medium text-gray-700">Tipus</label>
                            <input type="number" id="id_tipus" name="id_tipus" value="{{ $esdeveniment->id_tipus }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="id_categoria" class="block text-sm font-medium text-gray-700">Categoria</label>
                            <input type="number" id="id_categoria" name="id_categoria" value="{{ $esdeveniment->id_categoria }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="id_sala" class="block text-sm font-medium text-gray-700">Sala</label>
                            <input type="number" id="id_sala" name="id_sala" value="{{ $esdeveniment->id_sala }}" class="mt-1 block w-full text-black">
                        </div>
                        <div class="mb-4">
                            <label for="id_empresa" class="block text-sm font-medium text-gray-700">Empresa</label>
                            <input type="number" id="id_empresa" name="id_empresa" value="{{ $esdeveniment->id_empresa }}" class="mt-1 block w-full text-black">
                        </div>

                        <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Actualitzar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>