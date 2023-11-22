<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <x-validation />
        <div class="bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div>
                <!-- Formulario Editar Departamento -->
                <form method="post" action="{{ route('departments.update', $department->id) }}">
                    @csrf
                    @method('put')
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    
                        <div class="text-white">
                            <p class="font-medium text-lg">Editar Departamento</p>
                            <p>.....</p>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-5">
                                    <x-gray-label for="name" value="{{ __('Name') }}" />
                                    <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$department->name" minlength="3" maxlength="50" autofocus autocomplete="name" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                
                                <div class="md:col-span-5">
                                    <x-gray-label for="description" value="{{ __('Description') }}" />
                                    <textarea id="description" name="description" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    minlength="10" maxlength="250">{{ $department->description }}</textarea>
                                    <x-input-error for="description" class="mt-2" />
                                </div>
    
                                <div class="md:col-span-5 py-3 text-right">
                                    <x-button>
                                        {{ __('Guardar Cambios') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"></div>
            </div>
    
            
            <!-- Registro Categoria -->
            <div class="">
                <div class="relative overflow-x-auto">
                    <!-- Formulario Categoria -->
                    <form method="post" action="{{ route('categories.store') }}" id="registerForm">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            
                            <div class="text-white">
                                <p class="font-medium text-lg">Categoria</p>
                                <p>....</p>
                            </div>
                            <div class="lg:col-span-2">
                                <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('department_id', $department->id) }}"required/>
    
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                    <div class="md:col-span-4">
                                        <x-gray-label for="name" value="{{ __('Name') }}" />
                                        <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" minlength="5" maxlength="20" autofocus required autocomplete="name" />
                                    </div>
    
                                    <div class="md:col-span-4 py-3 text-right">
                                        <x-button>
                                            {{ __('Guardar') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla Categoria -->
                    <div class="mt-5 md:mt-1 md:col-span-2">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $category)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">
                                            {{ $category->id }}
                                        </td>
                                        <td scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex item-center justify-center">
                                                @if ($category->trashed())
                                                <a href="/categories/{{ $category->id }}/restore" class="w-4 mr-2 transform hover:scale-110 flex item-center justify-center">
                                                    <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="1 4 1 10 7 10" />  <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" /></svg>
                                                </a>
                                                @else
                                                <a class="w-4 mr-2 transform hover:scale-110" href="/categories/{{$category->id}}/editar">
                                                    <svg class="h-5 w-5 text-gray-500" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                    </svg>
                                                </a>
                                                <form class="inline-block formulario-eliminar" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="mb-2 mr-2 transform hover:scale-110">
                                                        <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                            <polyline points="3 6 5 6 21 6" />  
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  
                                                            <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="3"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white text-center whitespace-nowrap">
                                            {{ __('No se encontraron datos') }}
                                        </td>
                                    </tr>   
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="mt-6">
                            {{$categories->links('pagination::tailwind') }}
                        </div>
                    </div> 
                </div>
                <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"></div>
            </div>
    
            
            <!-- Registro Nivel -->
            <div class="">
                <div class="relative overflow-x-auto">
                    <!-- Formulario Nivel -->
                    <form method="post" action="{{ route('levels.store') }}" id="registerLevel">
                        @csrf
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                            <div class="text-white">
                                <p class="font-medium text-lg">Nivel</p>
                                <p>....</p>
                            </div>
                            <div class="lg:col-span-2">
                                <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('department_id', $department->id) }}"required/>
                                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                    <div class="md:col-span-4">
                                        <x-gray-label for="name" value="{{ __('Name') }}" />
                                        <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" minlength="5" maxlength="20" autofocus required autocomplete="name" />
                                    </div>
                                    <div class="md:col-span-4 py-3 text-right">
                                        <x-button>
                                            {{ __('Guardar') }}
                                        </x-button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Tabla Nivel -->
                    <div class="mt-5 md:mt-1 md:col-span-2">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" width="200" class="px-6 py-3">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($levels as $level)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-3">
                                            {{ $level->id }}
                                        </td>
                                        <td scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $level->name }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <div class="flex item-center justify-center">
                                                @if ($level->trashed())
                                                <a href="/levels/{{ $level->id }}/restore" class="w-4 mr-2 transform hover:scale-110 flex item-center justify-center">
                                                    <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="1 4 1 10 7 10" />  <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" /></svg>
                                                </a>
                                                @else
                                                <a class="w-4 mr-2 transform hover:scale-110" href="/levels/{{$level->id}}/editar">
                                                    <svg class="h-5 w-5 text-gray-500" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                    </svg>
                                                </a>
                                                <form class="inline-block formulario-eliminar" action="{{ route('levels.destroy', $level->id) }}" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <button type="submit" class="mb-2 mr-2 transform hover:scale-110">
                                                        <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                            <polyline points="3 6 5 6 21 6" />  
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  
                                                            <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty  
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td colspan="3"
                                            class="px-6 py-4 font-medium text-gray-900 dark:text-white text-center whitespace-nowrap">
                                            {{ __('No se encontraron datos') }}
                                        </td>
                                    </tr>   
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="mt-6">
                            {{$levels->links('pagination::tailwind') }}
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>