@extends('theme-store::panel.layouts.main')

@section('title', 'Theme Store Panel')

@section('content')
    <div id="app"></div>
@endsection

@section('scripts')
    <script>
        window.themeStoreApiUrl = '{{ url('/') }}';
    </script>
@endsection
