<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset($pathBuildCssJs .'/'.'vendor.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ asset($pathBuildCssJs .'/'.'app.css?9') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $seo['title'] ?? 'Менеджер задач' }}</title>
</head>
<body>
    <div id="vue-app">
        @include('parts.debug-size-screen')

        @auth
            @include('parts.menu')
        @endauth

        <div class="wrapper">
            @auth
                @if($showSidebar ?? true)
                    <nav class="sidebar">
                        @include('parts.sidebar')
                    </nav>
                @endif

                <main>
                    @yield('content')
                </main>
            @endauth

            @guest
                 @yield('content')
            @endguest
        </div>

        @auth
            @include('parts.footer')
        @endauth
    </div>

    <script src="{{ asset($pathBuildCssJs .'/'.'manifest.js')}}"></script>
    <script src="{{ asset($pathBuildCssJs .'/'.'vendor.js')}}"></script>
    <script src="{{ asset($pathBuildCssJs .'/'.'app.js?7')}}"></script>
</body>
</html>
