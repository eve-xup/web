@props([
    'inline'
])

@php
    $wrapperClass = 'mb-3 flex items-center '. (!isset($inline) ? 'flex-col' : '');

    $labelWrapper = 'flex flex-col '. (isset($inline) ? 'w-6/12' : 'w-full');

@endphp

<div class="{{$wrapperClass}}">


    @if($attributes->has('label'))
        <div class="{{ $labelWrapper }}">
            <label class="font-semibold {{$attributes->get('labelClass')}}">{{$attributes->get('label')}}</label>
            @if(isset($description))
                <span class="text-xs text-gray-900">{{$description}}</span>
            @endif
        </div>
    @endif

    <div class="w-full flex flex-col">

        {{ $slot }}
        @error($attributes->get('name'))
        <span class="text-xs text-red-500"> {{ $message }}</span>
        @enderror
    </div>


</div>
