<div class="relative bg-gray-900 bg-opacity-50 text-white h-16 shadow px-4 md:px-6 z-10 flex items-center sticky top-0 border-b-2">
    <button x-data @click="$store.sidebar.toggle()" class="mr-2">
        {{ svg('heroicon-o-menu', 'h-6 w-6') }}
    </button>

    @hasSection('page_title')
        @yield('page_title')
    @endif
</div>