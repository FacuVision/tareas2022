<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis materias
            </h2>
        </div>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="pt-4 pl-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <a class=" text-white px-3 py-2 rounded-md text-sm font-medium"></a>
                    </h2>
                </div>
                <div class="py-4 bg-white">
                    {{-- ------------------------------------------------- --}}
                    <section>
                        <div class="grid grid-cols-3 max-w-6xl mx-auto px-5 py-24">

                            @foreach ($materias as $materia)


                                <div class="flex flex-wrap -m-4">
                                    <div class="xl:w-1/3 md:w-1/2 p-4">
                                        <div class="text-center border border-gray-300 p-6 m-2 rounded-lg">
                                            <a href="{{ route('alumno.materias.show', $materia) }}"
                                                class="text-xl text-indigo-600 font-bold">{{ $materia->nombre }}
                                                <div
                                                    class="w-full inline-flex items-center justify-center rounded-full bg-indigo-100 text-indigo-500 pb-4">
                                                    <i class="fas fa-book fa-3x"></i>
                                                </div>
                                            </a>
                                            <p class="leading-relaxed text-base text-gray-600">
                                                {{ $materia->descripcion }}</p>
                                        </div>

                                        {{-- <div class="text-center mt-2 leading-none flex justify-between w-full">
                                  <span class=" mr-3 inline-flex items-center leading-none text-sm  py-1 ">

                                  <svg class=" fill-current w-4 h-4 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                  <path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/>
                                  </svg>
                                    40 min
                                  </span>
                                </div> --}}
                                    </div>

                            @endforeach

                        </div>
                    </section>
                    {{-- <div class="container p-4">
                        <div class="grid gap-4 grid-cols-3 md:inline-flex">


                            @foreach ($materias as $materia)
                                <div class="w-full md:w-3/5 text-center p-6 md:p-4 space-y-2 box-border border-2">
                                    <a href="{{ route('alumno.materias.show', $materia) }}"
                                    class="text-xl text-indigo-600 font-bold">{{ $materia->nombre }}
                                        <div class="text-center pt-2 pb-4 block">
                                            <i class="fas fa-book fa-3x"></i>
                                        </div>
                                    </a>
                                    <div class="flex justify-start space-x-2">
                                        <p class="text-left text-gray-500">{{ $materia->descripcion }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div> --}}

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
