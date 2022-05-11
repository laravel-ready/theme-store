@extends('theme-store::web.layouts.download')

@section('title', $theme->name)

@push('styles')
    {{-- Theme Download Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/theme.min.css') }}" />
@endpush

@section('content')
    <!-- Download Page Container -->
    <div class="download-page-container">
        <!-- Download Card -->
        <div class="download-card">
            <!-- Download Icon Container -->
            <div class="download-icon-container">
                <!-- Circle -->
                <div class="circle">
                    <!-- Icon -->
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        version="1.1" width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M2 12H4V17H20V12H22V17C22 18.11 21.11 19 20 19H4C2.9 19 2 18.11 2 17V12M12 15L17.55 9.54L16.13 8.13L13 11.25V2H11V11.25L7.88 8.13L6.46 9.55L12 15Z" />
                    </svg>
                </div>
            </div>

            <!-- Notice Container -->
            <div class="notice-container">
                <h1>
                    <a href="{{ route('theme-store.web.themes.show', $theme->slug) }}">
                        {{ $theme->name }}
                    </a>
                    is ready to download
                </h1>

                {{-- <p>
                    Transfer expires in 7 days
                </p> --}}
            </div>

            <!-- File List -->
            <ul class="file-list">
                <!-- File Item -->
                <li class="file-item">
                    <!-- Container -->
                    <div class="container">
                        <!-- File Container -->
                        <div class="file-container">
                            <!-- File Name -->
                            <h3 class="file-name">
                                {{ $latestRelease->fileName }}
                            </h3>

                            <!-- File Size -->
                            <p class="file-size">
                                {{ $latestRelease->file_size }}
                            </p>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Download Button Container -->
            <div class="download-button-container">
                <!-- Download Button -->
                <a class="download-button" href="{{ $downloadUrl ?? '#invalid_download_url' }}" download
                    title="Download Theme Files">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 20.03C16.41 20.03 20.03 16.41 20.03 12C20.03 7.59 16.41 3.97 12 3.97C7.59 3.97 3.97 7.59 3.97 12C3.97 16.41 7.59 20.03 12 20.03M12 22C6.46 22 2 17.54 2 12C2 6.46 6.46 2 12 2C17.54 2 22 6.46 22 12C22 17.54 17.54 22 12 22M11 13.54H8L12 17.5L16 13.54H13V6.5H11" />
                    </svg>

                    Download
                </a>
            </div>
        </div>
    </div>
@endsection
