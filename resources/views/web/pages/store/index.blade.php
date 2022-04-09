@extends('theme-store::web.layouts.main')

@section('title', 'Theme Store')

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

            <!-- Button Links Container -->
            <div class="links">
                <button class="primary-button">
                    Get Started
                </button>

                <button class="secondary-button">
                    Learn More
                </button>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        {{-- Title Bar --}}
        @include(
            'theme-store::web.components.common.section-title-bar',
            [
                'title' => 'Featured Categories',
                'message' => 'the technologies we use',
            ]
        )

        {{-- Featured Categories --}}
        @include(
            'theme-store::web.components.landing.featured-categories'
        )

        {{-- Search Bar --}}
        @include('theme-store::web.components.common.search-bar')

        <div class="store-card-container">
            @for ($i = 0; $i < 6; $i++)
                @include('theme-store::web.components.theme-card')
            @endfor
        </div>
    </main>
@endsection

@section('scripts')

@endsection
