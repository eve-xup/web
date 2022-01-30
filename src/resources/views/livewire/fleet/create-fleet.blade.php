<div>
    <x-xup-form-group label="Character Search" name="filter" :border="false" labelClass="text-white">
        <x-xup-input name="character_search" placeholder="Filter Characters"
                 wire:model.debounce.500ms="character_search"></x-xup-input>
    </x-xup-form-group>

    <h2 class="text-white pb-2">Choose your fleet boss</h2>

    <ul class="bg-white w-full rounded shadow-md max-h-72 overflow-y-auto">
        @foreach($this->characters as $character)
            <li class="flex space-x-2 p-2 items-center cursor-pointer hover:bg-gray-200 first:rounded-t last:rounded-b
                {{ !is_null($selected_character) && $selected_character->character_id == $character->character_id ? 'bg-gray-300': '' }}"
                wire:click="selectCharacter({{$character->character_id}})">
                <img src="{{$character->getAvatarUrl(64)}}" class="rounded-full shadow"/>
                <div class="flex flex-col space-y-0.5 w-full items-center py-2">
                    <div class="w-full font-bold text-xl">{{$character->name}}</div>
                    <span class="w-full flex items-center space-x-2">
                        @if($character->corporation)
                            <img src="{{$character->corporation->getAvatarUrl(32)}}" class="w-4 h-4 rounded">
                            {{$character->corporation->name}}
                        @endif</span>
                </div>
            </li>
        @endforeach
    </ul>




    <div class="flex w-full flex-col p-2 mt-2 bg-gray-600 rounded shadow">
        <div wire:loading.delay>
            <div class="flex w-full justify-center p-2">

                @svg('heroicon-o-refresh', 'h-5 w-5 animate-spin text-white')
            </div>
        </div>

        @if(!is_null($selected_character))

            <div wire:loading.remove>
                @if(is_null($fleet_id))

                    <div class="text-xl font-bold text-gray-200">{{ $selected_character->name }} is not a fleet boss
                    </div>
                    <div class="text-sm text-gray-100">To create a fleet, please select the current fleet boss from your
                        characters
                    </div>

                @else
                    <form class="flex flex-col" wire:submit.prevent="CreateFleet">
                        @CSRF
                        <input type="hidden" value="{{$selected_character->character_id}}">

                        <x-xup-form-group label="Fleet Title" name="title" class="w-full text-gray-200">
                            <x-xup-input name="title"
                                     placeholder="Fleet Title"
                                     autocomplete="off"
                                     wire:model.debounce.500ms="title"></x-xup-input>
                        </x-xup-form-group>

                        <button type="submit" wire:loading.attr="disabled" class="ml-auto rounded bg-cyan-800 text-white shadow hover:bg-cyan-700 active:bg-cyan-900 px-4 py-2">
                            Create Fleet
                        </button>
                    </form>
                @endif
            </div>
        @else
            <div class="text-xl text-gray-200">
                Select your character who is the current fleet boss
            </div>
        @endif
    </div>
</div>
