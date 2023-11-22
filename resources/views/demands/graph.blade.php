<x-app-layout>
    @if (auth()->user()->is_admin)
    <!-- Grafica -->
    <div class="max-w-6xl mx-auto py-6 px-6 lg:px-8">
        <div class="overflow-hidden rounded-lg shadow-md">
        <div class="px-5 py-3 bg-gray-900 bg-opacity-90">
            <div class="sm:flex sm:items-center sm:justify-between">
                <!-- Titulo -->
                <div class="flex items-center gap-x-3">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white">Departamento</h2>
                </div>
        
                <!-- Botones -->
                <div class="flex items-center mt-4 gap-x-3">
                    <input type="date" id="start_date" name="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
                    <span class="mx-4 text-gray-400">a</span>
                    <input type="date" id="end_date" name="end_date" class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
                    <button id="filter" class="transform hover:scale-110 text-gray-400 text-sm py-2 px-3 rounded-md">
                        Filtrar
                    </button>
                </div>    
            </div>
            <canvas class="" id="demandsBar"></canvas>
        </div>
        </div>
    </div>
    @else
    <!-- Alerta -->
    <div class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
        <div class="mt-2 bg-gray-900 bg-opacity-90 rounded shadow-lg p-4 px-4 md:p-8 mb-6">
            <div class="mx-auto flex items-center justify-center">
                <svg class="h-16 w-16 text-yellow-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <circle cx="12" cy="12" r="10" />  <line x1="12" y1="8" x2="12" y2="12" />  <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-5">
                <h3 class="text-lg leading-6 font-medium text-gray-200" id="modal-headline">
                    Prohibido
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-200">
                        ¡Acceso no permitido! <a href="/home" class="font-medium text-white hover:underline dark:text-yellow-500">Volver</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
<script src="/js/graphBar.js"></script>
</x-app-layout>