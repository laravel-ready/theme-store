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
        <!-- Categories Preview -->
        <div class="categories-preview">
            <!-- Category Cards -->
            <div class="category-cards">
                <!-- Cards Container -->
                <div class="cards-container">
                    <!-- Left Card -->
                    <div class="left-card">
                        <!-- Card Item -->
                        <a href="https://www.creative-tim.com/learning-lab/tailwind/svelte/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-1">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/svelte.jpg" />

                                <p>
                                    Svelte
                                </p>
                            </div>
                        </a>

                        <a href="https://www.creative-tim.com/learning-lab/tailwind/react/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-2">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/react.jpg" />

                                <p>
                                    ReactJS
                                </p>
                            </div>
                        </a>

                        <a href="https://www.creative-tim.com/learning-lab/tailwind/nextjs/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-3">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/nextjs.jpg" />

                                <p>
                                    NextJS
                                </p>
                            </div>
                        </a>
                    </div>

                    <!-- Right Col -->
                    <div class="right-col">
                        <a href="https://www.creative-tim.com/learning-lab/tailwind/js/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-1">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/js.png" />

                                <p>
                                    JavaScript
                                </p>
                            </div>
                        </a>

                        <a href="https://www.creative-tim.com/learning-lab/tailwind/angular/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-2">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/angular.jpg" />

                                <p>
                                    Angular
                                </p>
                            </div>
                        </a>

                        <a href="https://www.creative-tim.com/learning-lab/tailwind/vue/alerts/notus?ref=vtw-index"
                            target="_blank">
                            <div class="card-item-3">
                                <img alt="..."
                                    src="https://raw.githubusercontent.com/creativetimofficial/public-assets/master/logos/vue.jpg" />

                                <p>
                                    Vue.js
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Details Column -->
            <div class="details-column">
                <!-- Column Icon -->
                <div class="column-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M16,20H20V16H16M16,14H20V10H16M10,8H14V4H10M16,8H20V4H16M10,14H14V10H10M4,14H8V10H4M4,20H8V16H4M10,20H14V16H10M4,8H8V4H4V8Z" />
                    </svg>
                </div>

                <!-- Title -->
                <h3 class="title">
                    Javascript Components
                </h3>

                <!-- Description -->
                <p class="description">
                    In order to create a great User Experience some components require JavaScript. In this way you can
                    manipulate the elements on the page and give more options to your users.
                </p>

                <p class="description">
                    In order to create a great User Experience some components require JavaScript. In this way you can
                    manipulate the elements on the page and give more options to your users.
                </p>

                <!-- Tags -->
                <div class="tags">
                    <!-- Tag -->
                    <a class="tag">
                        Alerts
                    </a>
                    <a>
                        Dropdowns
                    </a>
                    <a>
                        Menus
                    </a>
                    <a>
                        Modals
                    </a>
                    <a>
                        Navbars
                    </a>
                    <a>
                        Popovers
                    </a>
                    <a>
                        Tabs
                    </a>
                    <a>
                        Tooltips
                    </a>
                </div>

                <!-- View All -->
                <a class="view-all"
                    href="https://www.creative-tim.com/learning-lab/tailwind/js/alerts/notus?ref=njs-index" target="_blank">
                    View all

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z" />
                    </svg>
                </a>
            </div>
        </div>

        @include('theme-store::web.components.common.search-bar')

        <!-- Store Main Container -->
        <div class="store-card-container">
            @for ($i = 0; $i < 6; $i++)
                @include('theme-store::web.components.theme-card')
            @endfor
        </div>
    </main>
@endsection

@section('scripts')

@endsection
