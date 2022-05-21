@extends('theme-store::web.layouts.main')

@section('title', 'Theme X')

@push('styles')
    {{-- Store Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/landing.min.css') }}" />
@endpush

@section('content')
    <!-- Main Content -->
    <main>
        {{-- Search Bar --}}
        @include('theme-store::web.components.common.search-bar')

        {{-- Content --}}
        <section class="container container-fulid">
            @foreach ($themes as $theme)
                @include('theme-store::web.components.theme.theme-card')
            @endforeach
        </section>

        {{-- Pagination Nav --}}
        @include('theme-store::web.components.common.pagination', [
            'paginator' => $themes,
            'elements' => $themes,
        ])
    </main>
@endsection

@section('scripts')

@endsection
