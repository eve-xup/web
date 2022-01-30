<div class="w-full flex space-x-2">

    <div class="w-1/2 rounded bg-gray-600 shadow">
        <div class="p-2 border-b-2 flex">
            <h1 class="text-xl font-bold text-gray-200">Fleet Information</h1>

            <button class="w-6 h-6 rounded">

            </button>
        </div>

        <div class="p-2">

            <x-xup-form-group label="Fleet Name" name="fleet[title]" inline no-border>
                <x-xup-input name="fleet[title]" value="{{$fleet->title}}"></x-xup-input>
            </x-xup-form-group>


            <x-xup-form-group label="Fleet Move" inline>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" id="toggle"
                           class="peer absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer
                               checked:right-0 checked:border-green-400"
                    />
                    <label for="toggle"
                           class="block block-overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer peer-checked:bg-green-400"
                    ></label>
                </div>
            </x-xup-form-group>

            <x-xup-form-group label="Invite Mode" inline>
                <x-xup-select name="fleet[invite_mode]" :options="\Xup\Core\Models\Fleets\Fleet::InviteTypes" />
            </x-xup-form-group>

        </div>


    </div>
    <div class="w-1/2 rounded bg-gray-600 shadow">

    </div>


</div>
