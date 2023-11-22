<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="text-white">
                    <p class="mb-2 text-lg font-bold tracking-tight text-white">Detalles de la Tarea</p>
                    <p>...</p>
                    <figure class="max-w-lg p-4 h-80">
                    @if(isset($demand->url))
                        <img class="mx-auto flex items-center justify-center h-full rounded-lg" src="{{ Storage::url($demand->url) }}">
                    @endif
                    </figure>
                </div>
                <div class="lg:col-span-2">
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    
                        <div class="md:col-span-5">
                            <x-gray-label for="title" value="{{ __('Titulo') }}" />
                            <x-gray-input disabled="true" id="title" class="block mt-1 w-full" type="text" name="title" :value="$demand->title" required autofocus autocomplete="on" />
                        </div>
        
                        <div class="md:col-span-5">
                            <x-gray-label for="description" value="{{ __('Descripcion') }}" />
                            <textarea disabled="true" id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                            required minlength="10" maxlength="250">{{ $demand->description }}</textarea>
                        </div>
        
                        <div class="md:col-span-2">
                            <x-gray-label for="category_id" value="{{ __('Categoria') }}" />
                            @if (isset($demand->category->name))
                            <x-gray-input disabled="true" id="category_id" class="block mt-1 w-full" type="text" name="" :value="$demand->category->name" autofocus autocomplete="on" />
                            @else
                            <x-gray-input disabled="true" id="category_id" class="block mt-1 w-full" type="text" name="" value="No Disponible" autofocus autocomplete="on" />
                            @endif
                        </div>
        
                        <div class="md:col-span-2">
                            <x-gray-label for="level_id" value="{{ __('Nivel') }}" />
                            @if (isset($demand->level->name))
                            <x-gray-input disabled="true" id="level_id" class="block mt-1 w-full" type="text" name="" :value="$demand->level->name" required autofocus autocomplete="on" />
                            @else
                            <x-gray-input disabled="true" id="level_id" class="block mt-1 w-full" type="text" name="" value="No Disponible" autofocus autocomplete="on" />
                            @endif
                        </div>
    
                        <div class="md:col-span-1">
                            <x-gray-label for="severity" value="{{ __('Severidad') }}" />
                            <x-gray-input disabled="true" id="severity" class="block mt-1 w-full" type="text" name="" :value="$demand->severity_full" required autofocus autocomplete="on" />
                        </div>
        
                        <div class="md:col-span-2">
                            <x-gray-label for="created_at" value="{{ __('Fecha de creacion') }}" />
                            <x-gray-input disabled="true" id="created_at" class="block mt-1 w-full" type="text" name="" :value="$demand->created_at" required autofocus autocomplete="on" />
                        </div>
        
                        <div class="md:col-span-2">
                            <x-gray-label for="department_id" value="{{ __('Departamento') }}" />
                            @if (isset($demand->department->name))
                            <x-gray-input disabled="true" id="department_id" class="block mt-1 w-full" type="text" name="" :value="$demand->department->name" required autofocus autocomplete="on" />
                            @else
                            <x-gray-input disabled="true" id="department_id" class="block mt-1 w-full" type="text" name="" value="No Disponible" autofocus autocomplete="on" />
                            @endif
                        </div>
            
                        <div class="md:col-span-1">
                            <x-gray-label for="clerk_name" value="{{ __('Asignado') }}" />
                            <x-gray-input disabled="true" id="clerk_name" class="block mt-1 w-full" type="text" name="" :value="$demand->clerk_name" required autofocus autocomplete="on" />
                        </div>
    
                        <div class="md:col-span-1">
                            <x-gray-label for="state" value="{{ __('Estado') }}" />
                            <x-gray-input disabled="true" id="state" class="block mt-1 w-full" type="text" name="" :value="$demand->state" required autofocus autocomplete="on" />
                        </div>
                        @if(isset($demand->serial))
                        <div class="md:col-span-1">
                            <x-gray-label for="serial" value="{{ __('Serial') }}" />
                            <x-gray-input disabled="true" id="serial" class="block mt-1 w-full" type="text" name="" :value="$demand->serial" required autofocus autocomplete="on" />
                        </div>
                        @endif
                    
                        <div class="md:col-span-5 py-3 text-right">
                            <x-button-gray href="/demands">
                                Volver
                            </x-button-gray>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>