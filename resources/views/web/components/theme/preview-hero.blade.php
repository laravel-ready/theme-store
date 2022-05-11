<div class="preview-hero">
    <div class="content">
        <img src="{{ $theme->cover ? $theme->cover : asset('/assets/store/web/images/common/default-placeholder.png') }}"
            alt="Theme {{ $theme->name }}" class="hero-image" loading="lazy" width="600" height="400">

        <div class="details">
            <div class="title">
                {{ $theme->name }}
            </div>

            <div class="subtitle">
                {{ $theme->description }}
            </div>

            <!-- Categories -->
            <div class="categories">
                @foreach ($theme->categories as $category)
                    <a href="{{ route('theme-store.web.categories.show', $category->slug) }}"
                        title="{{ $category->name }}">
                        <img src="{{ $category->image ? $category->image : asset('assets/store/web/images/common/default-placeholder.png') }}"
                            alt="Category {{ $category->name }}" loading="lazy" height="28" width="28">
                    </a>
                @endforeach
            </div>

            <!-- Links -->
            <div class="links links-left">
                @if ($theme->preview_link)
                    <a class="primary-button btn-sm" href="{{ $theme->preview_link }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                        </svg>

                        Preview
                    </a>
                @else
                    <a class="primary-button btn-sm disabled" title="Preview URL is not Available">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12,9A3,3 0 0,1 15,12A3,3 0 0,1 12,15A3,3 0 0,1 9,12A3,3 0 0,1 12,9M12,4.5C17,4.5 21.27,7.61 23,12C21.27,16.39 17,19.5 12,19.5C7,19.5 2.73,16.39 1,12C2.73,7.61 7,4.5 12,4.5M3.18,12C4.83,15.36 8.24,17.5 12,17.5C15.76,17.5 19.17,15.36 20.82,12C19.17,8.64 15.76,6.5 12,6.5C8.24,6.5 4.83,8.64 3.18,12Z" />
                        </svg>

                        Preview
                    </a>
                @endif

                @if ($theme->active_releases_count > 0)
                    <a class="secondary-button btn-sm"
                        href="{{ route('theme-store.web.themes.download.show', $theme->slug) }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M13,5V11H14.17L12,13.17L9.83,11H11V5H13M15,3H9V9H5L12,16L19,9H15V3M19,18H5V20H19V18Z" />
                        </svg>

                        Download
                    </a>
                @else
                    <a class="secondary-button btn-sm disabled" disabled="true"
                        title="Download Link is not Available Now">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M13,5V11H14.17L12,13.17L9.83,11H11V5H13M15,3H9V9H5L12,16L19,9H15V3M19,18H5V20H19V18Z" />
                        </svg>

                        Download
                    </a>
                @endif
            </div>
        </div>
    </div>

    <div class="content-bar">
        {{-- Overview --}}
        <button class="active">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M2,3H10A2,2 0 0,1 12,1A2,2 0 0,1 14,3H22V5H21V16H15.25L17,22H15L13.25,16H10.75L9,22H7L8.75,16H3V5H2V3M5,5V14H19V5H5Z" />
            </svg>

            <span>
                Overview
            </span>
        </button>

        {{-- Comments --}}
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M9,22A1,1 0 0,1 8,21V18H4A2,2 0 0,1 2,16V4C2,2.89 2.9,2 4,2H20A2,2 0 0,1 22,4V16A2,2 0 0,1 20,18H13.9L10.2,21.71C10,21.9 9.75,22 9.5,22V22H9M10,16V19.08L13.08,16H20V4H4V16H10M6,7H18V9H6V7M6,11H15V13H6V11Z" />
            </svg>

            <span>
                Comments
            </span>
        </button>

        {{-- Documentation --}}
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M16 0H8C6.9 0 6 .9 6 2V18C6 19.1 6.9 20 8 20H20C21.1 20 22 19.1 22 18V6L16 0M20 18H8V2H15V7H20V18M4 4V22H20V24H4C2.9 24 2 23.1 2 22V4H4M10 10V12H18V10H10M10 14V16H15V14H10Z" />
            </svg>

            <span></span>
            Documentation
            </span>
        </button>

        {{-- Change Logs --}}
        <button>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                height="24" viewBox="0 0 24 24">
                <path
                    d="M12 13H7V18H12V20H5V10H7V11H12V13M8 4V6H4V4H8M10 2H2V8H10V2M20 11V13H16V11H20M22 9H14V15H22V9M20 18V20H16V18H20M22 16H14V22H22V16Z" />
            </svg>
            <span>
                Change Logs
            </span>
        </button>
    </div>
</div>
