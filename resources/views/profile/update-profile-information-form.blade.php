<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Información de perfil') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actualiza la información de tu perfil') }}
    </x-slot>

    <x-slot name="form">
         <!-- Cedula -->
         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cedula" value="{{ __('Cedula') }}" />
            <x-jet-input id="cedula" type="text" class="mt-1 block w-full" wire:model.defer="state.cedula" autocomplete="cedula" />
            <x-jet-input-error for="cedula" class="mt-2" />
        </div>

        <!-- Nombres -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nombres" value="{{ __('Nombres') }}" />
            <x-jet-input id="nombres" type="text" class="mt-1 block w-full" wire:model.defer="state.nombres" autocomplete="nombres" />
            <x-jet-input-error for="nombres" class="mt-2" />
        </div>

         <!-- Apellidos -->
         <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="apellidos" value="{{ __('Apellidos') }}" />
            <x-jet-input id="apellidos" type="text" class="mt-1 block w-full" wire:model.defer="state.apellidos" autocomplete="apellidos" />
            <x-jet-input-error for="apellidos" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Correo eléctronico') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Guardado.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Guardar') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
