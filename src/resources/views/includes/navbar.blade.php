<div class="navbar shadow-lg bg-neutral text-neutral-content">

    <div class="flex-1 px-2 mx-2 justify-between">
        <span class="text-lg font-bold">
            XUP | @yield('heading', 'Blops fleet helper tool')
        </span>
    </div>

    <div class="flex-none">
        <div class="avatar">
            <div class="rounded-full w-10 h-10 m-1">
                <img src="{{ $user->main_character->getAvatarUrl(64) }}" />
            </div>
        </div>
    </div>
</div>
