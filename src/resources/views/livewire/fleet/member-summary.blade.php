<x-xup-card class="bg-gray-600 p-2">

    <div class="px-4 py-2 border-b border-white flex w-full">
        <p class="text-xl text-white">Fleet Members</p>
        <button class="rounded p-2 ml-auto border" wire:click="clearNonInvites">
            <x-heroicon-s-refresh class="w-4 h-4"></x-heroicon-s-refresh>
        </button>
    </div>

    <div class="p-1 bg-white rounded">


        @foreach($this->members as $member)
            <div class="flex w-full items-center">
                <x-xup-character.display :character="$member->character"></x-xup-character.display>
                @if(!auth()->user()->characters->pluck('character_id')->contains($member->character_id))
                    <button class="px-4 py-1 rounded shadow bg-red-700 text-white" wire:click="kickMember({{$member->character_id}})">
                        Kick
                    </button>
                @endif
            </div>
        @endforeach
    </div>

</x-xup-card>
