<div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
    @if (count($errors) > 0)
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <div class="bg-gray-400 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-3">
            <div class="text-gray-600">
                <p class="font-medium text-lg">Mensajeria</p>
                <p>
                    ..........
                </p>
            </div>
            <div class="lg:col-span-2">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                        <div class="flex flex-col flex-auto h-full p-6">
                            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-900 h-full p-4">
                                <div class="flex flex-col h-full overflow-x-auto mb-4">
                                    <div class="flex flex-col h-full">
                                        <div class="grid grid-cols-12 gap-y-2">
                                            <div class="col-start-1 col-end-8 p-3 rounded-lg">
                                                @foreach ($messages as $message)
                                                <div class="flex flex-row items-center">
                                                    <div class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 flex-shrink-0">
                                                        <img class="h-8 w-8 rounded-full" src="{{ $message->user->profile_photo_url }}" alt="">
                                                    </div>
                                                    <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                                                        <div>{{ $message->message }}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($demand->state == 'Asignado')
                                <div class="flex flex-row items-center h-16 rounded-xl bg-gray-400 w-full px-4">
                                    <div>
                                        <form action="{{route('messages.store')}}" method="POST">
                                            @csrf
                                            <button class="flex items-center justify-center text-gray-400 hover:text-gray-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                                </svg>
                                            </button>
                                            </div>
                                            <div class="flex-grow ml-4">
                                                <div class="relative w-full">
                                                    <input type="hidden" name="demand_id" value="{{ $demand->id }}">
                                                    <input type="text" name="message" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10"/>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <button type="submit" class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                                                    <span>Enviar</span>
                                                    <span class="ml-2">
                                                    <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                                    </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
