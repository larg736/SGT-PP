<x-app-layout>
    @if (auth()->user()->id == $demand->clerk_id or auth()->user()->id == $demand->client_id && $demand->active) 
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <x-validation/>
        <form method="post" action="{{ route('demands.update', $demand->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-white">
                        @if (auth()->user()->id == $demand->clerk_id && $demand->active)
                            <p class="font-medium text-lg">Derivar Solicitud a otro nivel</p>
                            <p>...</p>
                        @else
                            <p class="mb-2 text-lg font-bold tracking-tight">Editar Tarea</p>
                            <figure class="max-w-lg p-4 h-80">
                                @if(isset($demand->url))
                                <img class="mx-auto flex items-center justify-center h-full rounded-lg" src="{{ Storage::url($demand->url) }}">
                                @else
                                <img class="mx-auto flex items-center justify-center h-full rounded-lg" id="preview">
                                @endif
                            </figure>
                        @endif
                    </div>

                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            @if (auth()->user()->id == $demand->clerk_id && $demand->active)
                            <div class="md:col-span-2">
                                <x-gray-label for="level_id" value="{{ __('Nivel') }}" />
                                <select name="level_id" id="level_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione nivel</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}" @if($demand->level_id == $level->id) selected @endif>{{ $level->name }}</option>
                                    @endforeach
                                </select>
                                <x-gray-input id="category_id" name="category_id" class="block mt-1 w-full" type="hidden" name="category_id" :value="$demand->category_id"/>
                                <x-gray-input id="title" name="title" class="block mt-1 w-full" type="hidden" name="title" :value="$demand->title" />
                                <x-gray-input id="severity" name="severity" class="block mt-1 w-full" type="hidden" name="severity" :value="$demand->severity" />
                                <x-gray-input id="description" name="description" class="block mt-1 w-full" type="hidden" name="description" :value="$demand->description" />
                            </div>
                            @endif

                            @if (auth()->user()->id == $demand->client_id && $demand->active)
                            <div class="md:col-span-5">
                                <x-gray-label for="title" value="{{ __('Titulo') }}" />
                                <x-gray-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$demand->title" minlength="5" maxlength="50" autofocus autocomplete="title" />
                                <x-input-error for="title" class="mt-2" />
                            </div>
            
                            <div class="md:col-span-5">
                                <x-gray-label for="description" value="{{ __('Descripcion') }}" />
                                <textarea name="description" id="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
								required minlength="10" maxlength="250">{{ $demand->description }}</textarea>
                                <x-input-error for="description" class="mt-2" />
                            </div>
            
                            <div class="md:col-span-2">
                                <x-gray-label for="category_id" value="{{ __('Categoria') }}" />
                                <select name="category_id" id="category_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione Categoria</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($demand->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md:col-span-1">
                                <x-gray-label for="severity" value="{{ __('Severidad') }}" />
                                <select name="severity" id="severity" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione...</option>
                                    <option value="M"  @if($demand->severity=='M') selected @endif>Menor</option>
                                    <option value="N"  @if($demand->severity=='N') selected @endif>Normal</option>
                                    <option value="A"  @if($demand->severity=='A') selected @endif>Alta</option>
                                </select>
                            </div>
            
                            <div class="md:col-span-2">
                                <x-gray-label for="created_at" value="{{ __('Fecha de creacion') }}" />
                                <x-gray-input disabled="true" id="created_at" class="block mt-1 w-full cursor-not-allowed" type="text" name="created_at" :value="$demand->created_at" required autofocus autocomplete="on" />
                            </div>
            
                            <div class="md:col-span-2">
                                <x-gray-label for="department_id" value="{{ __('Departamento') }}" />
                                <x-gray-input disabled="true" id="department_id" class="block mt-1 w-full cursor-not-allowed" type="text" name="department_id" :value="$demand->department->name" required autofocus autocomplete="on" />
                            </div>
                
                            <div class="md:col-span-1">
                                <x-gray-label for="clerk_name" value="{{ __('Asignado') }}" />
                                <x-gray-input disabled="true" id="clerk_name" class="block mt-1 w-full cursor-not-allowed" type="text" name="clerk_name" :value="$demand->clerk_name" required autofocus autocomplete="on" />
                            </div>
    
                            <div class="md:col-span-1">
                                <x-gray-label for="state" value="{{ __('Estado') }}" />
                                <x-gray-input disabled="true" id="state" class="block mt-1 w-full cursor-not-allowed" type="text" name="state" :value="$demand->state" required autofocus autocomplete="on" />
                            </div>

                            <div class="md:col-span-1">
                                <x-gray-label for="serial" value="{{ __('Serial') }}" />
                                <x-gray-input id="serial" class="block mt-1 w-full" type="text" name="serial" :value="$demand->serial" minlength="5" maxlength="20" autofocus autocomplete="on" />
                                <x-input-error for="serial" class="mt-2" />
                            </div>

                            <div class="md:col-span-3">
                                <x-gray-label for="photo" value="{{ __('Subir Imagen') }}" />
                                <x-gray-input id="photo" class="block mt-1 py-2.5 px-4 rounded-md w-full" type="file" :value="$demand->photo" name="photo" autofocus autocomplete="on"/>
                                <x-input-error for="photo" class="mt-2" />
                            </div>
                            @endif
                            
                            <div class="md:col-span-5 py-3 text-right">
                                <x-button>
                                    {{ __('Guardar Cambios') }}
                                </x-button>
                                <x-button-gray href="/home">
                                    Volver
                                </x-button-gray>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>    
    @else
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="mx-auto flex items-center justify-center">
                <svg class="h-16 w-16 text-yellow-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <circle cx="12" cy="12" r="10" />  <line x1="12" y1="8" x2="12" y2="12" />  <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-200" id="modal-headline">
                    Prohibido
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-200">
                        ¡Acceso no permitido! <a href="/home" class="font-medium text-white hover:underline dark:text-yellow-500">Volver</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif

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