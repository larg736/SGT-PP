<x-app-layout>
<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-2">
    <div class="bg-gray-400 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        {{-- Formulario Edit User --}}
        <div>
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('put')
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Editar Usuario</p>
                        <p>.....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <label for="name" class="block font-medium text-sm text-gray-100">Name</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('name', $user->name) }}" />
                                @error('name')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="email" class="block font-medium text-sm text-gray-100">Email</label>
                                <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('email', $user->email) }}" />
                                @error('email')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="password" class="block font-medium text-sm text-gray-100">Password</label>
                                <input type="text" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" 
                                />
                                @error('password')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="roles" class="block font-medium text-sm text-gray-100">Roles</label>
                                <select name="roles[]" id="roles" class="form-multiselect bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                    @foreach($roles as $id => $role)
                                        <option value="{{ $id }}"{{ in_array($id, old('roles', $user->roles->pluck('id')->toArray())) ? ' selected' : '' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-4 py-3 text-right">
                                <button class="px-4 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-cyan-100 bg-cyan-500 hover:bg-cyan-600 shadow-cyan-400/30">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </div>
                
                </div>
            </form>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"></div>
        </div>

        {{-- Table Nivel y Categoria --}}
        <div class="">
            <div class="relative overflow-x-auto">
                <form method="post" action="{{ route('departments_user.store') }}">
                    @csrf
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Asignar Departamento y Nivel</p>
                            <p>El usuario debe estar asociado a un departamento y tener un nivel....</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input type="hidden" name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('user_id', $user->id) }}"required/>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-2">
                                    <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Departamento</label>
                                    <select name="department_id" id="select-department" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="">Seleccione departamento</option>
                                    @foreach($departments as $id => $department)
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                
                                <div class="md:col-span-2">
                                    <label for="level_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel</label>
                                    <select name="level_id" id="select-level" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        <option value="">Seleccione nivel</option>
                                    </select>
                                </div>
    
                                <div class="md:col-span-4 py-3 text-right">
                                    <button class="px-4 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-cyan-100 bg-cyan-500 hover:bg-cyan-600 shadow-cyan-400/30">
                                        Asignar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
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
                            @foreach ($departments_user as $department_user)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $department_user->department->name }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $department_user->level->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-purple-600 hover:text-purple-900 mb-2 mr-2" data-category="">Edit</button>
                                        <form class="inline-block formulario-eliminar" action="{{ route('departments_user.destroy', $department_user->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-blue-600 hover:text-blue-900 mb-2 mr-2" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>