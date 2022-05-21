@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/landing.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.common.hero-section', [
        'title' => 'Authors',
    ])

    <main>
        <section class="card place-to-top container">
            <div class="meet-the-team-container fluid">
                <!-- Meet the Team -->
                <div class="meet-the-team">
                    <div class="team-members">
                        @foreach ($authors as $author)
                            @include('theme-store::web.components.author.author-card')
                        @endforeach
                    </div>
                </div>
            </div>

        </section>

        {{-- Pagination Nav --}}
        @include('theme-store::web.components.common.pagination', [
            'paginator' => $authors,
            'elements' => $authors,
        ])
    </main>
@endsection
