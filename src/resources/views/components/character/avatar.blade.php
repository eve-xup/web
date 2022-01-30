@props(['character'=>null, 'size'=>null])

@if(!is_null($character))
    <img class="rounded-full" src="{{ $character->getAvatarUrl($size ?? 32) }}" alt="{{$character->name}}">
@endif
