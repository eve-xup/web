@props(['labelLeft'=>false, 'label'=>'', 'labelClass'=>''])

<div class="form-check">

     @if(!empty($label) && $labelLeft)
        <label @class(['form-check-label inline-block text-gray-800', $labelClass])>{{$label}}</label>
    @endif

    <input
        {{ $attributes->merge(['class'=> 'form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer']) }} class=""
        type="checkbox">

     @if(!empty($label) && !$labelLeft)
        <label @class(['form-check-label inline-block text-gray-800', $labelClass])>{{$label}}</label>
    @endif
</div>

