@extends('theme-store::web.layouts.main')

@section('title', $theme->name)

@push('styles')
    {{-- Theme Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/theme.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.theme.preview-hero')

    @if ($relatedThemes->count())
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
                    @include(
                        'theme-store::web.components.theme.theme-card'
                    )
                @endforeach
            </div>

            @if ($theme->categories && $relatedThemesTotalCount > $relatedThemes->count())
                @include(
                    'theme-store::web.components.common.view-more',
                    [
                        'url' => route('theme-store.web.categories.show', [
                            'category' => $theme->categories->first()->slug,
                        ]),
                        'title' => 'View More Themes',
                    ]
                )
            @endif
        </section>
    @endif
@endsection
