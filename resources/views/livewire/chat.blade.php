<div class="border border-gray-700 shadow-md rounded-lg max-w-lg w-full">
    <div class="p-4 h-96 overflow-y-auto">
        @forelse ($messages as $message)
        <div class="flex w-full mt-2 space-x-3 max-w-xs">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
                <img class="h-10 w-10 rounded-full" src="{{ $message->user->profile_photo_url }}" alt="">
            </div>
            <div>
                <span class="text-xs text-white leading-none">{{ $message->user->email }}</span>
                <span class="text-xs text-gray-400 leading-none">{{ $message->created_at->diffForHumans(null, false, false) }}</span>
                <p class="text-sm">{{ $message->message }}</p>
            </div>
        </div>
        @empty
        <h5 class="text-white text-center">No Hay Comentarios...</h5>
        @endforelse
    </div>
    <div>
        <form wire:submit.prevent="sendMessage">
            <div class="p-4 flex">
                <textarea wire:model.defer="messageText" type="text" rows="1" class="block mx-2 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Agrega un comentario..." required></textarea>
                <button class="w-4 mr-2 transform hover:scale-110 text-gray-700" title="Enviar">
                    <svg class="w-5 h-5 rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                    </svg>                
                </button>
            </div>
        </form>
    </div>
</div>