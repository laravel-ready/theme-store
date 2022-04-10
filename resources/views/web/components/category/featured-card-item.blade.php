<!-- Card Item -->
<a href="{{ route('theme-store.web.categories.item', $item->slug) }}">
    {{-- <div class="card-item-{{ $key + 1 }}"> --}}
    <div class="card-item-default">
        <img src="{{ $item->image ? $item->image : asset('assets/store/web/images/common/default-placeholder.png') }}"
            alt="{{ $item->name }} Logo" />

        <p>
            {{ $item->name }}
        </p>
    </div>
</a>
