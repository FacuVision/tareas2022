<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informacion del Perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Foto de Perfil') }}" />
                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    {{-- <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover"> --}}
                    @if (Auth::user()->profile_photo_path)
                        <img class="h-20 w-20 rounded-full object-cover"
                            src="/storage/{{ Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->name }}" />
                    @else
                        <img class="h-20 w-20 rounded-full object-cover" alt="{{$this->user->name}}" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    @endif
                </div>
                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Subir nueva foto') }}
                </x-jet-secondary-button>
                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Quitar Foto') }}
                    </x-jet-secondary-button>
                @endif
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Guardado.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                    {{ __('Guardar') }}
                </x-jet-button>
                <x-jet-input-error for="photo" class="mt-2" />
                @role('Alumno')
                <div class="mt-2">

                    <livewire:exp-bar/>
                </div>
                @endrole


            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="Nombre" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" disabled />
            <x-jet-input-error for="name" class="mt-2" />
        </div>


        <!-- apellidos -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="apellidos" value="Apellidos" />
            <x-jet-input id="apellidos" type="text" class="mt-1 block w-full"
                value="{{ Auth::user()->perfil->apellido }}" disabled />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="Correo electrónico" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email"
                disabled />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        @if (Auth::user()->alumno)
            <!-- Grado y seccion -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="grado" value="Grado" />
                <x-jet-input id="grado" type="text" class="mt-1 block w-full"
                    value="{{ Auth::user()->alumno->seccion->grado->grado }} {{ Auth::user()->alumno->seccion->grado->nivel }}  - {{ Auth::user()->alumno->seccion->nombre }}"
                    disabled />
                <x-jet-input-error for="email" class="mt-2" />
            </div>
        @endif

        <!--  -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="dni" value="DNI" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full"
                value="{{ Auth::user()->perfil->DNI }}" disabled />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!--  -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="Fecha_nac" value="Fecha de Nacimiento" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full"
                value="{{ Auth::user()->perfil->fecha_nac }}" disabled />
            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        {{-- <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button> --}}

    </x-slot>
</x-jet-form-section>
