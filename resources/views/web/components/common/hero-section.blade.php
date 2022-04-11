<!-- Page Hero Container -->
<section class="page-hero-container"
    style="background-image: url({{ asset('assets/store/web/images/common/bg-1.jpg') }});">
    <!-- Hero -->
    <div class="hero">
        <!-- Content -->
        <div class="content">
            {{-- Title Bar --}}
            @include(
                'theme-store::web.components.common.section-title-bar',
                [
                    'useThemeColor' => false,
                    'topLine' => false,
                    'bottomLine' => true,
                    'title' => 'Categories',
                    // 'message' => 'the technologies we use',
                ]
            )
        </div>
    </div>
</section>
