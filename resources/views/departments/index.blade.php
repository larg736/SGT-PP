<x-app-layout>
<section class="max-w-7xl mx-auto py-10 px-6 lg:px-8">
    <!-- Tabla Departamento -->
    @if (auth()->user()->is_admin)
        @livewire('departments-table')
    @else
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
</section>

@push('js')
    <script type="text/javascript" src="js/position-absolute.com_creation_print_jquery.printPage.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btnprn').printPage();
        });
    </script>
@endpush
</x-app-layout>
    