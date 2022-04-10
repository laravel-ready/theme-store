@if ($paginator->hasPages())

    <!-- Pagination Nav -->
    <nav class="pagination-nav" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <!-- Next - Prev Container -->
        <div class="next-prev-container">
            @if ($paginator->onFirstPage())
                <span>
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}">
                    {!! __('pagination.previous') !!}
                </a>
                @endif @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}">
                        {!! __('pagination.next') !!}
                    </a>
                @else
                    <span>
                        {!! __('pagination.next') !!}
                    </span>
                @endif
        </div>

        <!-- Pagination Container -->
        <div class="pagination-container">
            <!-- Counter Container -->
            <div class="counter-container">
                <!-- Showing from to -->
                <p class="showing-from-to">
                    {!! __('Showing') !!} @if ($paginator->firstItem())
                        <span>
                            {{ $paginator->firstItem() }}
                        </span>

                        {!! __('to') !!}

                        <span>
                            {{ $paginator->lastItem() }}
                        </span>
                    @else
                        {{ $paginator->count() }}
                    @endif {!! __('of') !!}

                    <span>
                        {{ $paginator->total() }}
                    </span>

                    {!! __('results') !!}
                </p>
            </div>

            <!-- Number Wrapper -->
            <div class="number-wrapper">
                <!-- Number Container -->
                <span class="number-container">
                    {{-- Previous Page Link --}} @if ($paginator->onFirstPage())
                        <span class="class-span-7" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <!-- Previous Page Content -->
                            <span class="previous-page-content" aria-hidden="true">
                                <svg fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        </span>
                    @else
                        <!-- Previous Page Link -->
                        <a class="previous-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                            aria-label="{{ __('pagination.previous') }}">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                        @endif {{-- Pagination Elements --}} @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}} @if (is_string($element))
                                <span class="class-span-9" aria-disabled="true">
                                    <!-- Three Dots Separator -->
                                    <span class="three-dots-separator">
                                        {{ $element }}
                                    </span>
                                </span>
                                @endif {{-- Array Of Links --}} @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <span class="class-span-10" aria-current="page">
                                                <!-- Current Page -->
                                                <span class="current-page">
                                                    {{ $page }}
                                                </span>
                                            </span>
                                        @else
                                            <!-- Link -->
                                            <a class="link" href="{{ $url }}"
                                                aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                                @endforeach {{-- Next Page Link --}} @if ($paginator->hasMorePages())
                                    <!-- Next Page Link -->
                                    <a class="next-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                                        aria-label="{{ __('pagination.next') }}">
                                        <svg fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                @else
                                    <span class="class-span-13" aria-disabled="true"
                                        aria-label="{{ __('pagination.next') }}">
                                        <!-- Next Page Content -->
                                        <span class="next-page-content" aria-hidden="true">
                                            <svg fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                    </span>
                                @endif
                </span>
            </div>
        </div>
    </nav>

@endif
