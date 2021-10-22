<div class="space-y-1">
    <x-input wire:model.debounce.500ms="user_search" placeholder="Search Characters"></x-input>

    <div class="lg:space-x-0.5 space-y-1 flex flex-col lg:flex-row">

        <div class="w-full lg:w-6/12 lg:h-full">


            <ul>
                @foreach($this->available_users as $user)
                    <li>
                        {{$user->main_character->name}}
                    </li>
                @endforeach
            </ul>

        </div>

    </div>
</div>