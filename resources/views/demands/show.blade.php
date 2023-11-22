<x-app-layout>
    @if (auth()->user()->id == $demand->client_id or $demand->clerk_id == null && $demand->active && auth()->user()->canTake($demand) or auth()->user()->id == $demand->clerk_id && $demand->active && auth()->user()->canTake($demand))
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                <div class="lg:col-span-2">
                    <p class="mb-2 text-lg font-bold tracking-tight text-white">Detalles de la Tarea</p>
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

                        @if(isset($imagePath))
                        <div class="md:col-span-1">
                            <x-button-gray onclick="openImage()" class="block mt-6" title="Ver Imagen">
                                <svg class="h-6 w-6 text-white"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />  <circle cx="8.5" cy="8.5" r="1.5" />  
                                    <polyline points="21 15 16 10 5 21" />
                                </svg>
                            </x-button-gray>
                        </div>
                        @endif
                    
                        <div class="md:col-span-5 py-3 text-right">
                            @if ($demand->clerk_id == null && $demand->active && auth()->user()->canTake($demand))
                                <x-button-cyan href="/demands/{{$demand->id}}/take">Atender</x-button-cyan>
                            @endif
                            @if (auth()->user()->id == $demand->client_id)
                                @if ($demand->active)
                                    <x-button-green href="/demands/{{$demand->id}}/solve">Resuelto</x-button-green>
                                    <x-button-orange href="{{route('demands.edit', $demand->id)}}">Editar</x-button-orange>
                                @else
                                    <form class="inline-block formulario-eliminar" action="{{route('demands.destroy', $demand->id)}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <x-button-danger>Borrar</x-button-danger>
                                    </form>
                                    <x-button-cyan href="/demands/{{$demand->id}}/open">Volver a abrir</x-button-cyan>
                                @endif
                            @endif
                            @if (auth()->user()->id == $demand->clerk_id && $demand->active)
                                <x-button-blue href="{{route('demands.edit', $demand->id)}}">Derivar a otro nivel</x-button-blue>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-white"> 
                    <p class="mb-2 text-lg font-bold tracking-tight">Comentarios</p>
                    @if ($demand->state == 'Asignado')
                    <livewire:chat :demand="$demand->id"/>
                    @else
                    <div class="border border-gray-700 shadow-md rounded-lg max-w-lg w-full p-4 h-96">
                        <div class="mx-auto flex items-center justify-center h-full">  
                            <div class="mx-auto text-center">                               
                                <h3 class="mt-4 text-lg leading-6 font-medium text-gray-200" id="modal-headline">
                                    Prohibido
                                </h3>
                                <p class="mt-2 text-sm text-gray-200">
                                    ¡Acceso no permitido!
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @else

    {{-- Alerta --}}
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
        function openImage() {
            var imgUrl = '{{ Storage::url($imagePath) }}'; // Reemplaza esto con la URL de tu imagen
            window.open(imgUrl, '_blank');
        }
    </script>
</x-app-layout>