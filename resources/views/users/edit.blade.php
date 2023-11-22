<x-app-layout>
<div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
    <div class="bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <x-validation />

        <!-- Formulario Actualizar Usuario -->
        <div>
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('put')
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                    <div class="text-gray-100">
                        <p class="font-medium text-lg">Editar Usuario</p>
                        <p>.....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <x-gray-label for="name" value="{{ __('Name') }}" />
                                <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$user->name" minlength="5" maxlength="50" autofocus autocomplete="on" />
                                <x-input-error for="name" class="mt-2" />
                            </div>
            
                            <div class="md:col-span-2">
                                <x-gray-label for="email" value="{{ __('Email') }}" />
                                <x-gray-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" required autofocus autocomplete="on" />
                                <x-input-error for="email" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-gray-label for="password" value="{{ __('Password') }}" />
                                <x-gray-input id="password" class="block mt-1 w-full" type="password"  name="password" minlength="8" maxlength="20" autofocus autocomplete="on" />
                                <x-input-error for="password" class="mt-2" />
                            </div>

                            <div class="md:col-span-2">
                                <x-gray-label for="roles" class="text-gray-100" value="{{ __('Rol') }}" />
                                <select name="roles[]" id="roles" class="form-multiselect block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    @foreach($roles as $id => $role)
                                        <option value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="roles" class="mt-2" />
                            </div>

                            <div class="md:col-span-4 py-3 text-right">
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
        

        <!-- Registro de Nivel de Usuario -->
        <div class="">
            <div class="mt-2 relative overflow-x-auto">
                {{-- Formulario Nivel --}}
                <form method="post" action="{{ route('departments_user.store') }}">
                @csrf
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                        <div class="text-gray-100">
                            <p class="font-medium text-lg">Asignar Departamento y Nivel</p>
                            <p>El usuario debe estar asociado a un departamento y tener un nivel....</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input type="hidden" name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('user_id', $user->id) }}"required/>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-2">
                                    <x-gray-label for="select-department" value="{{ __('Departamento') }}" />
                                    <select name="department_id" id="select-department" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione departamento</option>
                                    @foreach($departments as $id => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                
                                <div class="md:col-span-2">
                                    <x-gray-label for="select-level" value="{{ __('Nivel') }}" />
                                    <select name="level_id" id="select-level" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                        <option value="">Seleccione nivel</option>
                                    </select>
                                </div>
    
                                <div class="md:col-span-4 py-3 text-right">
                                    <x-button>
                                        {{ __('Asignar') }}
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                <!-- Tabla Nivel -->
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" id="table2" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Departamento
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nivel
                                </th>
                                <th scope="col" width="200" class="px-6 py-3">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($departments_user as $department_user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $department_user->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if (isset($department_user->department->name))
                                            {{ $department_user->department->name }}
                                        @else
                                            No Disponible
                                        @endif
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if (isset($department_user->level->name))
                                            {{ $department_user->level->name }}
                                        @else
                                            No Disponible
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex item-center justify-center">
                                            @if ($department_user->trashed())
                                                <a href="/departments_user/{{ $department_user->id }}/restore" class="w-4 mr-2 transform hover:scale-110">
                                                    <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="1 4 1 10 7 10" />  <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" /></svg>
                                                </a>
                                            @else
                                            <a class="w-4 mr-2 transform hover:scale-110" href="/departments_user/{{$department_user->id}}/editar">
                                                <svg class="h-5 w-5 text-gray-500" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                </svg>
                                            </a>
                                            <form class="inline-block formulario-eliminar" action="{{ route('departments_user.destroy', $department_user->id) }}" method="POST">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <button type="submit" class="w-4 mr-2 transform hover:scale-110">
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
                                    <td colspan="4"
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
                        {{$departments_user->links('pagination::tailwind') }}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
</x-app-layout>