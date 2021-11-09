<!DOCTYPE html>
<html class="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('web::includes.favico')

    <title>XUP | @yield('title', 'Blops Fleet Tool')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @livewireStyles

    @stack('styles')
    <script defer src="https://unpkg.com/alpinejs@3.3.2/dist/cdn.min.js"></script>
    <script type="text/javascript">
        document.addEventListener('alpine:init', function () {
            Alpine.store('sidebar', {
                visible: true,
                windowSize: '',
                get isSidebarVisible() {
                    return this.visible
                },
                toggle() {
                    this.visible = !this.visible
                },
                getWindowSize() {
                    var width = window.innerWidth;
                    if (width < 640)
                        return 'xs'

                    if (width >= 640 && width < 768)
                        return 'sm'

                    if (width >= 768 && width < 1024)
                        return 'md'

                    if (width >= 1024 && width < 1280)
                        return 'lg'

                    if (width >= 1280 && width < 1536)
                        return 'xl'

                    return '2xl'
                },
                setWindowSize() {
                    this.windowSize = this.getWindowSize()
                    if (['xs', 'sm', 'md'].includes(this.windowSize))
                        this.visible = false;

                },

                init() {
                    this.setWindowSize()
                    let _this = this
                    window.addEventListener('resize', () => {
                        this.setWindowSize()
                    });
                }
            })
        })
    </script>
    <script type="text/javascript">
        document.addEventListener('alpine:init', () => {

            //Tooltips
            Alpine.data('tooltip', () => ({
                tooltip: false,
            }))

        })
    </script>

</head>
<body class="overflow-hidden">

<div id="application">
    <div class="h-screen flex {{ $bg_color ?? 'bg-gray-800'}} overflow-hidden bg-opacity-50">

        @includeWhen(auth()->check(), 'web::includes.sidebar.wrapper')
        <div class="w-full transition-all h-screen overflow-auto">

            @includeWhen(auth()->check(), 'web::includes.navbar')
            @includeWhen(!auth()->check(), 'web::includes.navbar-guest')

            <div class="p-4">
                @hasSection('page_heading')
                    <h1 class="fort-bold text-2xl mb-4">
                        @yield('page_heading')
                        <small class="font-light">@yield('page_description')</small>
                    </h1>
                @endif
                @include('web::includes.notifications')

                @yield('before_page')

                @yield('page')

                @yield('after_page')
            </div>

        </div>
    </div>
</div>

@livewireScripts
@livewire('livewire-ui-modal')
<script type="text/javascript" src="{{asset('js/pusher.js')}}" defer></script>
@stack('alpinejs')
@stack('scripts')


</body>
</html>