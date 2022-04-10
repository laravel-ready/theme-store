@extends('theme-store::web.layouts.main')

@section('title', 'Categories')

@push('styles')
    {{-- Category Pages Styles --}}
    <link rel="stylesheet" href="{{ asset('assets/store/web/css/category.min.css') }}" />
@endpush

@section('content')
    <main>
        {{-- Category List --}}
        <div class="category-collection">
            @foreach ($categories as $key => $item)
                @include(
                    'theme-store::web.components.category.featured-card-item',
                    [
                        'item' => $item,
                        'key' => $key,
                    ]
                )
            @endforeach
        </div>
    </main>
@endsection
