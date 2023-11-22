<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <x-validation />
            <form method="POST" action="{{ route('demands.store') }}" id="registerForm" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-100">
                        <p class="mb-2 text-lg font-bold tracking-tight">Nuevo Tarea</p>
                        <figure class="max-w-lg p-4 h-80">
                            <img class="mx-auto flex items-center justify-center h-full rounded-lg" id="preview">
                        </figure>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-5">
                                <x-gray-label for="title" value="{{ __('Titulo') }}" />
                                <x-gray-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')" minlength="5" maxlength="50" autofocus autocomplete="on" />
                                <x-input-error for="title" class="mt-2" />
                            </div>
            
                            <div class="md:col-span-5">
                                <x-gray-label for="description" value="{{ __('Descripcion') }}" />
                                <textarea name="description" id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                minlength="10" maxlength="250">{{old('description')}}</textarea>
                                <x-input-error for="description" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-gray-label for="category_id" value="{{ __('Categoria') }}" />
                                <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione Categoria</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="category_id" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-gray-label for="level_id" value="{{ __('Nivel') }}" />
                                <select name="level_id" id="level_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
									<option value="">Seleccione Nivel</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
									@endforeach
                                </select>
                                <x-input-error for="level_id" class="mt-2" />
                            </div>

                            <div class="md:col-span-1">
                                <x-gray-label for="severity" value="{{ __('Severidad') }}" />
                                <select name="severity" id="severity" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M" {{ old('severity') == "M" ? 'selected' : '' }}>Menor</option>
                                    <option value="N" {{ old('severity') == "N" ? 'selected' : '' }}>Normal</option>
                                    <option value="A" {{ old('severity') == "A" ? 'selected' : '' }}>Alta</option>
                                </select>
                                <x-input-error for="severity" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-gray-label for="serial" value="{{ __('Serial') }}" />
                                <x-gray-input id="serial" class="block mt-1 w-full" type="text" name="serial" :value="old('serial')" minlength="5" maxlength="20" autofocus autocomplete="on" />
                                <x-input-error for="serial" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <x-gray-label for="photo" value="{{ __('Subir Imagen') }}" />
                                <x-gray-input id="photo" class="block mt-1 py-2.5 px-4 rounded-md w-full" :value="old('photo')" type="file" name="photo" />
                                <x-input-error for="photo" class="mt-2" />
                            </div>

                            <div class="md:col-span-5 py-3 text-right">
                                <x-button>
                                    {{ __('Guardar') }}
                                </x-button>
                                <x-button-gray href="/home">
                                    Volver
                                </x-button-gray>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            let preview = document.getElementById('preview');
            let file    = e.target.files[0];
            let reader = new FileReader();
    
            reader.onloadend = function () {
                preview.src = reader.result;
            }
    
            if (file) {
                reader.readAsDataURL(file);
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
</x-app-layout>