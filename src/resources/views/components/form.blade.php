@props(['method'=>'POST'])
<form {{$attributes}} @if($method=='post' || $method == 'get') method="{{$method}}" @else method="post" @endif>
    @CSRF
    @method($method)

    {{ $slot }}
</form>
