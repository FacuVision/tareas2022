<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis tareas en: {{ $carpeta->titulo }} // Sesion : {{ $carpeta->sesion }}
            </h2>
        </div>
    </x-slot>
    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-12 bg-white">
                    <div class="container p-4">
                        <div class="grid gap-4 grid-cols-3 md:inline-flex">
                                @php
                                    $i=0;
                                @endphp
                            @foreach ($datos as $dato)

                                @if ($carpeta->id == $dato->carpeta->id)
                                    <div class="w-full md:w-3/5 text-left p-6 md:p-4 space-y-2 box-border border-2">
                                        <a href="{{ route('alumno.tareas.show', $dato->carpeta->tareas[$i]) }}" class="text-xl text-indigo-600 font-bold">{{$dato->carpeta->tareas[$i]->titulo}}</a>
                                        <p class="text-l text-gray-600 font-bold">Sesion: {{$dato->carpeta->sesion}}</p>
                                        <p class="text-base text-gray-400">{{$dato->carpeta->tareas[$i]->descripcion}}</p>
                                        <div class="flex justify-start space-x-2">
                                            <p class="text-left text-gray-500"></p>
                                        </div>
                                    </div>
                                @endif
                                @php
                                $i++;
                            @endphp
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div> --}}

    <div class="flex flex-col py-4 max-w-7xl mx-auto sm:px-6">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table id="dtBasicExample" class="table min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">

                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Titulo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Descripcion
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acción
                                </th>
                                {{-- <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th> --}}
                                {{-- <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th> --}}
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($datos as $dato)

                                @if ($carpeta->id == $dato->carpeta->id)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="ml-0">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $dato->carpeta->tareas[$i]->titulo }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $dato->carpeta->tareas[$i]->descripcion }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @switch($dato->carpeta->tareas[$i]->estado)
                                                @case(0)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                        Activo
                                                    </span>
                                                @break

                                                @case(1)
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-300 text-gray-800">
                                                        Inactivo
                                                    </span>
                                                @break

                                            @endswitch
                                            {{-- {{$dato->carpeta->tareas[$i]->estado}} --}}

                                        </td>
                                        {{-- <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            Admin
                                        </td> --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            {{-- <x-jet-button class="py-1 px-6" wire:click="showtarea( {{$dato->carpeta->tareas[$i]}} )">
                                                VER
                                            </x-jet-button> --}}
                                            {{-- <a href="#" wire-click="showtarea({{$dato->carpeta->tareas[$i]}})" class="md:box-content text-white bg-indigo-600 rounded-lg py-1 px-6 hover:bg-indigo-800">VER</a> --}}
                                        @livewire('show-tarea', ['dato' => $dato->carpeta->tareas[$i]])

                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
