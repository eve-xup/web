@props(['label', 'inline'=>false])

<x-xup-form-group :label="$label ?? null" inline>
    <x-xup-input {{ $attributes }}></x-xup-input>
</x-xup-form-group>
