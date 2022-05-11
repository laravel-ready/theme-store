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

    @stack('styles')
</head>

<body>
    <div id="app">
        @include('theme-store::web.components.common.navbar')

        <div class="page-content">
            @yield('content')
        </div>
    </div>

    <!-- VueJS -->
    <script src="https://cdn.jsdelivr.net/npm/vue@latest/dist/vue.min.js"></script>

    @yield('scripts')
</body>

</html>
