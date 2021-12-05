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
                    <div class="container p-4">
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
                    </div>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
