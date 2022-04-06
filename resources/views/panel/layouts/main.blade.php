<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <title>
        @yield('title') | {{ config('app.name') }}
    </title>

    <link rel="dns-prefetch" href="https://fonts.googleapis.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

    <!-- Roboto Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:200,500,700" rel="stylesheet">

    {{-- Panel Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/store.min.css') }}"/>

    <link href="{{ asset('assets/store/panel/css/chunk-vendors.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/store/panel/css/app.min.css') }}" rel="stylesheet">

    <script defer="defer" type="module" src="{{ asset('assets/store/panel/js/chunk-vendors.js') }}"></script>
    <script defer="defer" type="module" src="{{ asset('assets/store/panel/js/app.js') }}"></script>

    <script defer="defer" src="{{ asset('assets/store/panel/js/chunk-vendors-legacy.js') }}" nomodule></script>
    <script defer="defer" src="{{ asset('assets/store/panel/js/app-legacy.js') }}" nomodule></script>

    <base href="{{ asset('assets/store/panel/./') }}">
</head>

<body>
    {{-- Noscript Warning --}}
    <noscript>
        <strong>
            We're sorry but {{ config('app.name') }} doesn't work properly without JavaScript enabled.
            Please enable it to continue.
        </strong>
    </noscript>

    {{-- App Content --}}
    @yield('content')

    {{-- Scripts --}}
    @yield('scripts')
</body>

</html>
