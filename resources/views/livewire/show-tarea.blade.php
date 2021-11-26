<div>
    <x-jet-button class="py-1 px-6" wire:click="showtarea({{ $dato }})">
        VER
    </x-jet-button>

    <x-jet-dialog-modal maxWidth="2xl" wire:model="showtarea">
        <x-slot name="title">
            Tarea {{ $dato->titulo }}
        </x-slot>

        <x-slot name="content">

            <div class="container">
                @php
                    $i = 0;
                    $count = 1;
                @endphp
                @foreach ($dato->actividades as $act)
                    <x-jet-label class="text-left pt-2 pb-2 text-indigo-600" value="Actividad {{ $count }} :" />
                    <p class="pb-2 break-words md:break-all text-left md:text-left">{{ $act->descripcion }}</p>
                    <x-jet-input wire:model.defer="descripcion.{{$act->id}}" name="descripcion[]" class="w-full" type="text">
                    </x-jet-input>

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

            <x-jet-danger-button wire:click="enviar({{$dato}})">
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
            @php
                var_dump($descripcion)
            @endphp

        </x-slot>

        <x-slot name="footer">



        </x-slot>

    </x-jet-dialog-modal> --}}

</div>
