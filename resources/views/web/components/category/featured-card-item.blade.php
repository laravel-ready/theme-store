<!-- Card Item -->
<a href="{{ route('theme-store.web.categories.show', $item->slug) }}">
    {{-- <div class="card-item-{{ $key + 1 }}"> --}}
    <div class="card-item card-item-default {{ $useThemeBorder ?? '' }}">
        <img src="{{ $item->image ? $item->image : asset('assets/store/web/images/common/default-placeholder.png') }}"
            alt="{{ $item->name }} Logo" loading="lazy" height="80" width="80" />

        <p>
            {{ $item->name }}
        </p>
    </div>
</a>
