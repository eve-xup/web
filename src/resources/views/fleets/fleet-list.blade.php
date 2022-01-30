<x-xup-card class="bg-gray-600">
    <div class="px-4 py-2 border-b border-white">
        <h1 class="text-xl text-white font-bold">Open Fleets</h1>
    </div>
    <div class="p-4">
        @foreach($fleets as $fleet)
            <div class="border-b w-full flex items-center">
                <div class="flex flex-col">
                    <p class="font-bold">{{ $fleet->title }}</p>
                    <p>with: {{$fleet->fleet_boss->name}}</p>
                </div>
                <x-xup::link.primary href="{{ route('xup.fleet.join', ['fleet'=>$fleet]) }}" class="ml-auto">
                    Join
                </x-xup::link.primary>
            </div>
        @endforeach
    </div>

</x-xup-card>
