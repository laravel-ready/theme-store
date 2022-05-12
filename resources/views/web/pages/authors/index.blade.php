@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/landing.min.css') }}" />
@endpush

@section('content')
    {{-- Page Hero --}}
    @include('theme-store::web.components.common.hero-section', [
        'title' => 'Categories',
    ])

    <main>
        <section class="meet-the-team-container">
            <!-- Meet the Team -->
            <div class="meet-the-team">
                <!-- Section Header -->
                <div class="section-header">
                    <div class="class-div-4">
                        <!-- Header -->
                        <h1 class="header">
                            Meet the Team
                        </h1>

                        <!-- Description -->
                        <p>
                            With over 100 years of combined experience, we've got a well-seasoned team at the helm.
                        </p>
                    </div>
                </div>

                <div class="team-members with-title-bar">
                    @foreach ($authors as $author)
                        @include(
                            'theme-store::web.components.author.author-card'
                        )
                    @endforeach
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
