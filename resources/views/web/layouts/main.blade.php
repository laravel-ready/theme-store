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

    {{-- Web Store Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/store.min.css') }}" />
</head>

<body>
    <div id="app">
        @include('theme-store::web.components.common.navbar')

        @yield('content')

        @include('theme-store::web.components.common.footer')
    </div>

    <!-- VueJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@latest/dist/vue.min.js"></script>

    @yield('scripts')
</body>

</html>
