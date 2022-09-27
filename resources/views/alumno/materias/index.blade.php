<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis materias
            </h2> --}}
            @role('Alumno')
            <livewire:exp-bar>
            @endrole
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
                <p class="text-center text-2xl text-indigo-600">Mis Materias</p>
                <div class="py-4 bg-white">
                    {{-- ------------------------------------------------- --}}
                    <section>
                        <div class="grid grid-cols-3 max-w-6xl mx-auto px-5 py-8">

                            @foreach ($materias as $materia)


                                <div class="flex flex-wrap -m-4">
                                        <div class="text-center border border-gray-300 p-6 m-2 rounded-lg">
                                            <a href="{{ route('alumno.materias.show', $materia) }}"
                                                class="text-xl text-indigo-600 font-bold">{{ $materia->nombre }}
                                                <div
                                                    class="w-full inline-flex items-center justify-center text-indigo-500 pb-4">
                                                    <i class="fas fa-book fa-3x"></i>
                                                </div>
                                            </a>
                                            <p class="leading-relaxed text-base text-gray-600">
                                                {{ $materia->descripcion }}</p>
                                        </div>

                            @endforeach

                        </div>
                    </section>


                </div>

            </div>
        </div>
    </div>

</x-app-layout>
