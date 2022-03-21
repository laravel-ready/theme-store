@extends('theme-store::web.layouts.main')

@section('title', 'Theme Store')

@section('content')
    <!-- Section Header Container -->
    <header class="hero">
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
                <b>{{ env('APP_NAME') }}</b> is the best place to find the best themes for your website.
            </p>
        </div>

        <!-- Button Links Container -->
        <div class="links">
            <button>
                Get Started
            </button>

            <button>
                Live Demo
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Store Main Container -->
        <div class="store-card-container">
            @for ($i = 0; $i < 20; $i++)
                @include('theme-store::web.components.theme-card')
            @endfor
        </div>
    </main>
@endsection

@section('scripts')

@endsection
