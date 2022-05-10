<!-- Navbar -->
<nav class="static navbar">
    <!-- Logo Container -->
    <div class="logo-container">
        <!-- Logo -->
        <a href="{{ url('/') }}">
            <h3 class="logo">
                <img src="{{ config('theme-store.logo_path')? asset(config('theme-store.logo_path')): asset('assets/store/logos/logo.png') }}"
                    alt="Store Logo" loading="lazy">
            </h3>
        </a>
    </div>

    <!-- Links Section -->
    <div class="links-container">
        <a href="{{ route('web.home') }}" class="{{ request()->routeIs('web.home') ? 'active' : '' }}">
            Home
        </a>

        <a href="{{ route('theme-store.web.index') }}"
            class="{{ request()->routeIs('theme-store.web.index') ? 'active' : '' }}">
            Themes
        </a>

        <a>
            Developers
        </a>

        <a>
            Pricing
        </a>


        @if (config('theme-store.blog_url'))
            <a href="{{ config('theme-store.blog_url') }}"
                class="{{ url()->current() == config('theme-store.blog_url') ? 'active' : '' }}">
                Blog
            </a>
        @endif

        <a>
            About Us
        </a>
    </div>

    @guest
        <!-- Auth Links -->
        <div class="menu-icons-container">
            <a href="{{ route('register') }}">
                <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
                </svg>

                Sign up
            </a>

            <a href="{{ route('login') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path
                        d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
                </svg>

                Sign in
            </a>
        </div>
    @endguest

    @auth
        <!-- Auth Links -->
        <div class="menu-icons-container">
            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path
                        d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M7.07,18.28C7.5,17.38 10.12,16.5 12,16.5C13.88,16.5 16.5,17.38 16.93,18.28C15.57,19.36 13.86,20 12,20C10.14,20 8.43,19.36 7.07,18.28M18.36,16.83C16.93,15.09 13.46,14.5 12,14.5C10.54,14.5 7.07,15.09 5.64,16.83C4.62,15.5 4,13.82 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,13.82 19.38,15.5 18.36,16.83M12,6C10.06,6 8.5,7.56 8.5,9.5C8.5,11.44 10.06,13 12,13C13.94,13 15.5,11.44 15.5,9.5C15.5,7.56 13.94,6 12,6M12,11A1.5,1.5 0 0,1 10.5,9.5A1.5,1.5 0 0,1 12,8A1.5,1.5 0 0,1 13.5,9.5A1.5,1.5 0 0,1 12,11Z" />
                </svg>

                {{ Auth::user()->name }}
            </a>

            <a href="{{ route('logout') }}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24"
                    height="24" viewBox="0 0 24 24">
                    <path
                        d="M16,17V14H9V10H16V7L21,12L16,17M14,2A2,2 0 0,1 16,4V6H14V4H5V20H14V18H16V20A2,2 0 0,1 14,22H5A2,2 0 0,1 3,20V4A2,2 0 0,1 5,2H14Z" />
                </svg>

                Logout
            </a>
        </div>
    @endauth
</nav>
