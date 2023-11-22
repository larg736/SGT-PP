<x-app-layout>
    <!-- Formulario Editar Nivel -->
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <x-validation/>
            <form method="post" action="{{ route('departments_user.update', $department_user->id) }}">
                @csrf
                @method('put')
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-100">
                        <p class="font-medium text-lg">Editar Nivel</p>
                        <p>El usuario debe estar asociado a un departamento y tener un nivel....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <input type="hidden" name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                        value="{{ old('user_id',$department_user->user_id ) }}" required/>

                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-4">
                            <div class="md:col-span-2">
                                <div class="md:col-span-2">
                                    <x-gray-label for="department_id" value="{{ __('Departamento') }}" />
                                    <x-gray-input disabled="true" id="department_id" class="block mt-1 w-full cursor-not-allowed" type="text" name="department_id" :value="$department_user->department->name" minlength="3" maxlength="50" autofocus autocomplete="name" />
                                </div>
                            </div>
            
                            <div class="md:col-span-2">
                                <x-gray-label for="level_id" value="{{ __('Nivel') }}" />
                                <select name="level_id" id="level_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
									<option value="">Seleccione Nivel</option>
                                    @foreach($levels as $level)
                                        <option value="{{ $level->id }}" @if($department_user->level_id == $level->id) selected @endif>{{ $level->name }}</option>
									@endforeach
                                </select>
                            </div>

                            <div class="md:col-span-4 py-3 text-right">
                                <x-button>
                                    {{ __('Guardar Cambios') }}
                                </x-button>
                                <x-button-gray href="/users">
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