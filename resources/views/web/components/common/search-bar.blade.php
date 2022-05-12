<!-- Search Bar -->
<form class="search-bar" method="GET" action="{{ route('theme-store.web.search') }}">
    <!-- Input Container -->
    <div class="input-container">
        <svg class="class-svg-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>

        <!-- Search Input -->
        <input name="q" class="search-input" type="text" placeholder="Enter template name or keyword..."
            value="{{ $keyword ?? '' }}" />
    </div>

    {{-- <!-- Category Select -->
    <div class="category-select">
        <span>
            All categorie
        </span>

        <svg class="class-svg-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </div> --}}

    <!-- Search Button -->
    <button class="search-button">
        Search
    </button>
</form>
