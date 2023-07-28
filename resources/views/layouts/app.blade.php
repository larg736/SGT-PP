<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
        <!--Regular Datatables CSS-->
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
        <!--Responsive Extension Datatables CSS-->
        <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script src="/js/edit.js"></script>
        <script src="/js/user.js"></script>
        <script src="/js/app.js"></script>

         <!-- Inter Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <style>
        html {
            font-family: 'Inter';
        }
        </style>

        <!-- Charts.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

        <!-- Styles -->
        @livewireStyles
        <style>
            body{
                background: url("https://static.vecteezy.com/system/resources/previews/013/614/661/non_2x/abstract-computer-technology-background-with-circuit-board-and-circle-tech-illustration-vector.jpg");
                background-repeat: no-repeat;
                background-size: 100vw 100vh;
                z-index: -3;
                background-attachment: fixed;
            }
        </style>
        <style>
            /*Form fields*/
            .dataTables_wrapper select,
            .dataTables_wrapper .dataTables_filter input {
                color: #ffffff;
                padding-left: 1rem;
                padding-right: 1rem;
                padding-top: .5rem;
                padding-bottom: .5rem;
                line-height: 1.25;
                border-width: 2px;
                border-radius: .25rem;
                border-color: #6B7280;
                background-color: #6B7280;
            }
    
            /*Row Hover*/
            table.dataTable.hover tbody tr:hover,
            table.dataTable.display tbody tr:hover {
                background-color: #374151;
            }
    
            /*Pagination Buttons*/
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                font-weight: 700;
                border-radius: .25rem;
                border: 1px solid transparent;
            }
    
            /*Pagination Buttons - Current selected */
            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
                color: #fff !important;
                box-shadow: 0 1px 3px 0 rgb(0, 0, 0), 0 1px 2px 0 rgb(0, 0, 0);
                font-weight: 700;
                border-radius: .25rem;
                background: #374151 !important;
                border: 1px solid transparent;
            }
    
            /*Pagination Buttons - Hover */
            .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
                color: #fff !important;
                box-shadow: 0 1px 3px 0 rgb(0, 0, 0), 0 1px 2px 0 rgb(0, 0, 0);
                font-weight: 700;
                border-radius: .25rem;
                background: #D1D5DB !important;
                border: 1px solid transparent;
            }
    
            /*Add padding to bottom border */
            table.dataTable.no-footer {
                border-bottom: 1px solid #000000;
                margin-top: 0.75em;
                margin-bottom: 0.75em;
            }
    
            /*Change colour of responsive icon*/
            table.dataTable.dtr-inline.collapsed>tbody>tr>td:first-child:before,
            table.dataTable.dtr-inline.collapsed>tbody>tr>th:first-child:before {
                background-color: #362F78 !important;
            }
        </style>
    </head>

    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-900 bg-opacity-75">
        
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>

        {{-- footer --}}

        {{-- <footer class="flex flex-none items-center bg-gray-900 bg-opacity-75">
            <div class="text-center flex flex-col md:text-left md:flex-row md:justify-between text-sm container xl:max-w-6xl mx-auto px-4 lg:px-8">
              <div class="pt-4 pb-1 md:pb-4">
                <span class="font-medium">Task Management Systems</span> © <script>document.write((new Date).getFullYear());</script>
              </div>
              <div class="pb-4 pt-1 md:pt-4 inline-flex items-center justify-center">
                <span>Crafted with</span>
                <svg class="hi-solid hi-heart inline-block w-4 h-4 mx-1 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
                <span>by <a href="#" target="_blank" class="font-medium text-blue-400 hover:text-blue-500 hover:underline"></a>Leudis Rojas</span>
              </div>
            </div>
        </footer> --}}


        @stack('modals')
        
        @stack('js')

        {{-- Alert Guardardo --}}
        @if (Session('alert')=='ok')
            <script>
                Swal.fire(
                    '¡Se Guardo!',
                    '¡Hiciste clic en el botón!',
                    'success'
                    );
            </script>
        @endif

        {{-- Alert Atender --}}
        @if (Session('atender')=='ok')
        <script>
            Swal.fire(
                '¡Solicitud Asignada!',
                '¡Hiciste clic en el botón!',
                'success'
                );
        </script>
        @endif
        
        {{-- Alert Eliminar --}}
        @if (Session('eliminar')=='ok')
        <script>
            Swal.fire(
                '¡Borrado!',
                'Su archivo ha sido eliminado.',
                'success'
             ) 
        </script>
        @endif

        
        <script>
            $('.formulario-eliminar').submit(function(e){
                e.preventDefault();
                    var link = $(this).attr("href");
                    Swal.fire({
                        title: '¿Estas seguro?',
                        text: "¡No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, bórralo!',
                        cancelButtonText: 'Cancelar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    })
                })
        </script>

        <script>
            $('#registerForm').submit(function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: '¿Quieres guardar los cambios?',
                    showDenyButton: true,
                    confirmButtonText: 'Guardar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                })
            })
        </script>

        <!-- jQuery -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

        <!--Datatables -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
      
        @stack('script')
        @livewireScripts
    </body>
</html>
