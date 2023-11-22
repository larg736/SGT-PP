<div>
    <h2 class="mb-2 text-lg font-medium text-gray-800 dark:text-white">DEPARTAMENTO</h2>

    <!-- Tablero -->
    <div class="relative bg-white shadow-md dark:bg-gray-900 sm:rounded-lg">
        <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
            <div class="w-full md:w-1/2">
                <input wire:model.debounce.300ms="search" type="text" id="search" placeholder="Buscar..." class="appearance-none w-full py-2.5 px-5 text-sm text-gray-700 bg-white border border-gray-200 rounded-lg xl:transition-all xl:duration-200 xl:w-24 xl:focus:w-28 2xl:w-32 2xl:focus:w-44 xl:h-10 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-600 focus:border-primary dark:focus:border-primary focus:outline-none focus:ring focus:ring-primary dark:placeholder-gray-400 focus:ring-opacity-20">
            </div>
            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                
                <div class="flex items-center w-full space-x-3 md:w-auto">

                    <a href="{{ route('departments.create') }}" class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900 transform hover:scale-110" title="Agregar Departamento">
                        Agregar
                    </a>

                    <a href="/departmentsprint" class="btnprn text-white text-sm py-2.5 px-5 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 dark:bg-gray-900 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-900 transform hover:scale-110" title="Imprimir">
                        <svg class="h-5 w-5 text-white"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
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

    <!-- Tabla Departamento -->
    <div class="flex flex-col mt-6">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden border border-gray-200 dark:border-gray-700 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700" id="myTable">
                        <thead>
                            <tr class="text-sm font-semibold tracking-wide text-left text-gray-400 bg-gray-900 border-b border-gray-600">
                            <th scope="col" class="px-4 py-3 text-sm font-normal text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <div class="flex items-center">
                                    <button wire:click="orderBy('id')">ID</button>
                                    <x-order-icon sortField="id" :order-by="$orderBy" :order-asc="$orderAsc"/>
                                </div>
                            </th>
                            <th class="px-4 py-3">
                                <div class="flex items-center">
                                    <button wire:click="orderBy('name')">NOMBRE</button>
                                    <x-order-icon sortField="name" :order-by="$orderBy" :order-asc="$orderAsc"/>
                                </div>
                            </th>
                            <th class="px-4 py-3">DESCRIPTICION</th>
                            <th class="px-4 py-3"></th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-300">
                            @forelse ($departments as $department)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">{{ $department->id }}</td>
                                <td class="px-4 py-3 text-sm">{{ $department->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $department->description }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex item-center justify-center">
                                        @if ($department->trashed())
                                            <a href="/departments/{{ $department->id }}/restore" class="w-4 mr-2 transform hover:scale-110" title="Restaurar">
                                                <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="1 4 1 10 7 10" />  <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10" /></svg>
                                            </a>
                                        @else
                                            <a href="{{ route('departments.edit', $department->id) }}" class="w-4 mr-2 transform hover:scale-110" title="Editar">
                                                <svg class="h-5 w-5 text-gray-500" width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                    <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z" />
                                                </svg>
                                            </a>  
                                            <button type="submit" class="w-4 mr-2 transform hover:scale-110" title="Eliminar" wire:click="$emit('delete', {{$department->id}})">
                                                <svg class="h-5 w-5 text-gray-500"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                                    <polyline points="3 6 5 6 21 6" />  
                                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  
                                                    <line x1="10" y1="11" x2="10" y2="17" />  <line x1="14" y1="11" x2="14" y2="17" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
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
                        {!! $departments->links() !!}
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
            title:'<div class="text-lg text-gray-50">{{ __('¿Está seguro de que desea eliminar este elemento?') }}</div>',
            icon: 'warning',
            background: '#1F2937',
            iconColor: '#F05252',
            showCancelButton: true,
            confirmButtonColor: '#374151',
            cancelButtonColor: '#C81E1E',
            confirmButtonText: '¡Sí, bórralo!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                
                Livewire.emitTo('departments-table', 'destroy', Id);
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#057A55',
                    iconColor: '#F9FAFB',
                })
                Toast.fire({
                    icon: 'success',
                    title: '<div class="font-medium text-gray-50">{{ __('Se Elimino Satisfactoriamente') }}</div>'
                })
            }
        })
    });
    </script>
@endpush