<div class="flex flex-col items-center w-full p-4 isolate ">

    <div class="w-24 h-24 flex">
        <img src="{{ $user->main_character->getAvatarUrl(128) }}" class="w-full h-full rounded-full"/>
    </div>
    <div class="flex flex-col items-center justify-center w-full mt-1">
        <div class="w-full whitespace-nowrap text-white font-bold overflow-ellipsis overflow-hidden text-center leading-normal font-medium">
            {{ $user->main_character->name }}
        </div>
    </div>

    <div class="relative flex inline-flex flex-wrap justify-items-start">
        @foreach($user->characters as $character)
            @if($user->main_character->getKey() != $character->getKey())
                <a href="{{ route('user.set.main', ['character'=>$character]) }}" class="rounded-full m-1 has-tooltip">
                        <span class="tooltip rounded p-1 px-2 shadow-lg bg-black text-white -mt-7 text-center ">
                            {{ $character->name }}
                        </span>
                    <img class="rounded-full" src="{{ $character->getAvatarUrl(32) }}" alt="{{$character->name}}">
                </a>
            @endif
        @endforeach
        <a href="{{ route('auth.public.redirect') }}" class="bg-gray-500 rounded-full m-1 has-tooltip">
            <span class="tooltip rounded shadow-lg p-1 px-2 bg-black text-white -mt-7 text-center">
                            Add Character
                        </span>
            @svg('heroicon-o-plus', 'rounded-full w-8')
        </a>
    </div>

</div>

