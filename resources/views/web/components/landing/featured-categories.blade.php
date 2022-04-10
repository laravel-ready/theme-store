@if ($featuredCategories)
    <!-- Categories Preview -->
    <div class="categories-preview">
        <!-- Category Cards -->
        <div class="category-cards">
            <!-- Cards Container -->
            <div class="cards-container">
                @for ($i = 0; $i < $featuredCategories->count(); $i++)
                    <!-- Card Collection -->
                    <div class="{{ $i == 0 ? 'left' : 'right' }}-collection">
                        @foreach ($featuredCategories[$i] as $key => $item)
                            @include(
                                'theme-store::web.components.category.featured-card-item',
                                [
                                    'item' => $item,
                                    'key' => $key,
                                ]
                            )
                        @endforeach
                    </div>
                @endfor
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
                Themes & Components
            </h3>

            <!-- Description -->
            <p class="description">
                We use modern technologies to create the best themes.
                We have a wide range of themes and components to choose from.
                Needs for a specific website? Themes & components are the best way to get it done.
            </p>

            <!-- Tags -->
            <div class="tags">
                @foreach ($latestCategories as $item)
                    <!-- Tag -->
                    <a href="{{ route('theme-store.web.categories.item', $item->slug) }}" class="tag">
                        {{ $item->name }}
                    </a>
                @endforeach
            </div>

            <!-- View All -->
            <a class="view-all" href="{{ route('theme-store.web.categories.index') }}">
                View all

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                    width="24" height="24" viewBox="0 0 24 24">
                    <path
                        d="M5.59,7.41L7,6L13,12L7,18L5.59,16.59L10.17,12L5.59,7.41M11.59,7.41L13,6L19,12L13,18L11.59,16.59L16.17,12L11.59,7.41Z" />
                </svg>
            </a>
        </div>
    </div>
@endif
