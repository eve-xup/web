@if(session('success'))
    <div class="w-full p-4 rounded-md bg-green-500 border-l-4 border-green-900 flex justify-between mb-4">
        <div class="text-green-100 flex">
            @svg('heroicon-o-check', 'h-6 w-6 text-green-100')
            <span>{{ session('success') }}</span>
        </div>

        <buton onclick="this.parentElement.remove()"> @svg('heroicon-o-x', 'w-6 h-6 text-red-100 cursor-pointer')</buton>
    </div>
@endif

@if(session('error'))
    <div class="w-full p-4 rounded-md bg-red-500 border-l-4 border-red-900 flex justify-between mb-4">
        <div class="text-red-100 flex">
            @svg('heroicon-o-exclamation', 'h-6 w-6 text-red-100')
            <span>{!! session('error') !!}</span>
        </div>

        <buton onclick="this.parentElement.remove()"> @svg('heroicon-o-x', 'w-6 h-6 text-red-100 cursor-pointer')</buton>
    </div>
@endif