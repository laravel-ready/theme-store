@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    {{-- Category Pages Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/category.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.common.hero-section', [
        'title' => $category->name,
        'message' => $category->description,
    ])

    {{-- Related Themes Section --}}
    <section class="related-themes">
        {{-- Section Title --}}
        @include(
            'theme-store::web.components.common.section-title-bar',
            [
                'useThemeColor' => true,
                'topLine' => true,
                'bottomLine' => true,
                'title' => 'Themes',
            ]
        )

        {{-- TODO: Add no results message --}}

        <div class="store-card-container">
            @foreach ($themes as $theme)
                @include('theme-store::web.components.theme.theme-card')
            @endforeach
        </div>

        {{-- Pagination Nav --}}
        @include('theme-store::web.components.common.pagination', [
            'paginator' => $themes,
            'elements' => $themes,
        ])
    </section>
@endsection
