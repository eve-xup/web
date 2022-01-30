@extends("xup::layouts.app")

@section('page')


    <div class="flex flex-col lg:flex-row w-full {{ $spacing ?? 'lg:space-x-4' }}">

        <div class="w-full lg:w-4/12">
            @yield('left')
        </div>

        <div class="w-full lg:w-8/12">
            @yield('right')
        </div>


    </div>


@stop
