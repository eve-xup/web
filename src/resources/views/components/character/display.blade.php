@props(['character'=>null, 'size'=>null])

@if(!is_null($character))
    <div class="w-full flex items-center">
        <x-xup-character.avatar :character="$character" ></x-xup-character.avatar>
        <div class="w-full flex flex-col justify-center text-sm">
            <p>{{ $character->name }}</p>
            <p>Corp Names</p>
        </div>
    </div>
@endif
