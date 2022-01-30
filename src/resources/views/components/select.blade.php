@props(['options' => [], 'valueField'=>'value', 'textField'=>'text'])


<select {{$attributes->merge(['class'=>'w-full px-3 py-1 rounded'])}} >

    @foreach($options as $option)
        <option value="{{ data_get($option, $valueField) }}">{{ data_get($option, $textField) }}</option>
    @endforeach

</select>
