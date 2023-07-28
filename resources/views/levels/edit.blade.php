<div id="modalEditLevel" tabindex="-1" aria-hidden="true" class="hidden overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center">
    <div class="relative w-auto my-6 mx-auto max-w-sm">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="p-6 space-y-6">
                <form method="post" action="{{ route('levels.update', $level->id) }}">
                    @csrf
                    @method('put')
                    <input type="hidden" name="level_id" id="level_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"/>
                    <div class="grid gap-6 mb-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre Nivel</label>
                            <input type="text" name="name" id="level_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                required/>
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
