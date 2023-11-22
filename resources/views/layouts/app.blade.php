<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>SGT</title>
        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
            integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
            crossorigin="anonymous" referrerpolicy="no-referrer">
        </script>
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

        <!-- Fondo -->
        <style>
            body{
                background: url("/fondo.png");
                background-repeat: no-repeat;
                background-size: cover;
                z-index: -3;
                background-attachment: fixed;
            }
        </style>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-900 bg-opacity-60">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
            
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

                

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main> 
        </div>

        @stack('modals')
        
        @stack('js')
        <script src="/js/chart.js"></script>

        <!-- Alerts -->
        @if (Session::has('title','icon'))
            <script>
                Swal.fire({
                    title: '<div class="text-lg text-gray-50">{{ Session::get('title') }}</div>',
                    icon: "{{ Session::get('icon') }}",
                    background: '#1F2937',
                    iconColor: '#F05252',
                    confirmButtonColor: '#374151',
                    });
            </script>
        @endif

        @if (Session('enviado')=='ok')
        <script>
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
                title: '<div class="font-medium text-gray-50">{{ __('Operación Exitosa') }}</div>'
            })
        </script>
        @endif

        <script>
            $('.formulario-eliminar').submit(function(e){
                e.preventDefault();
                    var link = $(this).attr("href");
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
                    title: '<div class="text-lg text-gray-50">{{ __('¿Estás seguro?') }}</div>',
                    background: '#1F2937',
                    showDenyButton: true,
                    confirmButtonText: 'Si, Guardar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                })
            })
        </script>

        <script>
            $('#registerLevel').submit(function(e){
                e.preventDefault();
                var link = $(this).attr("href");
                Swal.fire({
                    title: '<div class="text-lg text-gray-50">{{ __('¿Estás seguro?') }}</div>',
                    background: '#1F2937',
                    showDenyButton: true,
                    confirmButtonText: 'Guardar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                })
            })
        </script>
        <!-- ./Alerts -->
        @livewireScripts
        @stack('script')
    </body>

    <footer class="flex flex-none items-center bg-gray-900 bg-opacity-80">
        <div class="text-center text-white flex flex-col md:text-left md:flex-row md:justify-between text-sm container xl:max-w-6xl mx-auto px-4 lg:px-8">
          <div class="pt-4 pb-1 md:pb-4">
            <span class="font-medium">Sistemas de gestión de tareas</span> © <script>document.write((new Date).getFullYear());</script>
          </div>
          <div class="pb-4 pt-1 md:pt-4 inline-flex items-center justify-center text-white">
            <span>Crafted with</span>
            <svg class="hi-solid hi-heart inline-block w-4 h-4 mx-1 text-red-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
            <span>by <a href="#" target="_blank" class="font-medium text-blue-400 hover:text-blue-500 hover:underline"></a>Leudis Rojas</span>
          </div>
        </div>
    </footer>
</html>
