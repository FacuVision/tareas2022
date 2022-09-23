<div>
    <x-jet-button class="py-1 px-2" onclick="visto({{$dato->id}})" wire:click="showtarea({{ $dato }})">
        Responder
    </x-jet-button>

    <x-jet-dialog-modal maxWidth="2xl" wire:model="showtarea">


        <x-slot name="title">
            Tarea {{ $dato->titulo }}
        </x-slot>

        <x-slot name="content">
            {{--  --}}
            <div class="text-left">
                {{--  --}}
                @php
                    //$i = 0;
                    $count = 1;
                @endphp
                <form wire:submit.prevent="enviar">
                    {{-- <form wire:submit.prevent="show"> --}}
                    @foreach ($dato->actividades as $act)
                        <x-jet-label class="text-left pt-2 pb-2 text-indigo-600"
                            value="Actividad {{ $count }} :" />

                        @switch($act->tipo)
                            @case(0)
                                {{-- PREGUNTA CORTA --}}
                                <div class="overflow-auto break-words text-left pb-2 md:break-all  md:text-left">
                                    <p>
                                        {{ $act->descripcion }}
                                    </p>
                                </div>

                                <p class="text-left text-md text-navy-600  font-bold">Respuesta: </p>
                                <input required wire:model.defer="descripcion.{{ $act->id }}" name="descripcion[]"
                                    class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                    type="text" placeholder="Respuesta">
                            @break

                            @case(1)
                                {{-- PREGUNTA LARGA --}}
                                <div
                                    class="overflow-auto justify-start pb-2 break-words md:break-all text-left md:text-left">
                                    <p>
                                        {{ $act->descripcion }}
                                    </p>
                                </div>
                                <p class="text-md text-navy-600 font-bold">Respuesta: </p>
                                <textarea required id="editor" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full w-full" wire:model.defer="descripcion.{{ $act->id }}"
                                    name="descripcion[]" class="w-full" placeholder="Respuesta">

                                        </textarea>

                            @break

                            @case(2)
                                {{-- LINK DE VIDEO --}}
                                @php
                                    $link = preg_replace('/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i', " https://www.youtube.com/embed/$2", $act->recurso);
                                @endphp
                                <div class="justify-start pb-2 break-words md:break-all text-left md:text-left">
                                    <p>
                                        {{ $act->descripcion }}
                                    </p>
                                </div>
                                <div class="relative" style="padding-top: 56.25%">
                                    <iframe class="absolute inset-0 w-full h-full pb-2" src="{{ $link }}"
                                        frameborder="0" …></iframe>
                                </div>
                                <p class="text-md text-navy-600 font-bold">Respuesta:</p>
                                <textarea required id="editor" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full w-full" wire:model.defer="descripcion.{{ $act->id }}"
                                    name="descripcion[]" class="w-full" placeholder="Respuesta"></textarea>
                            @break

                            @case(3)
                                {{-- LINK DE CARPETA DE DRIVE --}}
                                <div class="justify-start pb-2 break-words md:break-all text-left md:text-left">
                                    <p>
                                        {{ $act->descripcion }}
                                    </p>
                                </div>
                                <div class="text-left">

                                    <a href="{{ $act->recurso }}" target="_blank"
                                        class="text-xl text-indigo-600 font-bold">
                                        <div class="pb-6 block">
                                            <i class="text-center fab fa-google-drive fa-2x"></i>
                                            Abrir en drive
                                        </div>

                                    </a>
                                    <input required wire:model.defer="descripcion.{{ $act->id }}" name="descripcion[]"
                                        class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                        type="text" placeholder="¿Realizo lo encomendado? (Si / No)">
                                </div>
                            @break

                        @endswitch


                        @php

                            $count++;
                        @endphp
                    @endforeach

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$toggle('showtarea')">
                Cancelar
            </x-jet-secondary-button>


            <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition">
                ENVIAR
            </button>



        </x-slot>
        </form>
    </x-jet-dialog-modal>

    <x-jet-dialog-modal maxWidth='2xl' wire:model='show'>
        <x-slot name="title">

        </x-slot>
        <x-slot name="content">
            @foreach ($descripcion as $desc)
                {{ $desc }}
            @endforeach
        </x-slot>
        <x-slot name="footer">

        </x-slot>
    </x-jet-dialog-modal>

</div>
