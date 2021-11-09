<div class="space-y-1">
    <x-input wire:model.debounce.500ms="user_search" placeholder="Search Characters"></x-input>

    <div class="lg:space-x-0.5 space-y-1 flex flex-col lg:flex-row">

        <div class="w-full lg:w-6/12 lg:h-full">

            <ul class="rounded-md border bg-gray-300 max-h-64 lg:h-64">
                <li class="px-2 py-1 font-light italic">
                    Available Users
                </li>
                @foreach($this->available_users as $key => $user)
                    <li class="px-4 py-1 hover:bg-sky-600 hover:text-white cursor-pointer flex justify-between items-center"
                        wire:click="add({{$user->getKey()}})"
                    >
                        <div>
                            <div class="w-full">{{$user->main_character->name}}</div>
                            <div class="h-6 flex inline-flex">
                                @foreach($user->characters as $character)
                                    <span class="has-tooltip">
                                    @include('web::partials.character.portrait-tooltip', ['character'=>$character])
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @svg('heroicon-o-arrow-narrow-down', 'w-4 h-4 lg:transform lg:-rotate-90')
                    </li>
                @endforeach
            </ul>

        </div>


        <div class="lg:h-full flex flex-row lg:flex-col lg:h-64 justify-center items-center p-2 text-white space-x-2">
            @svg('heroicon-o-chevron-double-left', 'h-6 w-6')

            @svg('heroicon-o-chevron-double-right', 'h-6 w-6')
        </div>

        <div class="w-full lg:w-6/12 lg:h-full">
            <ul class="rounded-md border bg-gray-300 max-h-64 lg:h-64">
                <li class="px-2 py-1 font-light italic">
                    Users with the role
                </li>
                @foreach($this->selected_users_filtered as $key => $user)
                    <li class="px-4 py-1 space-x-4 hover:bg-sky-600 hover:text-white cursor-pointer  flex justify-between items-center flex-row-reverse lg:flex-row"
                        wire:click="remove({{$user->getKey()}})">


                        @svg('heroicon-o-arrow-narrow-up', 'w-4 h-4 lg:transform lg:-rotate-90')
                        <div class="w-full">

                            <div class="w-full">{{$user->main_character->name}}</div>
                            <div class="h-6 flex inline-flex">
                                @foreach($user->characters as $character)
                                    <span class="has-tooltip">
                                    @include('web::partials.character.portrait-tooltip', ['character'=>$character])
                                    </span>
                                @endforeach
                            </div>
                        </div>

                    </li>
                @endforeach
            </ul>
        </div>

    </div>
    <select multiple name="users[]" class="hidden" form="role-form">
        @foreach($this->selected_users as $user)
            <option value="{{$user->getKey()}}" selected></option>
        @endforeach
    </select>
</div>