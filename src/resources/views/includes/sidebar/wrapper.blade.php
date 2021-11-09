<div x-data
     x-show="$store.sidebar.isSidebarVisible"
     x-transition:enter="transition duration-300"
     x-transition:enter-start="opacity-0 transform -translate-x-64"
     x-transition:enter-end="opacity-1000 transform translate-x-0"
     x-transition:leave="transition duration-300"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform -translate-x-64"
     class="w-64 h-full z-50 x-50 absolute lg:relative xl:relative 2xl:relative h-screen">

    <div class="h-full bg-gray-900 lg:bg-opacity-50">
        <div class="h-full w-64 flex flex-col">
            @include('web::includes.sidebar.sidebar')
            @if(env('APP_ENV') != 'production')
                <div class="mt-auto text-center text-sm text-white">
                    This page took {{ round((microtime(true) - LARAVEL_START), 2) }} seconds to render
                </div>
            @endif
        </div>

    </div>
    @include('web::includes.sidebar.sidebar')

</div>

