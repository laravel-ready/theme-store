@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    {{-- Category Pages Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/category.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.common.hero-section', [
        'title' => 'Categories',
    ])

    <main>
        {{-- Content --}}
        <section class="card place-to-top">
            <!-- Categories Preview -->
            <div class="p-0 categories-preview">
                <!-- Category Cards -->
                <div class="category-collection">
                    <!-- Cards Container -->
                    <div class="cards-container">
                        @if (count($categoriesChunk) == 3)
                            @for ($i = 0; $i < $categoriesChunk->count(); $i++)
                                <!-- Card Collection -->
                                <div class="{{ $i == 0 ? 'left' : ($i == 1 ? 'middle' : 'right') }}-collection">
                                    @foreach ($categoriesChunk[$i] as $key => $item)
                                        @include(
                                            'theme-store::web.components.category.featured-card-item',
                                            [
                                                'item' => $item,
                                                'key' => $key,
                                                'useThemeBorder' => 'border-orange',
                                            ]
                                        )
                                    @endforeach
                                </div>
                            @endfor
                        @else
                            @for ($i = 0; $i < $categoriesChunk->count(); $i++)
                                <!-- Card Collection -->
                                <div class="-collection">
                                    @foreach ($categoriesChunk[$i] as $key => $item)
                                        @include(
                                            'theme-store::web.components.category.featured-card-item',
                                            [
                                                'item' => $item,
                                                'key' => $key,
                                            ]
                                        )
                                    @endforeach
                                </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- Pagination Nav --}}
        @include('theme-store::web.components.common.pagination', [
            'paginator' => $categories,
            'elements' => $categories,
        ])
    </main>
@endsection
