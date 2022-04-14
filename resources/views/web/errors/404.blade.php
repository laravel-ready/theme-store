@extends('theme-store::web.layouts.error')

@section('title', 'Page Not Found')

@section('content')

    <!-- Page Container -->
    <div class="page-container">
        <div class="error-container">
            <!-- Error -->
            <div class="error">
                <!-- Number -->
                <div class="number">
                    404
                </div>

                <!-- Text -->
                <div class="text">
                    {{ isset($notFoundText) && !empty($notFoundText) ? $notFoundText : 'This page does not exist' }}
                </div>

                <!-- Description -->
                <div class="description">
                    {{ isset($notFoundDescription) && !empty($notFoundDescription)? $notFoundDescription: 'The page you are looking for could not be found.' }}
                </div>
            </div>

            <!-- Continue -->
            <div class="continue">
                <div class="title">
                    Continue With
                </div>

                <!-- Nav Container -->
                <div class="nav-container">
                    <!-- Nav Item #1 -->
                    <a href="{{ route('web.home') }}" class="nav-item">
                        <!-- Nav Icon -->
                        <div class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 5.69L17 10.19V18H15V12H9V18H7V10.19L12 5.69M12 3L2 12H5V20H11V14H13V20H19V12H22L12 3Z" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <div class="title">
                                Home Page
                            </div>

                            <div class="sub-title">
                                Everything starts here
                            </div>
                        </div>

                        <!-- Chevron -->
                        <svg class="chevron" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30"
                            viewBox="0 0 30 30">
                            <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                        </svg>
                    </a>

                    <!-- Nav Item #2 -->
                    <a href="{{ route('theme-store.web.index') }}" class="nav-item">
                        <!-- Nav Icon -->
                        <div class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M4 4C2.89 4 2 4.89 2 6V18A2 2 0 0 0 4 20H20A2 2 0 0 0 22 18V8C22 6.89 21.1 6 20 6H12L10 4H4M4 8H20V18H4V8M7 22V24H9V22H7M11 22V24H13V22H11M15 22V24H17V22H15" />
                            </svg>
                        </div>

                        <!-- Content -->
                        <div class="content">
                            <div class="title">
                                Themes
                            </div>

                            <div class="sub-title">
                                See more themes
                            </div>
                        </div>

                        <!-- Chevron -->
                        <svg class="chevron" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30"
                            viewBox="0 0 30 30">
                            <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                        </svg>
                    </a>

                    @if (config('theme-store.blog_url'))
                        <!-- Nav Item #3 -->
                        <a href="{{ config('theme-store.blog_url') }}" class="nav-item">
                            <!-- Nav Icon -->
                            <div class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    version="1.1" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M19 1L14 6V17L19 12.5V1M21 5V18.5C19.9 18.15 18.7 18 17.5 18C15.8 18 13.35 18.65 12 19.5V6C10.55 4.9 8.45 4.5 6.5 4.5C4.55 4.5 2.45 4.9 1 6V20.65C1 20.9 1.25 21.15 1.5 21.15C1.6 21.15 1.65 21.1 1.75 21.1C3.1 20.45 5.05 20 6.5 20C8.45 20 10.55 20.4 12 21.5C13.35 20.65 15.8 20 17.5 20C19.15 20 20.85 20.3 22.25 21.05C22.35 21.1 22.4 21.1 22.5 21.1C22.75 21.1 23 20.85 23 20.6V6C22.4 5.55 21.75 5.25 21 5M10 18.41C8.75 18.09 7.5 18 6.5 18C5.44 18 4.18 18.19 3 18.5V7.13C3.91 6.73 5.14 6.5 6.5 6.5C7.86 6.5 9.09 6.73 10 7.13V18.41Z" />
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="content">
                                <div class="title">
                                    Blog
                                </div>

                                <div class="sub-title">
                                    Read our awesome articles
                                </div>
                            </div>

                            <!-- Chevron -->
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30"
                                viewBox="0 0 30 30">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                            </svg>
                        </a>
                    @endif

                    @if (config('theme-store.contact_url'))
                        <!-- Nav Item #4 -->
                        <a href="{{ config('theme-store.contact_url') }}" class="nav-item">
                            <!-- Nav Icon -->
                            <div class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    version="1.1" width="24" height="24" viewBox="0 0 24 24">
                                    <path
                                        d="M12,15C12.81,15 13.5,14.7 14.11,14.11C14.7,13.5 15,12.81 15,12C15,11.19 14.7,10.5 14.11,9.89C13.5,9.3 12.81,9 12,9C11.19,9 10.5,9.3 9.89,9.89C9.3,10.5 9,11.19 9,12C9,12.81 9.3,13.5 9.89,14.11C10.5,14.7 11.19,15 12,15M12,2C14.75,2 17.1,3 19.05,4.95C21,6.9 22,9.25 22,12V13.45C22,14.45 21.65,15.3 21,16C20.3,16.67 19.5,17 18.5,17C17.3,17 16.31,16.5 15.56,15.5C14.56,16.5 13.38,17 12,17C10.63,17 9.45,16.5 8.46,15.54C7.5,14.55 7,13.38 7,12C7,10.63 7.5,9.45 8.46,8.46C9.45,7.5 10.63,7 12,7C13.38,7 14.55,7.5 15.54,8.46C16.5,9.45 17,10.63 17,12V13.45C17,13.86 17.16,14.22 17.46,14.53C17.76,14.84 18.11,15 18.5,15C18.92,15 19.27,14.84 19.57,14.53C19.87,14.22 20,13.86 20,13.45V12C20,9.81 19.23,7.93 17.65,6.35C16.07,4.77 14.19,4 12,4C9.81,4 7.93,4.77 6.35,6.35C4.77,7.93 4,9.81 4,12C4,14.19 4.77,16.07 6.35,17.65C7.93,19.23 9.81,20 12,20H17V22H12C9.25,22 6.9,21 4.95,19.05C3,17.1 2,14.75 2,12C2,9.25 3,6.9 4.95,4.95C6.9,3 9.25,2 12,2Z" />
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="content">
                                <div class="title">
                                    Contact
                                </div>

                                <div class="sub-title">
                                    Contact us for your questions
                                </div>
                            </div>

                            <!-- Chevron -->
                            <svg class="chevron" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="30" height="30"
                                viewBox="0 0 30 30">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
