<x-app-layout>
    <!-- Formulario Editar Categoria -->
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <x-validation/>
            <form method="post" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('put')
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-100">
                        <p class="font-medium text-lg">Editar Categoria</p>
                        <p>....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <input type="hidden" name="department_id" id="department_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('department_id',$category->department_id ) }}" required/>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <div class="md:col-span-2">
                                    <x-gray-label for="name" value="{{ __('Nombre') }}" />
                                    <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$category->name" minlength="5" maxlength="20" autofocus required autocomplete="name" />
                                </div>
                            </div>
                            <div class="md:col-span-4 py-3 text-right">
                                <x-button>
                                    {{ __('Guardar Cambios') }}
                                </x-button>
                                <x-button-gray href="/departments">
                                    Volver
                                </x-button-gray>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>