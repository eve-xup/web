<div class="mb-4 flex inline-flex justify-start items-center space-x-2">
    @foreach($menu as $m)
        <a href="{{ route($m['route'], ['role'=>$role]) }}"
           class="px-4 py-2 rounded-md shadow-md border-gray-500 text-white
            @if(route($m['route'], ['role'=>$role]) === request()->getUri())
                   bg-gray-600
                @else
                   bg-sky-800 hover:bg-sky-700 active:bg-sky-900
                @endif
                   "
        >
            {{$m['label']}}
        </a>
    @endforeach
</div>