@extends("web::layouts.app")

@section('page')


    <div class="flex w-full {{ $spacing ?? 'space-x-4' }}">

        <div class="w-12 lg:w-3/12">
            @yield('left')
        </div>
        <div class="w-12 lg:w-6/12">
            @yield('middle')
        </div>
        <div class="w-12 lg:w-3/12">
            @yield('right')
        </div>


    </div>


@stop
