<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <x-validation />
            <form method="POST" action="{{ route('users.store') }}" id="registerForm">
                @csrf
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
                    <div class="text-gray-100">
                        <p class="font-medium text-lg">Nuevo Usuario</p>
                        <p>....</p>
                    </div>
                    <div class="lg:col-span-2">
                        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                            <div class="md:col-span-3">
                                <x-gray-label for="name" value="{{ __('Name') }}" />
                                <x-gray-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" minlength="5" maxlength="50" autofocus autocomplete="on" />
                                <x-input-error for="name" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-gray-label for="password" value="{{ __('Password') }}" />
                                <x-gray-input id="password" class="block mt-1 w-full" type="password"  name="password" :value="old('password')" minlength="8" maxlength="20" autofocus autocomplete="on" />
                                <x-input-error for="password" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-gray-label for="roles" class="text-gray-100" value="{{ __('Rol') }}" />
                                <select name="roles[]" id="roles" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">Seleccione Rol</option>
                                    @foreach($roles as $id => $role)
                                        <option value="{{ $id }}"{{ in_array($id, old('roles', [])) ? ' selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>
                                <x-input-error for="roles" class="mt-2" />
                            </div>
                            <div class="md:col-span-3">
                                <x-gray-label for="email" value="{{ __('Email') }}" />
                                <x-gray-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="on" />
                                <x-input-error for="email" class="mt-2" />
                            </div>
                        </div>
                        <div class="md:col-span-4 py-3 text-right">
                            <x-button>
                                {{ __('Guardar') }}
                            </x-button>
                            <x-button-gray href="/users">
                                Volver
                            </x-button-gray>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>