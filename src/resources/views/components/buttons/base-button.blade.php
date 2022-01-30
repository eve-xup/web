@props(['href', 'dense'=>false])

@if(isset($href))
    <a :herf="$href" {{ $attributes->merge(['class'=>'px-4 py-2 rounded']) }}>
        {{ $slot }}
    </a>
@else
    <button  {{ $attributes->merge(['class'=>'px-4 py-2 rounded']) }}>
        {{ $slot }}
    </button>
@endif
