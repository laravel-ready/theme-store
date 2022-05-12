<!-- Meet the Team -->
<div class="meet-the-team">
    {{-- <!-- Section Header -->
    <div class="section-header">
        <div class="class-div-4">
            <!-- Header -->
            <h1 class="header">
                Meet the Team
            </h1>

            <!-- Description -->
            <p>
                With over 100 years of combined experience, we've got a well-seasoned team at the helm.
            </p>
        </div>
    </div> --}}

    @include(
        'theme-store::web.components.common.section-title-bar',
        [
            'useThemeColor' => true,
            'topLine' => true,
            'bottomLine' => true,
            'title' => 'Meet the Team',
            // 'message' => 'the technologies we use',
        ]
    )

    <div class="team-members with-title-bar">
        @foreach ($featuredAuthors as $author)
            @include('theme-store::web.components.author.author-card')
        @endforeach
    </div>
</div>
