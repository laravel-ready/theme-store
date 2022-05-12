<!-- Author -->
<div class="author-card">
    <div class="body">
        <!-- Avatar -->
        <a class="avatar" href="{{ route('theme-store.web.authors.show', $author->slug) }}">
            <img src="{{ $author->avatar ?? asset('/assets/store/web/images/common/default-placeholder.png') }}"
                height="240" width="240" loading="lazy" />
        </a>

        <!-- Details -->
        <div class="details">
            <!-- Name -->
            <h1 class="name">
                <a class="name" href="{{ route('theme-store.web.authors.show', $author->slug) }}">
                    {{ $author->name ?: 'Unknown' }}
                </a>
            </h1>

            <!-- Title -->
            <div class="title">
                {{ $author->title ?: '-' }}
            </div>

            {{-- <!-- Social Icons -->
            <div class="social-icons">
                <!-- Linkedin -->
                <a class="linkedin" href="#">
                    <i></i>
                </a>

                <!-- Twitter -->
                <a class="twitter" href="#">
                    <i></i>
                </a>

                <!-- Instagram -->
                <a class="instagram" href="#">
                    <i></i>
                </a>
            </div> --}}
        </div>
    </div>
</div>
