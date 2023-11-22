<!DOCTYPE html
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Tareas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel=" stylesheet">
    </head>
    <body class="font-sans antialiased">
        <x-banner />
        <table class="w-full">
            <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                <th class="px-4 py-3 text-sm border">Id</th>
                <th class="px-4 py-3 text-sm border">Titulo</th>
                <th class="px-4 py-3 text-sm border">Descripción</th>
                <th class="px-4 py-3 text-sm border">Severidad</th>
                <th class="px-4 py-3 text-sm border">Estado</th>
                <th class="px-4 py-3 text-sm border">Categoria</th>
                <th class="px-4 py-3 text-sm border">Departamento</th>
                <th class="px-4 py-3 text-sm border">Nivel</th>
                <th class="px-4 py-3 text-sm border">Solicitante</th>
                <th class="px-4 py-3 text-sm border">Empleado</th>
                <th class="px-4 py-3 text-sm border">Fecha de creación</th>
               
            </thead>
            <tbody class="bg-white">
                @forelse ($demands as $demand)
                <tr class="text-gray-700">
                    <td class="px-4 py-3 text-sm border">{{ $demand->id }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->title }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->description }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->severity_full }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->state }}</td>
                    <td class="px-4 py-3 text-sm border">
                    @if (isset($demand->category->name))
                        {{ $demand->category->name }}
                    @else
                        No Disponible
                    @endif
                    </td>
                    <td class="px-4 py-3 text-sm border">
                    @if (isset($demand->department->name))
                        {{ $demand->department->name }}
                    @else
                        No Disponible
                    @endif
                    </td>
                    <td class="px-4 py-3 text-sm border">
                    @if (isset($demand->level->name))
                        {{ $demand->level->name }}
                    @else
                        No Disponible
                    @endif
                    </td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->client_name }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->clerk_name }}</td>
                    <td class="px-4 py-3 text-sm border">{{ $demand->created_at }}</td>
                </tr>
                @empty  
                    <tr class="bg-white border-b">
                        <td colspan="11" class="px-6 py-4 font-medium text-gray-900 text-center whitespace-nowrap">
                            {{ __('No se encontraron datos') }}
                        </td>
                    </tr>   
                @endforelse
            </tbody>
        </table>
    </body>
</html>