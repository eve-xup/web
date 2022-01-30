<div class="flex flex-col h-full">
    <div class="h-16 flex flex-row justify-center items-center px-4 text-center">
        <div class="w-full text-white text-center font-bold text-lg tracking-wider ">
            {{config('app.name')}}
        </div>
        <div class="absolute lg:hidden text-white right-0 cursor-pointer" @click="$store.sidebar.toggle()" class="mr-2">
            @svg('heroicon-o-x', 'w-4 h-4')
        </div>
    </div>



@include('xup::includes.sidebar.characters')


@foreach($menu as $group => $entries)

    <div class="px-2">
        @if(trim($group) !== '')
            <div class="text-indigo-400 uppercase font-bold tracking-wide px-2 py-1">
                {{ $group }}
            </div>
        @endif
        <ul class="mt-1 list-none">

            @foreach($entries as $main)
                @include('xup::includes.sidebar.menu', ['item' => $main])
            @endforeach
        </ul>
    </div>


@endforeach

<div class="px-2 mt-auto">
    <ul class="mt-1 list-none">
        <li class="relative text-gray-200 hover:bg-gray-700 hover:text-white cursor-pointer rounded-lg my-0.5">
            <a href="{{route('auth.logout')}}" class="flex justify-start items-center px-2 py-2 rounded-lg">
                @svg('heroicon-o-logout', 'w-4 h-4')
                <span class="px-2">Logout</span>
            </a>
        </li>
    </ul>
</div>

</div>
