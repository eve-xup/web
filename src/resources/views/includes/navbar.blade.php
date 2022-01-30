<div class="relative bg-gray-400 text-gray-600 h-12 shadow-md px-4 md:px-6 z-10 flex items-center sticky top-0">
    <button x-data @click="$store.sidebar.toggle()" class="mr-2">
        {{ svg('heroicon-o-menu', 'h-6 w-6') }}
    </button>

    @hasSection('page_title')
        @yield('page_title')
    @endif
</div>
