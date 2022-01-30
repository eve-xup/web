<x-xup-card class="bg-gray-600">

    <div class="p-2 border-b-2 flex">
        <h1 class="text-xl font-bold text-gray-200">Fleet Information</h1>
        <button class="rounded p-2 ml-auto border" wire:click="syncFleet">
            <x-heroicon-s-refresh class="w-4 h-4 {{ $fleetSyncing ? 'animate-spin':'' }}"></x-heroicon-s-refresh>
        </button>

    </div>

    <div class="p-2">

        <x-xup-text-field label="Fleet Name" inline wire:model="fleet.title" name="fleet.title"></x-xup-text-field>


         <x-xup-form-group label="Invite Mode" inline>
            <x-xup-select name="fleet.invite_mode" wire:model="fleet.invite_mode" :options="\Xup\Core\Models\Fleets\Fleet::InviteTypes"/>
        </x-xup-form-group>

        <x-xup-form-group label="Fleet Move" inline name="fleet.free_move">
            <x-xup-checkbox wire:model="fleet.is_free_move" class="ml-auto" label-left></x-xup-checkbox>
        </x-xup-form-group>



        <x-xup-form-group label="Kick Unknown Invites" inline>
            <x-slot name="description">
                Kicks people from fleet who have not joined through XUP.
            </x-slot>

            <x-xup-checkbox name="fleet.kick_unregistered" wire:model="fleet.kick_unregistered"></x-xup-checkbox>
        </x-xup-form-group>

        <div class="w-full flex">
            <x-xup-buttons.primary class="ml-auto"
                                   wire:loading.attr="disabled"
                                   wire:click="updateFleet">
                Update Fleet
            </x-xup-buttons.primary>
        </div>
    </div>

</x-xup-card>

