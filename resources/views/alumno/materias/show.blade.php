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
                    {{-----------------------------------------------------------------------}}

                        <section>
                          <div class="grid grid-cols-3 max-w-6xl mx-auto px-5 py-8">

                            @foreach ($datos as $dato)
                                @if ($materia->id == $dato->materia->id)

                                <div class="flex flex-wrap">
                                    {{-- <div class="xl:w-1/3 md:w-1/2 p-4"> --}}
                                        <div class="text-center border border-gray-300 p-6 m-2 rounded-lg">
                                            <a href="{{ route('alumno.carpetas.show', $dato) }}"
                                                class="text-xl text-indigo-600 font-bold">{{$dato->titulo}}
                                                <div
                                                    class="w-full inline-flex items-center justify-center text-indigo-500 pb-4">
                                                    <i class="far fa-folder-open fa-3x" style="color: rgb(255, 200, 19);"></i>
                                                </div>
                                            </a>
                                            <p class="leading-relaxed text-base text-gray-600"><b>Fecha de inicio:</b> {{$dato->fecha_inicio}}</p>
                                            <p class="leading-relaxed text-base text-gray-600"><b>Fecha de cierre:</b> {{$dato->fecha_final}}</p>
                                            @if ($dato->estado == 0)
                                            <p class="text-center text-red-500"><b>Inactivo</b></p>
                                            @else
                                            <p class="text-center text-green-500"><b>Activo</b></p>
                                            @endif



                                </div>
                                @endif

                            @endforeach


                        </section>




                </div>

            </div>
        </div>
    </div>

</x-app-layout>
