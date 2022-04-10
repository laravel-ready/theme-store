<!-- Card Item -->
<div class="card-item">
    <!-- Link -->
    <a class="link" href="#">
        <!-- Image -->
        <img class="image" alt="blog photo"
            src="{{ $item->image ? $item->image : asset('assets/store/web/images/common/default-placeholder.png') }}" />

        <!-- Body -->
        <div class="body">
            <!-- Title -->
            <div class="title">
                {{ $item->name }}
            </div>

            <!-- Description -->
            <p class="description">
                {{ \Str::length($item->description) > 150? \Str::substr($item->description, 0, 150) . '...': $item->description }}
            </p>
        </div>
    </a>
</div>
