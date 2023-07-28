<x-app-layout>
<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-2">
    <div class="bg-gray-400 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div>
            <form method="post" action="{{ route('departments.update', $department->id) }}">
                @csrf
                @method('put')
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                    <div class="text-gray-600">
                        <p class="font-medium text-lg">Editar Departamento</p>
                        <p>.....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Departamento</label>
                                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('name', $department->name) }}"required/>
                                @error('name')
                                    <p class="text-sm text-gray-300">{{ $message }}</p>
                                @enderror
                            </div>
            
                            <div class="md:col-span-2">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                                <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('description', $department->description) }}" required/>
                                @error('description')
                                    <p class="text-sm text-gray-300">{{ $message }}</p>
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

        {{-- Table Categories --}}

        <div class="">
            <div class="relative overflow-x-auto">
                <form method="post" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Categoria</p>
                            <p>....</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('department_id', $department->id) }}"required/>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-4">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Categoria</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required/>
                                    @error('name')
                                        <p class="text-sm text-gray-300">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-4 py-3 text-right">
                                    <button class="px-4 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-cyan-100 bg-cyan-500 hover:bg-cyan-600 shadow-cyan-400/30">
                                        Guardar
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
                            @foreach ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $category->id }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-purple-600 hover:text-purple-900 mb-2 mr-2" data-category="{{ $category->id }}">Edit</button>
                                        <form class="inline-block formulario-eliminar" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-blue-600 hover:text-blue-900 mb-2 mr-2" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @include('categories.edit')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"></div>
        </div>

        {{-- Table Nivel --}}

        <div class="">
            <div class="relative overflow-x-auto">
                <form method="post" action="{{ route('levels.store') }}">
                    @csrf
                    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                
                        <div class="text-gray-600">
                            <p class="font-medium text-lg">Nivel</p>
                            <p>....</p>
                        </div>
                        <div class="lg:col-span-2">
                            <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('department_id', $department->id) }}"required/>

                            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                                <div class="md:col-span-4">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Nivel</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    required/>
                                    @error('name')
                                        <p class="text-sm text-gray-300">{{ $message }}</p>
                                    @enderror
                                </div>
                
                                <div class="md:col-span-4 py-3 text-right">
                                    <button class="px-4 py-2 text-sm transition-colors duration-300 rounded rounded-full shadow-xl text-cyan-100 bg-cyan-500 hover:bg-cyan-600 shadow-cyan-400/30">
                                        Guardar
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
                            @foreach ($levels as $level)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $level->id }}
                                    </td>
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $level->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <button type="button" class="text-purple-600 hover:text-purple-900 mb-2 mr-2" data-level="{{ $level->id }}">Edit</button>
                                        <form class="inline-block formulario-eliminar" action="{{ route('levels.destroy', $level->id) }}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="text-blue-600 hover:text-blue-900 mb-2 mr-2" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @include('levels.edit')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@if (Session('alert')=='ok')
    <script>
        Swal.fire(
            '¡Se Guardo!',
            '¡Hiciste clic en el botón!',
            'success'
            );
    </script>
@endif

</x-app-layout>