<span class="flex tooltip rounded p-1 px-2 shadow-lg bg-black text-white -mt-7 text-center ">{{ $character->name }}</span>
<img class="rounded-full" src="{{ $character->getAvatarUrl($size ?? 32) }}" alt="{{$character->name}}">
