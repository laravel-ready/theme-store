<!-- Section Title Bar Container -->
<div class="section-title-bar-container">
    <!-- Title Bar -->
    <div class="title-bar">
        @if (isset($topLine) && $topLine)
            <!-- Underline -->
            <div class="underline {{ isset($useThemeColor) && $useThemeColor ? 'line-orange' : '' }}">
                <!-- Line 1 -->
                <span class="line line-1"></span>

                <!-- Line 2 -->
                <span class="line line-2"></span>

                <!-- Line 3 -->
                <span class="line line-3"></span>

                <!-- Line 4 -->
                <span class="line line-4"></span>

                <!-- Line 5 -->
                <span class="line line-5"></span>
            </div>
        @endif

        <!-- Title -->
        <h1 class="title">
            {{ $title ?? 'Title' }}
        </h1>

        <!-- Short Message -->
        <h3 class="short-message">
            {{ $message ?? '' }}
        </h3>

        @if (isset($bottomLine) && $bottomLine)
            <!-- Underline -->
            <div class="underline {{ isset($useThemeColor) && $useThemeColor ? 'line-orange' : '' }}">
                <!-- Line 1 -->
                <span class="line line-1"></span>

                <!-- Line 2 -->
                <span class="line line-2"></span>

                <!-- Line 3 -->
                <span class="line line-3"></span>

                <!-- Line 4 -->
                <span class="line line-4"></span>

                <!-- Line 5 -->
                <span class="line line-5"></span>
            </div>
        @endif
    </div>
</div>
