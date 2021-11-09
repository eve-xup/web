@extends("web::layouts.app")

@section('page')


    <div class="flex w-full {{ $spacing ?? 'lg:space-x-4' }} flex-col lg:flex-row">

        <div class="w-full lg:w-4/12">
            @yield('left')
        </div>

        <div class="w-full lg:w-8/12">
            @yield('right')
        </div>


    </div>


@stop
