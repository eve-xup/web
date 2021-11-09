<div
        x-data="menuItem('{{request()->route()->getName()}}', {{collect(\Illuminate\Support\Arr::get($main, 'entries', []))->toJson()}})"
        class="pr-2" x-cloak>

    <li class="relative text-gray-200 hover:bg-gray-700 hover:text-white cursor-pointer rounded-lg my-0.5">
        <a @if(isset($main['route']))
           href="{{route($main['route'])}}"
           @elseif(isset($main['entries']))
           @click="toggle"
           @endif class="flex justify-start items-center px-2 py-2 rounded-lg">

            @if(isset($main['icon']))
                @svg($main['icon'], 'w-4 h-4')
            @else
                <div class="w-4 h-4"></div>
            @endif


            <span class="px-2">
                {{$main['label']}}
            </span>
            @if(isset($main['entries']))
                <span class="transition-transform transform ml-auto" :class="open ? 'rotate-90' : ''">@svg('heroicon-o-chevron-right', 'w-4 h-4')</span>
            @endif
        </a>

    </li>
    @if(isset($main['entries']) && is_array($main['entries']))
        <ul class="" x-show="open"
            x-transition:enter="transition duration-300"
            x-transition:enter-start="opacity-0 transform origin-top scale-y-0"
            x-transition:enter-end="opacity-1000 transform origin-top -scale-y-64"
            x-transition:leave="transition duration-300"
            x-transition:leave-start="opacity-100 transform origin-top -scale-y-64"
            x-transition:leave-end="opacity-0 transform origin-top scale-y-0"
        >
            @foreach($main['entries'] as $entry)
                @if(array_key_exists('permissions', $entry))
                    @canany($entry['permissions'])
                        <li class="relative  cursor-pointer pl-4 rounded-lg my-0.5 text-gray-200 hover:bg-gray-700 ">
                            <a href="{{ route($entry['route']) }}" class="flex justify-start items-center rounded-lg  hover:text-white px-2 py-2 ">
                                @if(isset($entry['icon']))
                                    @svg($entry['icon'], 'w-4 h-4')
                                @else
                                    <div class="w-4 h-4"></div>
                                @endif
                                <span class="px-2">{{$entry['label']}}</span>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="relative  cursor-pointer pl-4 px-2 py-2 rounded-lg my-0.5 text-gray-200 hover:bg-gray-700 ">
                        <a href="{{ route($entry['route']) }}" class="flex justify-start items-center hover:text-white">
                            @if(isset($entry['icon']))
                                @svg($entry['icon'], 'w-4 h-4')
                            @else
                                <div class="w-4 h-4"></div>
                            @endif
                            <span class="px-2">{{$entry['label']}}</span>
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>


    @endif

</div>

@once
    @push('alpinejs')
        <script type="text/javascript">
            document.addEventListener('alpine:init', () => {
                Alpine.data('menuItem', (currentUrl, entries) => ({
                    currentRoute: currentUrl,
                    entries: entries,
                    open: false,
                    get isOpen() {
                        return this.open
                    },
                    toggle() {
                        this.open = !this.open
                    },
                    init() {
                        this.entries.forEach(entry => {
                            if (entry.route === this.currentRoute) {
                                this.open = true
                            }
                        })
                    }
                }))
            })
        </script>
    @endpush
@endonce

