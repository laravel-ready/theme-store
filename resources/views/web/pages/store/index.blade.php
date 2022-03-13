@extends('theme-store::web.layouts.main')

@section('title', 'Theme Store')

@section('content')
<main>
    <!-- Store Main Container -->
    <div class="store-card-container">
        @for ($i = 0; $i < 20; $i++)
            @include('theme-store::web.components.theme-card')
        @endfor
    </div>
</main>
@endsection

@section('scripts')

@endsection
