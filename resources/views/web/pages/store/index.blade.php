@extends('theme-store::web.layouts.main')

@section('title', 'Theme Store')

@push('styles')
    {{-- Landing Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/landing.min.css') }}" />
@endpush

@section('content')
    <!-- Section Header Container -->
    <header>
        <div class="hero">
            <!-- Intro -->
            <div class="intro">
                <!-- Title -->
                <h1 class="title">
                    The Freedom to Create the

                    <span>
                        Websites
                    </span>

                    You Want
                </h1>

                <!-- Description -->
                <p class="description">
                    A professional website drives sales.
                    Create a beautiful website to impress and engage new customers and establish your business online.
                    <a href="{{ url('/') }}">{{ env('APP_NAME') }}</a> is the best place to find the best themes for
                    your website.
                </p>
            </div>

            <!-- Links -->
            <div class="links">
                <a href="{{ route('theme-store.web.themes.index') }}" class="primary-button">
                    Get Started
                </a>

                <button class="secondary-button">
                    Learn More
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{-- Search Bar --}}
        @include('theme-store::web.components.common.search-bar')

        {{-- Featured Categories Section --}}
        <section class="featured-categories">
            {{-- Section Title --}}
            @include(
                'theme-store::web.components.common.section-title-bar',
                [
                    'useThemeColor' => true,
                    'topLine' => true,
                    'bottomLine' => true,
                    'title' => 'Featured Categories',
                    // 'message' => 'the technologies we use',
                ]
            )

            {{-- Featured Categories --}}
            @include(
                'theme-store::web.components.landing.featured-categories'
            )
        </section>

        {{-- Featured Themes Section --}}
        <section>
            {{-- Section Title --}}
            @include(
                'theme-store::web.components.common.section-title-bar',
                [
                    'useThemeColor' => true,
                    'topLine' => true,
                    'bottomLine' => true,
                    'title' => 'Featured Themes',
                    // 'message' => 'add some message',
                ]
            )

            <div class="store-card-container">
                @foreach ($featuredThemes as $theme)
                    @include('theme-store::web.components.theme.theme-card')
                @endforeach
            </div>
        </section>

        <section class="meet-the-team-container">
            @include('theme-store::web.components.landing.meet-the-team')
        </section>
    </main>
@endsection

@section('scripts')

@endsection
