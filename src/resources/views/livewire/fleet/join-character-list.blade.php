<div class="p-4 bg-white rounded shadow">
    <div class="w-full flex mb-2">
        <x-xup-buttons.primary class="ml-auto px-3 py-1" wire:click="inviteAll">Invite All</x-xup-buttons.primary>
    </div>
    @foreach($this->availableCharacters as $character)
        <div class="border-b w-full flex items-center">
            <x-xup-character.display :character="$character"></x-xup-character.display>
            <x-xup-buttons.primary class="ml-auto" wire:click="invite_character({{$character->character_id}})">
                Invite
            </x-xup-buttons.primary>
        </div>

    @endforeach

</div>
