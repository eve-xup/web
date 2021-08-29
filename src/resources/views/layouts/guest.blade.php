<!DOCTYPE html>
<html data-theme="dark">
    <head >
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('web::includes.favico')

        <title>XUP | @yield('title', 'Blops Fleet Tool')</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Tailwind css -->
        <link rel="stylesheet" href="{{ asset('web/css/app.css') }}">

        @stack('styles')

    </head>
    <body >
        <div class="h-full">

            @include('web::includes.navbar-guest')

            @yield('content')

        </div>



        @stack('javascript')
    </body>
</html>