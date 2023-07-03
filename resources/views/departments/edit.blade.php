<x-app-layout>
    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('departments.update', $department->id) }}">
                    @csrf
                    @method('put')
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Departamento</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('name', $department->name) }}"required/>
                            @error('name')
                                <p class="text-sm text-gray-300">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
                            <input type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            value="{{ old('description', $department->description) }}" required/>
                            @error('description')
                                <p class="text-sm text-gray-300">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                        Guardar
                    </button>
                </form>
            </div>
        </div>
        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"></div>
    </div>

    {{-- Table Categories --}}

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto">
            <form method="post" action="{{ route('categories.store') }}">
                @csrf
                <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                value="{{ old('department_id', $department->id) }}"required/>

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Categoria</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        />
                        @error('name')
                            <p class="text-sm text-gray-300">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="flex items-center p-8 space-x-2 rounded-b">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Guardar
                        </button>
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
                                    <form class="inline-block" action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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

    {{-- Modal Category --}}

    <div id="modalEditCategory" tabindex="-1" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
        <div class="relative w-auto my-6 mx-auto max-w-sm">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-6 space-y-6">
                    <form method="post" action="{{ route('categories.update', $category->id) }}">
                        @csrf
                        @method('put')
                        <div class="grid gap-6 mb-6 md">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Departamento</label>
                                <input type="text" name="name" id="category_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('name', $category->name) }}"required/>
                                @error('name')
                                    <p class="text-sm text-gray-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Table Nivel --}}

    <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="relative overflow-x-auto">
            <form method="post" action="{{ route('levels.store') }}">
                @csrf
                <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                value="{{ old('department_id', $department->id) }}"required/>

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Nivel</label>
                        <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        />
                        @error('name')
                            <p class="text-sm text-gray-300">{{ $message }}</p>
                        @enderror
                    </div>
                
                    <div class="flex items-center p-8 space-x-2 rounded-b">
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Guardar
                        </button>
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
                                    <form class="inline-block" action="{{ route('levels.destroy', $level->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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

    {{-- Modal Nivel --}}

    {{-- <div id="modalEditLevel" tabindex="-1" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
        <div class="relative w-auto my-6 mx-auto max-w-sm">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-6 space-y-6">
                    <form method="post" action="{{ route('levels.update') }}">
                        @csrf
                        @method('put')
                        <div class="grid gap-6 mb-6 md">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Departamento</label>
                                <input type="text" name="name" id="level_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                value="{{ old('name', $level->name) }}"required/>
                                @error('name')
                                    <p class="text-sm text-gray-300">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
</x-app-layout>

