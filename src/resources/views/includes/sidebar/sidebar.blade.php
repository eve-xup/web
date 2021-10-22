<div class="flex flex-col">
    <div class="h-16 border-b-2 flex flex-row justify-center items-center px-4 text-center">
        <div class="w-full text-white text-center font-bold text-lg tracking-wider ">
            {{config('app.name')}}
        </div>
    </div>



@include('web::includes.sidebar.characters')


@foreach($menu as $group => $entries)

    <div class="px-2">
        @if(trim($group) !== '')
            <div class="text-indigo-400 uppercase font-bold tracking-wide px-2 py-1">
                {{ $group }}
            </div>
        @endif
        <ul class="mt-1 list-none">

            @foreach($entries as $main)
                @include('web::includes.sidebar.menu', ['item' => $main])
            @endforeach
        </ul>
    </div>


@endforeach



</div>