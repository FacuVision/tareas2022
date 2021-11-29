<div>
    <x-jet-button class="py-1 px-6" wire:click="showtarea({{ $dato }})">
        VER
    </x-jet-button>

    <x-jet-dialog-modal maxWidth="2xl" wire:model="showtarea">


        <x-slot name="title">
            Tarea {{ $dato->titulo }}
        </x-slot>

        <x-slot name="content">

            <div class="text-left">
                @php
                    $i = 0;
                    $count = 1;
                @endphp
                @foreach ($dato->actividades as $act)
                    <x-jet-label class="text-left pt-2 pb-2 text-indigo-600" value="Actividad {{ $count }} :" />

                    @switch($act->tipo)
                        @case(0)
                            {{-- PREGUNTA CORTA --}}
                            <div class="container text-left pb-2 md:break-all  md:text-left">
                                <p class="break-words">
                                    {{ $act->descripcion }}
                                </p>
                            </div>

                            <p class="text-left text-md text-navy-600  font-bold">Respuesta: </p>
                            <input wire:model.defer="descripcion.{{$act->id}}" name="descripcion[]"
                                class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full"
                                type="text">
                        @break

                        @case(1)
                            {{-- PREGUNTA LARGA --}}
                            <div class="justify-start pb-2 break-words md:break-all text-left md:text-left">
                                <p>
                                    {{ $act->descripcion }}
                                </p>
                            </div>
                            <p class="text-md text-navy-600 font-bold">Respuesta: </p>
                            <textarea required id="editor" wire:model.defer="descripcion.{{ $act->id }}"
                                name="descripcion[]" class="w-full"></textarea>

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
                                <iframe class="absolute inset-0 w-full h-full pb-2" src="{{$link}}"
                                    frameborder="0" …></iframe>
                            </div>
                            <p class="text-md text-navy-600 font-bold">Respuesta: {{$act->id}}</p>
                            <textarea required id="editor" wire:model.defer="descripcion.{{ $act->id }}"
                                name="descripcion[]" class="w-full"></textarea>
                        @break

                        @case(3)
                            {{-- LINK DE CARPETA DE DRIVE --}}
                            <div class="justify-start pb-2 break-words md:break-all text-left md:text-left">
                                <p>
                                    {{ $act->descripcion }}
                                </p>
                            </div>
                            <div class="text-left">

                                <a href="https://drive.google.com/open?id=1Q9yjO_myAgokh0I1yqiHg0QAzqHu_YQQ&authuser=emmanuelgarayar%40gmail.com&usp=drive_fs
                                " target="_blank" class="text-xl text-indigo-600 font-bold">
                                    <div class="pb-6 block">
                                        <i class="text-center fab fa-google-drive fa-2x"></i>
                                        Abrir en drive
                                    </div>

                                </a>
                            </div>
                        @break

                    @endswitch


                    @php
                        $i++;
                        $count++;
                    @endphp
                @endforeach

            </div>

        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('showtarea',false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="enviar({{ $dato }})">
                Responder
            </x-jet-danger-button>
            {{-- <x-jet-danger-button wire:click="show({{$dato}})">
                Responder
            </x-jet-danger-button> --}}

        </x-slot>

    </x-jet-dialog-modal>

    {{-- <x-jet-dialog-modal maxWidth="2xl" wire:model="show">
        <x-slot name="title">

        </x-slot>

        <x-slot name="content">
            @if($validado)
                {{count($validado["descripcion"])}}
            @endif

        </x-slot>

        <x-slot name="footer">



        </x-slot>

    </x-jet-dialog-modal> --}}

</div>
