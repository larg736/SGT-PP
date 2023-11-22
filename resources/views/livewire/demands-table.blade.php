<div>
    <h2 class="mb-2 text-lg font-medium text-gray-800 dark:text-white">TAREAS</h2>

    <!-- Tablero -->
    <div class="relative bg-white shadow-md dark:bg-gray-900 sm:rounded-lg">
        <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/2">
                <form action="{{ route('demands.prnpriview') }}" method="GET" class="flex items-center">
                    <input type="date" id="start_date" name="start_date" wire:model="startDate" class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
                    <span class="mx-4 text-gray-600">a</span>
                    <input type="date" id="end_date" name="end_date" wire:model="endDate" class="mt-1 block w-full py-2 px-3 border border-gray-600 bg-gray-900 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-white">
                    <button type="button" id="btnprn" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-900" title="Imprimir reporte">
                        Reporte
                    </button>
                </form>
            </div>
            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                
                <div class="flex items-center w-full space-x-3 md:w-auto">

                    <input wire:model.debounce.300ms="search" type="text" id="search" placeholder="Buscar..." class="appearance-none w-full py-2.5 px-5 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg xl:transition-all xl:duration-200 xl:w-24 xl:focus:w-28 2xl:w-32 2xl:focus:w-44 xl:h-10 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-primary dark:focus:border-primary focus:outline-none focus:ring focus:ring-primary dark:placeholder-gray-400 focus:ring-opacity-20">
                    
                    <a href="{{ route('demands.create') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900" title="Agregar Tarea">
                        Agregar
                    </a>

                    <select wire:model="perPage" class="block appearance-none w-full text-gray-300 text-sm py-2.5 px-5 rounded-lg bg-gray-900 border border-gray-600" id="grid-state" title="Seleccione Paginacion">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>

                </div>
            </div>
        </div>
    </div>

    <!-- Tabla Solicitudes -->
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="myTable">
                        <thead>
                            <tr class="text-sm font-semibold tracking-wide text-left text-gray-400 bg-gray-900 border-b border-gray-600">
                                <th scope="col" class="px-4 py-3 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center">
                                        <button wire:click="orderBy('id')">Id</button>
                                        <x-order-icon sortField="id" :order-by="$orderBy" :order-asc="$orderAsc"/>
                                    </div>
                                </th>
                                <th class="px-4 py-3">Titulo</th>
                                <th class="px-4 py-3">Descripción</th>
                                <th class="px-4 py-3">Estado</th>
                                <th class="px-4 py-3">Categoria</th>
                                <th class="px-4 py-3">Departamento</th>
                                <th class="px-4 py-3">Nivel</th>
                                <th class="px-4 py-3">Fecha de creación</th>
                                <th class="px-4 py-3"> </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @forelse ($demands as $demand)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">{{ $demand->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $demand->title_short }}</td>
                                <td class="px-4 py-3 text-sm">{{ $demand->description_short }}</td>
                                <td class="px-4 py-3 text-sm">{{ $demand->state }}</td>
                                <td class="px-4 py-3 text-sm">
                                @if (isset($demand->category->name))
                                    {{ $demand->category->name }}
                                @else
                                    No Disponible
                                @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                @if (isset($demand->department->name))
                                    {{ $demand->department->name }}
                                @else
                                    No Disponible
                                @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                @if (isset($demand->level->name))
                                    {{ $demand->level->name }}
                                @else
                                    No Disponible
                                @endif
                                </td>
                                {{-- <td class="px-4 py-3 text-sm">{{ $demand->client_name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $demand->clerk_name }}</td> --}}
                                <td class="px-4 py-3 text-sm">{{ $demand->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-sm"> 
                                    <a href="/demands/{{ $demand->id }}/details" class="" title="Detalle">
                                        <svg class="h-5 w-5 text-gray-500"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  <path stroke="none" d="M0 0h24v24H0z"/>  <rect x="3" y="4" width="18" height="16" rx="3" />  <circle cx="9" cy="10" r="2" />  <line x1="15" y1="8" x2="17" y2="8" />  <line x1="15" y1="12" x2="17" y2="12" />  <line x1="7" y1="16" x2="17" y2="16" /></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty  
                            <tr class="bg-white">
                                <td colspan="11" class="px-6 py-4 font-medium text-gray-700 text-center whitespace-nowrap">
                                    {{ __('No se encontraron datos') }}
                                </td>
                            </tr>   
                            @endforelse
                        </tbody>
                        </table>
                    </table>           
                </div>
                <div class="row">
                    <div class="mt-6">
                        {!! $demands->links() !!}
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<!-- Alerta Eliminar -->
@push('script')
    <script>
        Livewire.on('delete', Id => {
        Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, bórralo!',
                    cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                
                Livewire.emitTo('demands-table', 'destroy', Id);
                Swal.fire(
                    '',
                    'Se Elimino Satisfactoriamente',
                    'success'
                )
            }
        })
    });
    </script>
    <script>
        $(document).ready(function(){
            $('#btnprn').on('click', function(){
                let start_date = $('#start_date').val();
                let end_date = $('#end_date').val();
                let url = '{{ route('demands.prnpriview') }}?start_date=' + start_date + '&end_date=' + end_date;
                
                $.ajax({
                    url: url,
                    success: function(data) {
                        let printWindow = window.open('', '_blank');
                        printWindow.document.write(data);
                        printWindow.document.close();
                        printWindow.print();
                    }
                });
            });
        });
    </script>
@endpush