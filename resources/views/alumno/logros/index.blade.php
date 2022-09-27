<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Logros
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
                <div class="w-full bg-white">
                    @if (session('alerta'))
                        <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800"
                            role="alert">
                            <span class="font-medium">Atención!</span> {{ session('alerta') }}
                        </div>
                    @endif
                    @if (session('mensaje'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800"
                            role="alert">
                            <span class="font-medium">Success alert!</span> {{ session('mensaje') }}
                        </div>
                    @endif

                    <p class="text-center text-2xl text-indigo-600">¡Sigue presentando tus tareas y acumula nuevos
                        logros!</p>
                    {{-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
                    <p class="pl-8 py-4 text-left text-xl text-green-500">Logros Desbloqueados</p>

                    <section>

                        @if ($unlocks->isEmpty())
                            <div class="text-center border border-gray-300 p-2 m-2 rounded-lg">
                                <p class="text-xl text-yellow-300 underline decoration-2">Aún no tienes logros!</p>
                            </div>
                        @else
                            <div class="grid md:grid-cols-2 sm:grid-cols-1  mx-auto px-5 py-2">
                                @foreach ($unlocks as $unlock)
                                    <div class="text-center border border-gray-300 p-2 m-2 rounded-lg">
                                        <a href="#" class="text-xl text-indigo-600 font-bold">
                                            <div
                                                class="w-20 h-20 inline-flex items-center justify-center text-indigo-500">
                                                <img src="{{ Storage::url($unlock->image->url) }}"
                                                    class="rounded-full w-full">
                                            </div>
                                        </a>
                                        <p class="text-2xl text-gray-800">{{ $unlock->nombre }}</p>
                                        {{-- <p class="text-md text-gray-600">Tipo</p> --}}
                                        <p class="text-md text-gray-500">{{ $unlock->descripcion }}</p>
                                        <p class="text-sm text-gray-300">Puntos Necesarios: {{ $unlock->exp_req }}</p>
                                        @switch($unlock->tipo)
                                            @case(0)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-gray-200 rounded-full">
                                                    Basico
                                                </span>
                                            @break

                                            @case(1)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-gray-500 rounded-full">
                                                    Regular
                                                </span>
                                            @break

                                            @case(2)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-yellow-300  rounded-full">
                                                    Normal
                                                </span>
                                            @break

                                            @case(3)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-blue-100 rounded-full">
                                                    Bueno
                                                </span>
                                            @break

                                            @case(4)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-green-100 rounded-full">
                                                    Muy bueno
                                                </span>
                                            @break

                                            @case(5)
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-indigo-500 rounded-full">
                                                    Excelente
                                                </span>
                                            @break
                                        @endswitch
                                    </div>
                                @endforeach
                            </div>
                        @endif



                    </section>
                    {{-- -------------------------------------------------------------------------------------------------------------------------------------------------------------------------- --}}
                    <p class="pl-8 py-4 text-left text-xl text-red-500">Logros Bloqueados</p>
                    <section>

                        <div class="grid md:grid-cols-2 sm:grid-cols-1  mx-auto px-5 py-2">

                            @foreach ($logros as $logro)
                                <div class="text-center border border-gray-300 p-2 m-2 rounded-lg">
                                    <a class="text-xl text-indigo-600 font-bold">
                                        <div class="inline-flex items-center justify-center text-indigo-500">
                                            <img src="{{ Storage::url($logro->image->url) }}"
                                                class="w-20 h-20 rounded-full">
                                        </div>
                                    </a>
                                    <p class="text-2xl text-gray-800">{{ $logro->nombre }}</p>
                                    {{-- <p class="text-md text-gray-600">Tipo</p> --}}
                                    <p class="text-md text-gray-500">{{ $logro->descripcion }}</p>
                                    <p class="text-sm text-gray-300">Puntos Necesarios: {{ $logro->exp_req }}</p>
                                    @switch($logro->tipo)
                                        @case(0)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-gray-200 rounded-full">
                                                Basico
                                            </span>
                                        @break

                                        @case(1)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-gray-500 rounded-full">
                                                Regular
                                            </span>
                                        @break

                                        @case(2)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-yellow-300  rounded-full">
                                                Normal
                                            </span>
                                        @break

                                        @case(3)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-blue-100 rounded-full">
                                                Bueno
                                            </span>
                                        @break

                                        @case(4)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-green-100 rounded-full">
                                                Muy bueno
                                            </span>
                                        @break

                                        @case(5)
                                            <span
                                                class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-indigo-500 rounded-full">
                                                Excelente
                                            </span>
                                        @break
                                    @endswitch

                                    {!! Form::open(['method' => 'POST', 'route' => ['alumno.materias.store', 'logro_id' => $logro->id]]) !!}
                                    <button type="submit"
                                    class="mt-4 text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Desbloquear
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            @endforeach


                    </section>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
