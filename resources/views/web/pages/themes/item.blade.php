@extends('theme-store::web.layouts.main')

@section('title', $theme->name)

@push('styles')
    {{-- Theme Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/theme.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.theme.preview-hero')

    {{-- Related Themes Section --}}
    <section class="related-themes">
        {{-- Section Title --}}
        @include(
            'theme-store::web.components.common.section-title-bar',
            [
                'useThemeColor' => true,
                'topLine' => true,
                'bottomLine' => true,
                'title' => 'Related Themes',
                'message' => 'Related themes with in the same category',
            ]
        )

        <div class="store-card-container">
            @foreach ($relatedThemes as $theme)
                @include('theme-store::web.components.theme.theme-card')
            @endforeach
        </div>

        @if ($theme->categories && $relatedThemesTotalCount > $relatedThemes->count())
            <div class="store-card-container-item">
                <!-- View All -->
                <a class="view-all"
                    href="{{ route('theme-store.web.categories.show', ['category' => $theme->categories->first()->slug]) }}">
                    View All

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z" />
                    </svg>
                </a>
            </div>
        @endif
    </section>
@endsection
