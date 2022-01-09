<x-app-layout>
    <x-slot name="header">
        <div class="pt-16">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mis Logros
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
                <div class="w-full bg-white">
                    <p class="text-center text-2xl text-indigo-600">¡Sigue presentando tus tareas y acumula nuevos logros!</p>
                    {{-- ------------------------------------------------- --}}
                    <section>
                        <div class="grid grid-cols-3 max-w-6xl mx-auto px-5 py-8">

                            @foreach ($logros as $logro)

                                <div class="flex flex-wrap">
                                    <div class="text-center border border-gray-300 p-6 m-2 rounded-lg">
                                        <a href="#" class="text-xl text-indigo-600 font-bold">
                                            <div
                                                class="w-24 h-24 inline-flex items-center justify-center text-indigo-500 pb-4">
                                                <img src="{{ Storage::url($logro->image->url) }}"
                                                    class="rounded-full w-full">
                                            </div>
                                        </a>
                                        <p class="text-2xl text-gray-800">{{ $logro->nombre }}</p>
                                        {{-- <p class="text-md text-gray-600">Tipo</p> --}}

                                            @switch($logro->tipo)
                                                @case(0)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none bg-gray-200 rounded-full">
                                                        Basico
                                                    </span>
                                                @break
                                                @case(1)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-gray-500 rounded-full">
                                                        Regular
                                                    </span>
                                                @break
                                                @case(2)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-yellow-300  rounded-full">
                                                        Normal
                                                    </span>
                                                @break
                                                @case(3)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-blue-100 rounded-full">
                                                        Bueno
                                                    </span>
                                                @break
                                                @case(4)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold leading-none text-white bg-green-100 rounded-full">
                                                        Muy bueno
                                                    </span>
                                                @break
                                                @case(5)
                                                    <span class="inline-flex items-center justify-center px-2 py-1 mr-2 text-xs font-bold text-white leading-none bg-indigo-500 rounded-full">
                                                        Excelente
                                                    </span>
                                                @break
                                            @endswitch
                                            <p class="text-sm text-gray-400">{{ $logro->descripcion }}</p>
                                    </div>
                                </div>
                            @endforeach


                    </section>

                </div>

            </div>
        </div>
    </div>

</x-app-layout>
