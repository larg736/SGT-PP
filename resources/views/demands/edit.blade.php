<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="post" action="{{ route('demands.update', $demand->id) }}">
            @csrf
            @method('put')
            <div class="bg-gray-400 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Editar Solicitud</p>
                        <p>Solo puede cambiar los campos donde la etiqueta esta de color Azul...</p>
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    
                            <div class="md:col-span-5">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-700">Título</label>
                                <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('title', $demand->title) }}" />
                            </div>
            
                            <div class="md:col-span-5">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-700">Descripción</label>
                                <textarea name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                >{{ old('description', $demand->description) }}</textarea>
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-700">Categoría</label>
                                <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="">Seleccione Categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($demand->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="level_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Nivel</label>
                                <input disabled="" type="text" name="level_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                value="{{ old('level_id', $demand->level->name) }}" />
                            </div>
    
                            <div class="md:col-span-1">
                                <label for="severity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-700">Severidad</label>
                                <select name="severity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M"  @if($demand->severity=='M') selected @endif>Menor</option>
                                    <option value="N"  @if($demand->severity=='N') selected @endif>Normal</option>
                                    <option value="A"  @if($demand->severity=='A') selected @endif>Alta</option>
                                </select>
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Fecha de creacion</label>
                                <input disabled="" type="text" name="created_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                value="{{ old('created_at', $demand->created_at) }}" />
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Departamento</label>
                                <input disabled="" type="text" name="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                value="{{ old('department_id', $demand->department->name) }}" />
                            </div>
                
                            <div class="md:col-span-1">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Asignado</label>
                                <input disabled="" type="text" name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                value="{{ old('clerk_id', $demand->clerk_name) }}" />
                            </div>
    
                            <div class="md:col-span-1">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-600">Estado</label>
                                <input disabled="" type="text" name="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white cursor-not-allowed"
                                value="{{ old('', $demand->state) }}" />
                            </div>
                        
                            <div class="md:col-span-5 py-3 text-right">
                                <button class="px-6 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-cyan-100 bg-cyan-500 hover:bg-cyan-600 shadow-cyan-400/30">
                                    Guardar Cambios
                                </button>
                                <a href="/home" class="px-6 py-2.5 text-sm transition-colors duration-300 rounded rounded-full shadow-xl bg-slate-500 hover:bg-slate-600 text-slate-100 shadow-slate-400/30">
                                    Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>