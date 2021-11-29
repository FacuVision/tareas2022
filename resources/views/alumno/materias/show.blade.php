<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis carpetas en: {{ $materia->nombre }}
            </h2>
        </div>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="pt-4 pl-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <a href="{{ route('alumno.materias.index') }}" class="bg-gray-600 text-white px-3 py-2 rounded-md text-sm font-medium">Volver a Materias</a>
                </h2>
                </div>
                <div class="py-4 bg-white">
                    <div class="container p-4">
                        <div class="grid gap-4 grid-cols-3 md:inline-flex">

                            @foreach ($datos as $dato)

                                @if ($materia->id == $dato->materia->id)
                                    <div class="w-full md:w-3/5 text-center p-6 md:p-4 space-y-2 box-border border-2">

                                        <a href="{{ route('alumno.carpetas.show', $dato) }}" class="text-xl text-indigo-600 font-bold">{{$dato->titulo}}
                                        <div class="text-center pt-2 pb-4 block">
                                            <i class="far fa-folder-open fa-3x" style="color: rgb(255, 200, 19);"></i>
                                        </div>
                                        </a>
                                        <p class="text-l text-gray-600 font-bold">Fecha de inicio: {{$dato->fecha_inicio}}</p>
                                        <p class="text-base text-gray-400">Fecha de cierre: {{$dato->fecha_final}}</p>
                                        <div class="flex justify-start space-x-2">
                                            <p class="text-left text-gray-500"></p>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
