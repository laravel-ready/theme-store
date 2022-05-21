<!-- Theme Card -->
<div class="theme-card">
    <!-- Preview -->
    <div class="preview">
        <!-- Thumbnail -->
        <a href="{{ route('theme-store.web.themes.show', $theme->slug) }}" title="{{ $theme->name }}">
            <img class="thumbnail"
                src="{{ $theme->cover ? $theme->cover : asset('/assets/store/web/images/common/default-placeholder.png') }}"
                alt="Product Preview" loading="lazy" height="192" width="384" />

            {{-- Header Bar --}}
            <div class="header-bar">
                @if ($theme->is_premium)
                    <label class="premium" title="This theme is premium">
                        Premium
                    </label>
                @else
                    <label class="free" title="This theme is free">
                        Free
                    </label>
                @endif
            </div>

            <!-- Hover Bar -->
            <div class="hover-bar">
                {{-- <!-- Add to Bookmarks Button -->
                    <button class="add-to-bookmarks-button">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24" title="Add to Bookmarks">
                            <path d="M2,16H10V14H2M18,14V10H16V14H12V16H16V20H18V16H22V14M14,6H2V8H14M14,10H2V12H14V10Z" />
                        </svg>
                    </button>

                    <!-- Add to Favorites Button -->
                    <button class="add-to-favorites-button">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24" title="Add to Favorites">
                            <path
                                d="M12,21.35L10.55,20.03C5.4,15.36 2,12.27 2,8.5C2,5.41 4.42,3 7.5,3C9.24,3 10.91,3.81 12,5.08C13.09,3.81 14.76,3 16.5,3C19.58,3 22,5.41 22,8.5C22,12.27 18.6,15.36 13.45,20.03L12,21.35Z" />
                        </svg>
                    </button> --}}
            </div>
        </a>
    </div>

    <!-- Body -->
    <div class="body">
        <!-- Title -->
        <a class="title" href="{{ route('theme-store.web.themes.show', $theme->slug) }}">
            {{ $theme->name }}
        </a>

        <!-- Author - Category -->
        <div class="author-category">
            <!-- Author -->
            @isset($theme->authors[0])
                by

                <a class="author" href="{{ route('theme-store.web.authors.show', $theme->authors[0]->slug) }}">
                    {{ $theme->authors[0]->name }}
                </a>
            @endisset

            <!-- Category -->
            @isset($theme->categories[0])
                in
                <a class="category"
                    href="{{ route('theme-store.web.categories.show', $theme->categories[0]->slug) }}">
                    {{ $theme->categories[0]->name }}
                </a>
            @endisset
        </div>

        {{-- <!-- Price -->
        <div class="price">
            $23
        </div> --}}

        <!-- Body -->
        <div class="details">
            <!-- Detail Column -->
            <div class="detail-column">
                <!-- Rating -->
                <div class="rating">
                    <svg title="Worst" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                    </svg>

                    <svg title="Bad" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                    </svg>

                    <svg title="Not Bad" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                    </svg>

                    <svg title="Good" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                    </svg>

                    <svg title="Awesome" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z" />
                    </svg>

                    <div class="count">
                        (45)
                    </div>
                </div>

                <!-- Statistic -->
                <div class="statistic" title="{{ $theme->totalDownloads[0]->total_downloads ?? 0 }} Downloads">
                    @if (isset($theme->totalDownloads[0]))
                        {{ \ReadableNumbers::make((int) $theme->totalDownloads[0]->total_downloads) }}
                    @else
                        0
                    @endif
                    Downloads
                </div>
            </div>

            <!-- Button Column -->
            <div class="button-column">
                {{-- <!-- Cart Button -->
                <a class="cart-button" title="Add to Cart">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M17,18A2,2 0 0,1 19,20A2,2 0 0,1 17,22C15.89,22 15,21.1 15,20C15,18.89 15.89,18 17,18M1,2H4.27L5.21,4H20A1,1 0 0,1 21,5C21,5.17 20.95,5.34 20.88,5.5L17.3,11.97C16.96,12.58 16.3,13 15.55,13H8.1L7.2,14.63L7.17,14.75A0.25,0.25 0 0,0 7.42,15H19V17H7C5.89,17 5,16.1 5,15C5,14.65 5.09,14.32 5.24,14.04L6.6,11.59L3,4H1V2M7,18A2,2 0 0,1 9,20A2,2 0 0,1 7,22C5.89,22 5,21.1 5,20C5,18.89 5.89,18 7,18M16,11L18.78,6H6.14L8.5,11H16Z" />
                    </svg>
                </a> --}}

                <!-- Preview Link Button -->
                <a class="preview-link-button" title="See Theme Details and Preview">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                    </svg>

                    <!-- Text -->
                    <div class="text">
                        See Details
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
